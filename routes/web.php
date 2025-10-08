<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\MediaProxyController;
use App\Http\Controllers\SpinwheelController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->middleware('role:superadmin,admin')->name('index');

// Spinwheel routes
Route::get('/spinwheel', [SpinwheelController::class, 'index'])->middleware('role:superadmin,admin')->name('spinwheel.index');
Route::get('/spinwheel/lines', [SpinwheelController::class, 'getLines'])->middleware('role:superadmin,admin')->name('spinwheel.lines');

// Media proxy route for external files with SSL bypass
Route::get('/media-proxy/{path}', [MediaProxyController::class, 'proxy'])
    ->where('path', '.*')
    ->name('media.proxy');