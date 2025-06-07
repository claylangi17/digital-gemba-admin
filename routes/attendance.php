<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;

Route::middleware(['role:superadmin,admin'])->prefix('attendance')->group(function () {
    Route::post('/create', [AttendanceController::class, 'create'])->name('attendance.create');
});