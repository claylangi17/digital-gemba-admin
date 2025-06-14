<?php

use App\Http\Controllers\RootCauseController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->prefix('root-cause')->group(function () {
    Route::post('/create', [RootCauseController::class, 'create'])->name('cause.create');
    Route::post('/update', [RootCauseController::class, 'update'])->name('cause.update');
    Route::delete('/delete/{id}', [RootCauseController::class, 'delete'])->name('cause.delete');
});