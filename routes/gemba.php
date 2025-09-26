<?php

use App\Http\Controllers\GembaController;
use App\Http\Controllers\AnalyticController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->prefix('genba')->group(function () {

    Route::get('/analytics', [AnalyticController::class, 'index'])->name('gemba.analytics');
    Route::get('/history', [GembaController::class, 'index'])->name('genba.history');

    // CRUDs
    Route::get('/view/{id}', [GembaController::class, 'view'])->name('genba.view');
    Route::post('/create', [GembaController::class, 'create'])->name('genba.create');    
    Route::post('/close', [GembaController::class, 'close'])->name('genba.close');
    Route::delete('/delete/{id}', [GembaController::class, 'delete'])->name('genba.delete');
});