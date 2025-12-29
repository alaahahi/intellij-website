<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        \Illuminate\Pagination\Paginator::defaultView('vendor.pagination.bootstrap-5');
        
        // إصلاح مسار الـ assets عند نقل index.php خارج public
        // هذا يضمن أن asset() helper يعمل بشكل صحيح
        $appUrl = config('app.url');
        \Illuminate\Support\Facades\URL::forceRootUrl($appUrl);
        
        // إذا كان index.php في الجذر وليس في public، أضف /public للمسار في asset helper
        if (file_exists(base_path('index.php')) && !file_exists(public_path('index.php'))) {
            // استخدام Macro لتعديل asset helper
            \Illuminate\Support\Facades\URL::macro('asset', function ($path) use ($appUrl) {
                $path = ltrim($path, '/');
                return $appUrl . '/public/' . $path;
            });
        }
    }
}

