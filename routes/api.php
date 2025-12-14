<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

// API Routes for Visits Dashboard
Route::prefix('visits')->group(function () {
    Route::get('/list', [\App\Http\Controllers\VisitController::class, 'apiList'])->name('api.visits.list');
    Route::get('/stats', [\App\Http\Controllers\VisitController::class, 'stats'])->name('api.visits.stats');
});
