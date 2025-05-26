<?php

use App\Http\Controllers\GembaController;
use App\Http\Controllers\AnalyticController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->group(function () {

    Route::get('/gemba/analytics', [AnalyticController::class, 'index'])->name('gemba.analytics');
    
});