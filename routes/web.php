<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\MediaProxyController;
use App\Http\Controllers\SpinwheelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->middleware('role:superadmin,admin')->name('index');
Route::post('/set-factory', [App\Http\Controllers\DashboardController::class, 'setFactory'])->name('dashboard.set-factory');

// Spinwheel routes
Route::get('/spinwheel', [SpinwheelController::class, 'index'])->middleware('role:superadmin,admin')->name('spinwheel.index');
Route::get('/spinwheel/lines', [SpinwheelController::class, 'getLines'])->middleware('role:superadmin,admin')->name('spinwheel.lines');
Route::post('/spinwheel/lines', [SpinwheelController::class, 'store'])->middleware('role:superadmin,admin')->name('spinwheel.lines.store');
Route::put('/spinwheel/lines/{id}', [SpinwheelController::class, 'update'])->middleware('role:superadmin,admin')->name('spinwheel.lines.update');
Route::delete('/spinwheel/lines/{id}', [SpinwheelController::class, 'destroy'])->middleware('role:superadmin,admin')->name('spinwheel.lines.destroy');

// Media proxy route for external files with SSL bypass
Route::get('/media-proxy/{path}', [MediaProxyController::class, 'proxy'])
    ->where('path', '.*')
    ->name('media.proxy');