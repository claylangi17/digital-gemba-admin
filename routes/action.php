<?php

use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->prefix('action')->group(function () {
    Route::post('/update', [ActionController::class, 'update'])->name('action.update');
});