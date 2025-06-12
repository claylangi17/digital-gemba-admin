<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppreciationController;

Route::middleware(['role:superadmin,admin'])->prefix('appreciation')->group(function () {
    Route::get('/', [AppreciationController::class, 'index'])->name('appreciation.index');
    Route::post('/note/create', [AppreciationController::class, 'create'])->name('appreciation.note.create');
});
