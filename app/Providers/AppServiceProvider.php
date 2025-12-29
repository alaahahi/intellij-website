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
        
        // إذا كان index.php في الجذر وليس في public، أضف /public للمسار
        if (file_exists(base_path('index.php')) && !file_exists(public_path('index.php'))) {
            // تعديل asset helper ليعيد /public/... بدلاً من /...
            \Illuminate\Support\Facades\URL::forceRootUrl($appUrl);
            
            // Override asset helper
            if (!function_exists('asset')) {
                function asset($path)
                {
                    $path = ltrim($path, '/');
                    return config('app.url') . '/public/' . $path;
                }
            }
        } else {
            \Illuminate\Support\Facades\URL::forceRootUrl($appUrl);
        }
    }
}

