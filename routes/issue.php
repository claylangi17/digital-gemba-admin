<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::middleware(['role:superadmin,admin'])->prefix('issue')->group(function () {
    Route::post('/create', [IssueController::class, 'create'])->name('issue.create');
});