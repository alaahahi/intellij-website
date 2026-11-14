<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VisitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CacheController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\VideoController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Public Routes
Route::get('/', function () {
    return view('pages.index');
})->name('home');

// Clear Cache Route (يمكن حذفها في الإنتاج)
Route::get('/clear-cache', function () {
    Artisan::call('optimize:clear');
    return redirect()->back()->with('success', 'تم مسح الكاش بنجاح!');
})->name('clear-cache');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/service', function () {
    return view('pages.service');
})->name('service');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::post('/contact', [App\Http\Controllers\ContactController::class, 'store'])->name('contact.store');

Route::get('/contracts-system', function () {
    return view('pages.contracts-system');
})->name('contracts-system');

Route::get('/accounting-system', function () {
    return view('pages.accounting-system');
})->name('accounting-system');

Route::get('/dream-city-mall', function () {
    return view('pages.dream-city-mall');
})->name('dream-city-mall');

// CSS Card landing page (empty for now). Visits tracked via TrackVisit middleware (supports ?source=qr)
Route::get('/css-card', function () {
    return view('pages.css-card');
})->name('css-card');

// Velora QR → Instagram redirect (supports ?source=qr&from=bag&to=Instagram)
Route::get('/velora', function () {
    return view('pages.velora');
})->name('velora');
Route::get('/velora/', function () {
    return view('pages.velora');
});

Route::get('/shipping-system', function () {
    return view('pages.shipping-system');
})->name('shipping-system');

// Isolated SQLite system accounts (PIN + per-company ledger)
Route::get('/system-account', [App\Http\Controllers\SystemAccountController::class, 'hub'])->name('system-account.hub');
Route::get('/system-account/api/license', [App\Http\Controllers\SystemAccountController::class, 'license'])
    ->name('system-account.license');
Route::match(['get', 'post'], '/system-account/activate/{days?}', [App\Http\Controllers\SystemAccountController::class, 'activate'])
    ->whereNumber('days')
    ->middleware('throttle:10,1')
    ->name('system-account.activate');
Route::get('/system-account/api/companies', [App\Http\Controllers\SystemAccountController::class, 'companies'])
    ->name('system-account.companies');
Route::get('/system-account/api/search-vin', [App\Http\Controllers\SystemAccountController::class, 'searchVin'])
    ->middleware('throttle:60,1')
    ->name('system-account.search-vin');
Route::post('/system-account/api/companies', [App\Http\Controllers\SystemAccountController::class, 'storeCompany'])
    ->middleware(['throttle:10,1', 'system.account.license'])
    ->name('system-account.companies.store');
Route::delete('/system-account/api/companies/{companySlug}', [App\Http\Controllers\SystemAccountController::class, 'destroyCompany'])
    ->middleware(['throttle:10,1', 'system.account.license'])
    ->name('system-account.companies.destroy');

