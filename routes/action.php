<?php

use App\Http\Controllers\ActionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->prefix('action')->group(function () {
    Route::post('/create', [ActionController::class, 'create'])->name('action.create');
    Route::post('/update', [ActionController::class, 'update'])->name('action.update');
    Route::post('/complete', [ActionController::class, 'complete'])->name('action.complete');
    Route::delete('/delete/{id}', [ActionController::class, 'delete'])->name('action.delete');
});