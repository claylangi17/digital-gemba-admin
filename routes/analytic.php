<?php

use App\Http\Controllers\AnalyticController;
use Illuminate\Support\Facades\Route;

Route::middleware(['role:superadmin,admin'])->prefix('analytic')->group(function () {

});