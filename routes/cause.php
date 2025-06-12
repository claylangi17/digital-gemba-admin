<?php

use App\Http\Controllers\RootCauseController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->prefix('root-cause')->group(function () {
    Route::delete('/delete/{id}', [RootCauseController::class, 'delete'])->name('cause.delete');
});