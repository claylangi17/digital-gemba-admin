<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\IssueController;
use App\Http\Controllers\IssueFileController;

Route::middleware(['role:superadmin,admin'])->prefix('issue')->group(function () {
    Route::get('/view/{id}', [IssueController::class, 'view'])->name('issue.view');
    Route::post('/create', [IssueController::class, 'create'])->name('issue.create');
    Route::post('/update', [IssueController::class, 'update'])->name('issue.update');
    Route::post('/close', [IssueController::class, 'close'])->name('issue.close');
    Route::delete('/delete/{id}', [IssueController::class, 'delete'])->name('issue.delete');
});

Route::middleware(['role:superadmin,admin'])->prefix('issue/file')->group(function () {
    Route::post('/create', [IssueFileController::class, 'create'])->name('issue.file.create');
});