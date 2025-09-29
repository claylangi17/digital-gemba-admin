<?php

use App\Http\Controllers\WebController;
use App\Http\Controllers\MediaProxyController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->middleware('role:superadmin,admin')->name('index');

// Media proxy route for external files with SSL bypass
Route::get('/media-proxy/{path}', [MediaProxyController::class, 'proxy'])
    ->where('path', '.*')
    ->name('media.proxy');