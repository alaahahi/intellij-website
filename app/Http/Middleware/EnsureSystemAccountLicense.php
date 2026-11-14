<?php

namespace App\Http\Middleware;

use App\Services\SystemAccountLicenseService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureSystemAccountLicense
{
    public function __construct(private SystemAccountLicenseService $license)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        if ($this->license->isActive()) {
            return $next($request);
        }

        if ($request->expectsJson() || $request->ajax() || str_contains($request->path(), '/api/')) {
            return response()->json([
                'message' => 'انتهى التفعيل. يرجى تجديد الترخيص.',
                'license' => $this->license->status(),
            ], 402);
        }

        return $next($request);
    }
}
