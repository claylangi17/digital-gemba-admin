<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

Route::middleware(['role:superadmin,admin'])->group(function () {

    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::post('/users/create', [UserController::class, 'create'])->name('users.create');
    Route::delete('/users/delete/{id}', [UserController::class, 'delete'])->name('users.delete');
    
});

