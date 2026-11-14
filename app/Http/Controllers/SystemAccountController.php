<?php

namespace App\Http\Controllers;

use App\Services\SystemAccountExcelService;
use App\Services\SystemAccountLicenseService;
use App\Services\SystemAccountService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\RateLimiter;

class SystemAccountController extends Controller
{
    public function __construct(
        private SystemAccountService $accounts,
        private SystemAccountExcelService $excel,
        private SystemAccountLicenseService $license,
    ) {
    }

    public function license()
    {
        return response()->json($this->license->status());
    }

    public function activate(Request $request, ?int $days = null)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'max:100'],
            'days' => ['nullable', 'integer', 'min:1', 'max:3650'],
        ]);

        $expected = (string) config('services.system_account.delete_password');
        if ($expected === '' || ! hash_equals($expected, $data['password'])) {
            return response()->json(['message' => 'كلمة المرور غير صحيحة.'], 422);
        }

        $grant = $days ?? (int) ($data['days'] ?? 30);

        try {
            $status = $this->license->activate($grant);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        Log::info('system_account_license_activated', [
            'days' => $grant,
            'expires_at' => $status['expires_at'],
            'ip' => $request->ip(),
        ]);

        if ($request->expectsJson() || $request->ajax()) {
            return response()->json([
                'message' => 'تم التفعيل بنجاح',
                'license' => $status,
            ]);
        }

        return response(
            '<!DOCTYPE html><html lang="ar" dir="rtl"><body style="font-family:sans-serif;padding:40px;text-align:center">'
            .'<h2>تم التفعيل</h2>'
            .'<p>'.e($status['vendor_name']).' — فعال '.$status['days_left'].' يوم</p>'
            .'<p>ينتهي: '.e((string) $status['expires_at']).'</p>'
            .'<p><a href="'.e(url('/system-account')).'">العودة للنظام</a></p>'
            .'</body></html>'
        );
    }

    public function hub()
    {
        $companies = $this->accounts->listCompanies();
        if (count($companies) === 0) {
            return view('system-account.app', [
                'slug' => '',
                'companyName' => 'نظام الحسابات',
                'unlocked' => false,
                'companies' => [],
                'hubMode' => true,
            ]);
        }

        return redirect()->to($companies[0]['url']);
    }

    public function companies()
    {
        return response()->json([
            'data' => $this->accounts->listCompanies(),
        ]);
    }

    public function searchVin(Request $request)
    {
        $data = $request->validate([
            'q' => ['required', 'string', 'min:3', 'max:64'],
        ]);

        return response()->json([
            'data' => $this->accounts->searchVinAcrossCompanies($data['q']),
        ]);
    }

    public function storeCompany(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['nullable', 'string', 'max:80', 'regex:/^[a-z0-9]+(?:-[a-z0-9]+)*$/'],
            'pin' => ['required', 'string', 'min:4', 'max:32'],
        ]);

        try {
            $slug = $this->accounts->makeSlugFromName($data['name'], $data['slug'] ?? null);
            $this->accounts->create($slug, $data['name'], $data['pin']);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 422);
        }

        return response()->json([
            'slug' => $slug,
            'name' => $data['name'],
            'url' => url('/system-account/'.$slug),
            'data' => $this->accounts->listCompanies(),
        ], 201);
    }

    public function destroyCompany(Request $request, string $companySlug)
    {
        $data = $request->validate([
            'password' => ['required', 'string', 'max:100'],
        ]);

        $expected = (string) config('services.system_account.delete_password');
        if ($expected === '' || ! hash_equals($expected, $data['password'])) {
            return response()->json(['message' => 'كلمة المرور غير صحيحة.'], 422);
        }

        try {
            $name = $this->accounts->deleteCompany($companySlug);
        } catch (\InvalidArgumentException $e) {
            return response()->json(['message' => $e->getMessage()], 404);
        }

        $request->session()->forget($this->accounts->sessionKey($companySlug));

        Log::info('system_account_company_soft_deleted', [
            'slug' => $companySlug,
            'name' => $name,
            'ip' => $request->ip(),
        ]);

        $companies = $this->accounts->listCompanies();

        return response()->json([
            'message' => 'تم إخفاء الشركة (نسخة طوارئ محفوظة)',
            'deleted' => ['slug' => $companySlug, 'name' => $name],
            'data' => $companies,
            'redirect' => count($companies) ? $companies[0]['url'] : url('/system-account'),
        ]);
    }

    public function show(string $slug)
    {
        $settings = $this->accounts->settings();

        return view('system-account.app', [
            'slug' => $slug,
            'companyName' => $settings->company_name ?? $slug,
            'unlocked' => (bool) session($this->accounts->sessionKey($slug)),
            'companies' => $this->accounts->listCompanies(),
            'hubMode' => false,
        ]);
    }

    public function unlock(Request $request, string $slug)
    {
        $request->validate(['pin' => ['required', 'string', 'max:32']]);
        $key = 'system-account-pin:'.$slug.':'.$request->ip();

        if (RateLimiter::tooManyAttempts($key, 8)) {
            return response()->json(['message' => 'محاولات كثيرة. حاول لاحقاً.'], 429);
        }

        if (! $this->accounts->verifyPin($request->input('pin'))) {
            RateLimiter::hit($key, 300);

            return response()->json(['message' => 'رمز PIN غير صحيح.', 'unlocked' => false], 422);
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

    public function stats()
    {
        return response()->json($this->accounts->stats());
    }

    public function dashboardData()
    {
        return response()->json([
            'batches' => $this->accounts->batches(),
            'remittances' => $this->accounts->remittances(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function storeBatch(Request $request)
    {
        $data = $request->validate([
            'car_type' => ['required', 'string', 'max:255'],
            'entry_date' => ['nullable', 'string', 'max:50'],
            'cars_count' => ['required', 'integer', 'min:0'],
            'unit_price' => ['required', 'numeric', 'min:0'],
        ]);

        $id = $this->accounts->createBatch($data);

        return response()->json([
            'id' => $id,
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ], 201);
    }

    public function updateBatch(Request $request, string $slug, int $id)
    {
        $data = $request->validate([
            'car_type' => ['sometimes', 'required', 'string', 'max:255'],
            'entry_date' => ['nullable', 'string', 'max:50'],
            'cars_count' => ['sometimes', 'required', 'integer', 'min:0'],
            'unit_price' => ['sometimes', 'required', 'numeric', 'min:0'],
        ]);

        if (! $this->accounts->updateBatch($id, $data)) {
            return response()->json(['message' => 'غير موجود'], 404);
        }

        return response()->json([
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function destroyBatch(string $slug, int $id)
    {
        if (! $this->accounts->deleteBatch($id)) {
            return response()->json(['message' => 'غير موجود'], 404);
        }

        return response()->json([
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function vehicles(string $slug, int $batchId)
    {
        abort_unless($this->accounts->findBatch($batchId), 404);

        return response()->json([
            'batch' => $this->accounts->findBatch($batchId),
            'vehicles' => $this->accounts->vehicles($batchId),
        ]);
    }

    public function storeVehicle(Request $request, string $slug, int $batchId)
    {
        abort_unless($this->accounts->findBatch($batchId), 404);

        $data = $request->validate([
            'vin' => ['required', 'string', 'max:32'],
            'model_name' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:100'],
            'model_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
        ]);

        $id = $this->accounts->createVehicle($batchId, $data);

        return response()->json([
            'id' => $id,
            'vehicles' => $this->accounts->vehicles($batchId),
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ], 201);
    }

    public function updateVehicle(Request $request, string $slug, int $batchId, int $id)
    {
        abort_unless($this->accounts->findBatch($batchId), 404);
        abort_unless($this->accounts->findVehicle($id), 404);

        $data = $request->validate([
            'vin' => ['required', 'string', 'max:32'],
            'model_name' => ['nullable', 'string', 'max:255'],
            'color' => ['nullable', 'string', 'max:100'],
            'model_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
        ]);

        $this->accounts->updateVehicle($id, $data);

        return response()->json([
            'vehicles' => $this->accounts->vehicles($batchId),
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function destroyVehicle(string $slug, int $batchId, int $id)
    {
        if (! $this->accounts->deleteVehicle($id)) {
            return response()->json(['message' => 'غير موجود'], 404);
        }

        return response()->json([
            'vehicles' => $this->accounts->vehicles($batchId),
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function importVehicles(Request $request, string $slug, int $batchId)
    {
        abort_unless($this->accounts->findBatch($batchId), 404);

        $request->validate([
            'file' => ['required', 'file', 'mimes:xlsx,xls,csv', 'max:10240'],
        ]);

        $imported = $this->excel->importVehicles($request->file('file'), $batchId);

        return response()->json([
            'imported' => $imported,
            'vehicles' => $this->accounts->vehicles($batchId),
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function importVehiclesText(Request $request, string $slug, int $batchId)
    {
        abort_unless($this->accounts->findBatch($batchId), 404);

        $data = $request->validate([
            'rows' => ['required', 'array', 'min:1'],
            'rows.*.vin' => ['required', 'string', 'max:64'],
            'rows.*.model_name' => ['nullable', 'string', 'max:255'],
            'rows.*.color' => ['nullable', 'string', 'max:100'],
            'rows.*.model_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],
        ]);

        $rows = [];
        $seen = [];
        foreach ($data['rows'] as $row) {
            $vin = strtoupper(preg_replace('/\s+/', '', trim((string) $row['vin'])) ?? '');
            if ($vin === '' || strcasecmp($vin, 'VIN') === 0) {
                continue;
            }
            if (isset($seen[$vin])) {
                continue;
            }
            $seen[$vin] = true;
            $rows[] = [
                'vin' => $vin,
                'model_name' => $row['model_name'] ?? null,
                'color' => $row['color'] ?? null,
                'model_year' => $row['model_year'] ?? null,
            ];
        }

        $imported = $this->accounts->importVehicles($batchId, $rows);

        return response()->json([
            'imported' => $imported,
            'vehicles' => $this->accounts->vehicles($batchId),
            'batches' => $this->accounts->batches(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function remittances()
    {
        return response()->json([
            'data' => $this->accounts->remittances(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function storeRemittance(Request $request)
    {
        $data = $request->validate([
            'amount' => ['required', 'numeric', 'min:0'],
            'transfer_date' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);

        $id = $this->accounts->createRemittance($data);

        return response()->json([
            'id' => $id,
            'data' => $this->accounts->remittances(),
            'stats' => $this->accounts->stats(),
        ], 201);
    }

    public function updateRemittance(Request $request, string $slug, int $id)
    {
        $data = $request->validate([
            'amount' => ['sometimes', 'required', 'numeric', 'min:0'],
            'transfer_date' => ['nullable', 'string', 'max:50'],
            'note' => ['nullable', 'string', 'max:2000'],
        ]);

        if (! $this->accounts->updateRemittance($id, $data)) {
            return response()->json(['message' => 'غير موجود'], 404);
        }

        return response()->json([
            'data' => $this->accounts->remittances(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function destroyRemittance(string $slug, int $id)
    {
        if (! $this->accounts->deleteRemittance($id)) {
            return response()->json(['message' => 'غير موجود'], 404);
        }

        return response()->json([
            'data' => $this->accounts->remittances(),
            'stats' => $this->accounts->stats(),
        ]);
    }

    public function export(string $slug)
    {
        return $this->excel->export($this->accounts->settings()->company_name);
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
        $rem = $this->accounts->findRemittance($id);
        abort_unless($rem, 404);
        $settings = $this->accounts->settings();
        $stats = $this->accounts->stats();

        return view('system-account.voucher', [
            'type' => $type,
            'title' => $type === 'receipt' ? 'وصول قبض' : 'وصول دفع',
            'companyName' => $settings->company_name,
            'slug' => $slug,
            'remittance' => $rem,
            'stats' => $stats,
        ]);
    }
}