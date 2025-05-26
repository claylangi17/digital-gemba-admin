<?php

use App\Http\Controllers\WebController;
use Illuminate\Support\Facades\Route;

Route::get('/', [WebController::class, 'index'])->middleware('role:superadmin,admin')->name('index');


Route::get('/users', function () {
    return view('users');
})->name('users');