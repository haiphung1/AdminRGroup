<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;

Route::post('login', [LoginController::class, 'login']);

Route::middleware('api.auth')->group(function () {
    Route::get('logout', [LoginController::class, 'logout']);
});
