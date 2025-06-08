<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;

Route::middleware(['role:superadmin,admin'])->prefix('issue')->group(function () {
    Route::get('/view/{id}', [IssueController::class, 'view'])->name('issue.view');
    Route::post('/create', [IssueController::class, 'create'])->name('issue.create');
});