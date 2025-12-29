<?php

namespace App\Http\Middleware;

use App\Models\Visit;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TrackVisit
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // تسجيل الزيارة فقط للصفحات الرئيسية (GET requests)
        if ($request->isMethod('GET') && !$request->ajax()) {
            try {
                $this->recordVisit($request);
            } catch (\Exception $e) {
                // في حالة وجود خطأ، لا نوقف التطبيق
                \Log::error('Error recording visit: ' . $e->getMessage());
            }
        }

        return $response;
    }

    /**
     * تسجيل الزيارة في قاعدة البيانات
     */
    protected function recordVisit(Request $request)
    {
        $referer = $request->header('referer') ?? $request->server('HTTP_REFERER');
        $source = Visit::detectSource($referer);
        $userAgent = $request->userAgent();
        
        Visit::create([
            'ip_address' => $request->ip(),
            'user_agent' => $userAgent,
            'referer' => $referer,
            'source' => $source,
            'url' => $request->fullUrl(),
            'page' => $request->path(),
            'device' => Visit::detectDevice($userAgent),
            'browser' => Visit::detectBrowser($userAgent),
            'platform' => Visit::detectPlatform($userAgent),
            'visited_at' => now(),
        ]);
    }
}

