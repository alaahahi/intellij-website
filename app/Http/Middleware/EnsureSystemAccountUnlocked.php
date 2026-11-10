<?php

namespace App\Http\Middleware;

use App\Services\SystemAccountService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSystemAccountUnlocked
{
    public function __construct(private SystemAccountService $accounts)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $slug = (string) $request->route('slug');
        $key = $this->accounts->sessionKey($slug);

        if (! $request->session()->get($key)) {
            if ($request->expectsJson() || $request->is('*/api/*')) {
                return response()->json(['message' => 'PIN required.', 'unlocked' => false], 401);
            }

            return redirect()->route('system-account.show', $slug);
        }

        return $next($request);
    }
}
