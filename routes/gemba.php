<?php

use App\Http\Controllers\GembaController;
use App\Http\Controllers\AnalyticController;
use App\Http\Controllers\AppreciationController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->group(function () {

    Route::get('/genba/analytics', [AnalyticController::class, 'index'])->name('gemba.analytics');
    
    Route::get('/genba/history', [GembaController::class, 'index'])->name('gemba.history');

    // CRUDs
    Route::get('/genba/view/{id}', [GembaController::class, 'view'])->name('genba.view');
    Route::post('/genba/create', [GembaController::class, 'create'])->name('genba.create');

    Route::post('/appreciation/note/create', [AppreciationController::class, 'create'])->name('appreciation.note.create');
});