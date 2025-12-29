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
        \Illuminate\Support\Facades\URL::forceRootUrl(config('app.url'));
    }
}

