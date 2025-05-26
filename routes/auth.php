<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/forget-password', function () {
    return view('forget');
})->name('forget-password');

Route::get('/reset-password', function () {
    return view('reset');
})->name('reset-password');

Route::get('/login', [AuthController::class, 'index'])->name('auth.login');
Route::post('/login', [AuthController::class, 'login'])->name('auth.login.attempt');
Route::get('/logout', [AuthController::class, 'logout'])->name('auth.logout.attempt');

Route::get('/forget-password', [AuthController::class, 'indexForget'])->name('auth.forget');
Route::post('/forget-password', [AuthController::class, 'forget'])->name('auth.forget.attempt');

Route::post('/reset-password-apply', [AuthController::class, 'reset'])->name('auth.reset.attempt');
Route::get('/reset-password/{token}', [AuthController::class, 'indexReset'])->name('auth.reset');