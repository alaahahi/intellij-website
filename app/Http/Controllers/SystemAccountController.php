<?php

namespace App\Http\Controllers;

use App\Services\SystemAccountExcelService;
use App\Services\SystemAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;

class SystemAccountController extends Controller
{
    public function __construct(
        private SystemAccountService $accounts,
        private SystemAccountExcelService $excel,
    ) {
    }

    public function show(string $slug)
    {
        $settings = $this->accounts->settings();
        $unlocked = (bool) session($this->accounts->sessionKey($slug));

        return view('system-account.app', [
            'slug' => $slug,
            'companyName' => $settings->company_name ?? $slug,
            'unlocked' => $unlocked,
        ]);
    }

    public function unlock(Request $request, string $slug)
    {
        $request->validate([
            'pin' => ['required', 'string', 'max:32'],
        ]);

        $key = 'system-account-pin:'.$slug.':'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 8)) {
            return response()->json([
                'message' => 'محاولات كثيرة. حاول لاحقاً.',
            ], 429);
        }

        if (! $this->accounts->verifyPin($request->input('pin'))) {
            RateLimiter::hit($key, 300);

            return response()->json([
                'message' => 'رمز PIN غير صحيح.',
                'unlocked' => false,
            ], 422);
        }

        RateLimiter::clear($key);
        $request->session()->put($this->accounts->sessionKey($slug), true);

        return response()->json([
            'unlocked' => true,
            'company_name' => $this->accounts->settings()->company_name,
        ]);
    }

    public function lock(Request $request, string $slug)
    {
        $request->session()->forget($this->accounts->sessionKey($slug));

        return response()->json(['unlocked' => false]);
    }

    public function status(string $slug)
    {
        return response()->json([
            'unlocked' => (bool) session($this->accounts->sessionKey($slug)),
            'company_name' => $this->accounts->settings()->company_name,
            'slug' => $slug,
        ]);
    }

    public function stats(string $slug)
    {
        return response()->json($this->accounts->stats());
    }

    public function cars(string $slug)
    {
        return response()->json([
            'data' => $this->accounts->cars(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function storeCar(Request $request, string $slug)
    {
        $data = $request->validate([
            'car_type' => ['required', 'string', 'max:255'],
            'entry_date' => ['nullable', 'string', 'max:50'],
            'cars_count' => ['required', 'integer', 'min:0'],
            'unit_price' => ['required', 'numeric', 'min:0'],
            'transfer_amount' => ['nullable', 'numeric', 'min:0'],
            'transfer_date' => ['nullable', 'string', 'max:50'],
            'transfer_note' => ['nullable', 'string', 'max:2000'],
        ]);

        $id = $this->accounts->createCar($data);

        return response()->json([
            'id' => $id,
            'data' => $this->accounts->cars(),
            'stats' => $this->accounts->stats(),
        ], 201);
    }

    public function destroyCar(string $slug, int $id)
    {
        if (! $this->accounts->deleteCar($id)) {
            return response()->json(['message' => 'غير موجود'], 404);
        }

        return response()->json([
            'data' => $this->accounts->cars(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function import(Request $request, string $slug)
    {
        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ]);

        $imported = $this->excel->import($request->file('file'));

        return response()->json([
            'imported' => $imported,
            'data' => $this->accounts->cars(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function export(string $slug)
    {
        $settings = $this->accounts->settings();

        return $this->excel->export($settings->company_name);
    }

    public function voucherReceipt(string $slug, int $id)
    {
        return $this->voucher($slug, $id, 'receipt');
    }

    public function voucherPayment(string $slug, int $id)
    {
        return $this->voucher($slug, $id, 'payment');
    }

    private function voucher(string $slug, int $id, string $type)
    {
        $car = $this->accounts->findCar($id);
        abort_unless($car, 404);

        $settings = $this->accounts->settings();

        return view('system-account.voucher', [
            'type' => $type,
            'title' => $type === 'receipt' ? 'وصول قبض' : 'وصول دفع',
            'companyName' => $settings->company_name,
            'slug' => $slug,
            'car' => $car,
        ]);
    }
}