Route::prefix('system-account/{slug}')
    ->middleware(['system.account'])
    ->group(function () {
        Route::get('/', [App\Http\Controllers\SystemAccountController::class, 'show'])->name('system-account.show');
        Route::post('/unlock', [App\Http\Controllers\SystemAccountController::class, 'unlock'])
            ->middleware('throttle:20,1')
            ->name('system-account.unlock');
        Route::get('/api/status', [App\Http\Controllers\SystemAccountController::class, 'status'])->name('system-account.status');
        Route::get('/api/companies', [App\Http\Controllers\SystemAccountController::class, 'companies'])->name('system-account.companies.slug');

        Route::middleware('system.account.unlocked')->group(function () {
            Route::post('/lock', [App\Http\Controllers\SystemAccountController::class, 'lock'])->name('system-account.lock');
            Route::get('/api/stats', [App\Http\Controllers\SystemAccountController::class, 'stats'])->name('system-account.stats');
            Route::get('/api/dashboard', [App\Http\Controllers\SystemAccountController::class, 'dashboardData'])->name('system-account.dashboard');

            Route::middleware('system.account.license')->group(function () {
                Route::post('/api/batches', [App\Http\Controllers\SystemAccountController::class, 'storeBatch'])->name('system-account.batches.store');
                Route::put('/api/batches/{id}', [App\Http\Controllers\SystemAccountController::class, 'updateBatch'])->name('system-account.batches.update');
                Route::delete('/api/batches/{id}', [App\Http\Controllers\SystemAccountController::class, 'destroyBatch'])->name('system-account.batches.destroy');

                Route::post('/api/batches/{batchId}/vehicles', [App\Http\Controllers\SystemAccountController::class, 'storeVehicle'])->name('system-account.vehicles.store');
                Route::put('/api/batches/{batchId}/vehicles/{id}', [App\Http\Controllers\SystemAccountController::class, 'updateVehicle'])->name('system-account.vehicles.update');
                Route::delete('/api/batches/{batchId}/vehicles/{id}', [App\Http\Controllers\SystemAccountController::class, 'destroyVehicle'])->name('system-account.vehicles.destroy');
                Route::post('/api/batches/{batchId}/vehicles/import', [App\Http\Controllers\SystemAccountController::class, 'importVehicles'])->name('system-account.vehicles.import');
                Route::post('/api/batches/{batchId}/vehicles/import-text', [App\Http\Controllers\SystemAccountController::class, 'importVehiclesText'])->name('system-account.vehicles.import-text');

                Route::post('/api/remittances', [App\Http\Controllers\SystemAccountController::class, 'storeRemittance'])->name('system-account.remittances.store');
                Route::put('/api/remittances/{id}', [App\Http\Controllers\SystemAccountController::class, 'updateRemittance'])->name('system-account.remittances.update');
                Route::delete('/api/remittances/{id}', [App\Http\Controllers\SystemAccountController::class, 'destroyRemittance'])->name('system-account.remittances.destroy');
            });

            Route::get('/api/batches/{batchId}/vehicles', [App\Http\Controllers\SystemAccountController::class, 'vehicles'])->name('system-account.vehicles');
            Route::get('/api/remittances', [App\Http\Controllers\SystemAccountController::class, 'remittances'])->name('system-account.remittances');
            Route::get('/api/export', [App\Http\Controllers\SystemAccountController::class, 'export'])->name('system-account.export');
            Route::get('/vouchers/{id}/receipt', [App\Http\Controllers\SystemAccountController::class, 'voucherReceipt'])->name('system-account.voucher.receipt');
            Route::get('/vouchers/{id}/payment', [App\Http\Controllers\SystemAccountController::class, 'voucherPayment'])->name('system-account.voucher.payment');
        });
    });

Route::get('/feature', function () {
    return view('pages.feature');
})->name('feature');

Route::get('/testimonial', function () {
    return view('pages.testimonial');
})->name('testimonial');

Route::get('/pricing', function () {
    return view('pages.pricing');
})->name('pricing');

Route::get('/blog', function () {
    return view('pages.blog');
})->name('blog');

Route::get('/sitemap', function () {
    return view('pages.sitemap');
})->name('sitemap-page');

// SEO Routes
Route::get('/robots.txt', [SitemapController::class, 'robots'])->name('robots');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

// Authentication Routes
require __DIR__.'/auth.php';

// Authenticated Routes
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', function () {
        return redirect()->route('admin.dashboard');
    })->name('dashboard');
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Admin Routes
Route::prefix('admin')->middleware(['auth', 'verified'])->group(function () {
    Route::get('/', [VisitController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/visits', [VisitController::class, 'index'])->name('admin.visits.index');
    Route::get('/visits/stats', [VisitController::class, 'stats'])->name('admin.visits.stats');
    
    // Users Management
    Route::resource('users', UserController::class)->names([
        'index' => 'admin.users.index',
        'create' => 'admin.users.create',
        'store' => 'admin.users.store',
        'edit' => 'admin.users.edit',
        'update' => 'admin.users.update',
        'destroy' => 'admin.users.destroy',
    ]);
    
    // Contact Requests Management
    Route::get('/contact-requests', [ContactController::class, 'index'])->name('admin.contact-requests.index');
    Route::get('/contact-requests/{contactRequest}', [ContactController::class, 'show'])->name('admin.contact-requests.show');
    Route::patch('/contact-requests/{contactRequest}/status', [ContactController::class, 'updateStatus'])->name('admin.contact-requests.update-status');
    Route::delete('/contact-requests/{contactRequest}', [ContactController::class, 'destroy'])->name('admin.contact-requests.destroy');
    
    // Cache Management
    Route::get('/cache', [CacheController::class, 'index'])->name('admin.cache.index');
    Route::post('/cache/clear', [CacheController::class, 'clear'])->name('admin.cache.clear');
    Route::get('/cache/info', [CacheController::class, 'info'])->name('admin.cache.info');
    
    // Video Management
    Route::resource('videos', VideoController::class)->names([
        'index' => 'admin.videos.index',
        'create' => 'admin.videos.create',
        'store' => 'admin.videos.store',
        'edit' => 'admin.videos.edit',
        'update' => 'admin.videos.update',
        'destroy' => 'admin.videos.destroy',
    ]);
});
