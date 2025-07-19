<?php

use App\Http\Controllers\ActionCompletionFileController;
use App\Http\Controllers\AppreciationNoteFileController;
use App\Http\Controllers\IssueFileController;
use App\Http\Controllers\RootCauseFileController;
use App\Http\Controllers\UserCoverPhotoController;
use App\Http\Controllers\UserProfilePhotoController;
use Illuminate\Support\Facades\Route;

Route::prefix("issue/files")->group(function() {
    Route::post('/upload', [IssueFileController::class, 'create_api']);
    Route::get('/get/{issue_id}', [IssueFileController::class, 'get_api']);
    Route::delete('/delete/{file_id}', [IssueFileController::class, 'delete_api']);
});

Route::prefix("root-cause/files")->group(function() {
    Route::post('/upload', [RootCauseFileController::class, 'create_api']);
    Route::get('/get/{cause_id}', [RootCauseFileController::class, 'get_api']);
    Route::delete('/delete/{file_id}', [RootCauseFileController::class, 'delete_api']);
});

Route::prefix("action/completion/files")->group(function() {
    Route::post('/upload', [ActionCompletionFileController::class, 'create_api']);
    Route::get('/get/{action_id}', [ActionCompletionFileController::class, 'get_api']);
    Route::delete('/delete/{file_id}', [ActionCompletionFileController::class, 'delete_api']);
});

Route::prefix("appreciation/note/files")->group(function() {
    Route::post('/upload', [AppreciationNoteFileController::class, 'create_api']);
    Route::get('/get/{action_id}', [AppreciationNoteFileController::class, 'get_api']);
    Route::delete('/delete/{file_id}', [AppreciationNoteFileController::class, 'delete_api']);
});

Route::prefix("user/photos/profile")->group(function() {
    Route::post('/upload', [UserProfilePhotoController::class, 'create_api']);
    Route::get('/get/{action_id}', [UserProfilePhotoController::class, 'get_api']);
    Route::delete('/delete/{file_id}', [UserProfilePhotoController::class, 'delete_api']);
});

Route::prefix("user/photos/cover")->group(function() {
    Route::post('/upload', [UserCoverPhotoController::class, 'create_api']);
    Route::get('/get/{action_id}', [UserCoverPhotoController::class, 'get_api']);
    Route::delete('/delete/{file_id}', [UserCoverPhotoController::class, 'delete_api']);
});
