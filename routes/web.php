<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.index');
})->name('home');

Route::get('/about', function () {
    return view('pages.about');
})->name('about');

Route::get('/service', function () {
    return view('pages.service');
})->name('service');

Route::get('/contact', function () {
    return view('pages.contact');
})->name('contact');

Route::get('/contracts-system', function () {
    return view('pages.contracts-system');
})->name('contracts-system');

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

// Routes for visits tracking (admin)
Route::prefix('admin')->group(function () {
    Route::get('/visits', [\App\Http\Controllers\VisitController::class, 'index'])->name('admin.visits.index');
    Route::get('/visits/stats', [\App\Http\Controllers\VisitController::class, 'stats'])->name('admin.visits.stats');
});
