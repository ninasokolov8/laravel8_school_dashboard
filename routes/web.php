<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

//// Auth routes //////
Auth::routes();

//// Dashboard ////////
Route::prefix('admin')->middleware(['auth', 'role:ROLE_ADMIN'])->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\Admin\AdminController::class, 'index']);
    Route::get('/users', [App\Http\Controllers\Dashboard\Admin\AdminController::class, 'users'])->name('admin.users');

});
Route::prefix('teacher')->middleware(['auth', 'role:ROLE_TEACHER'])->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\Teacher\TeacherController::class, 'index']);

});
Route::prefix('student')->middleware(['auth', 'role:ROLE_STUDENT'])->group(function () {
    Route::get('/', [App\Http\Controllers\Dashboard\Student\StudentController::class, 'index']);
});

Route::get('/calendar', [App\Http\Controllers\Api\CalendarController::class, 'index'])->name('calendar.index');

////// API ///////
Route::resource('period', App\Http\Controllers\Api\PeriodController::class)->middleware(['auth', 'role:ROLE_STUDENT','role:ROLE_TEACHER']);
Route::resource('grade', App\Http\Controllers\Api\GradesController::class)->middleware(['auth', 'role:ROLE_TEACHER']);
Route::resource('user', App\Http\Controllers\Api\UserController::class)->middleware(['auth', 'role:ROLE_ADMIN']);
Route::resource('lessons', App\Http\Controllers\Api\LessonsController::class)->middleware(['auth']);
Route::resource('classes', App\Http\Controllers\Api\SchoolClassesController::class)->middleware(['auth']);




