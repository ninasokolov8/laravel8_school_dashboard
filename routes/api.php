<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


    Route::middleware(['auth', 'role:ROLE_STUDENT','role:ROLE_TEACHER'])->resource('period', App\Http\Controllers\Api\PeriodController::class);
    Route::middleware(['auth', 'role:ROLE_STUDENT','role:ROLE_TEACHER'])->resource('grade', App\Http\Controllers\Api\GradesController::class);
    Route::middleware(['auth', 'role:ROLE_ADMIN'])->resource('user', App\Http\Controllers\Api\UserController::class);

