<?php

namespace App\Http\Middleware;

use App\Services\SystemAccountService;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SystemAccountAccess
{
    public function __construct(private SystemAccountService $accounts)
    {
    }

    public function handle(Request $request, Closure $next): Response
    {
        $slug = (string) $request->route('slug');

        try {
            if (! $this->accounts->exists($slug)) {
                abort(404, 'System account not found.');
            }

            $this->accounts->connect($slug);
        } catch (\InvalidArgumentException $e) {
            abort(404, $e->getMessage());
        }

        $request->attributes->set('system_account_slug', $this->accounts->normalizeSlug($slug));

        return $next($request);
    }
}
