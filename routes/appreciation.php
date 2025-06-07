<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AppreciationController;

Route::middleware(['role:superadmin,admin'])->prefix('appreciation')->group(function () {
    Route::post('/note/create', [AppreciationController::class, 'create'])->name('appreciation.note.create');
});
