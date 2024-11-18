<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CourseController as AdminCourseController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\User\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

// Rutas de autenticación (Login, Register y Logout)
Route::get('login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('login', [AuthController::class, 'login']);
Route::get('register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('register', [AuthController::class, 'register']);
Route::post('logout', [AuthController::class, 'logout'])->name('logout');



// Rutas protegidas por autenticación PROFE
Route::middleware('auth')->group(function () {
    // Rutas de recursos para el controlador de Cursos
    Route::resource('courses', CourseController::class)->only(['index','show'])->names('courses');

    Route::resource('profile', ProfileController::class)->names('admin-profile');

});

// Rutas protegidas por autenticación ADMIN
Route::middleware('auth')->prefix('admin')->group(function () {
    Route::resource('admin',AdminController::class)->names('admin');
    Route::resource('users',AdminUserController::class)->only(['index','edit','update'])->names('admin-user');
    Route::resource('courses', AdminCourseController::class)->names('admin-course');
});



// Rutas protegidas por autenticación USER
Route::middleware('auth')->group(function () {
    Route::get('/user/profile', [UserController::class, 'profile'])->name('user.profile');
    Route::get('/user/profile/edit', [UserController::class, 'editProfile'])->name('user.profile.edit');
    Route::put('/user/profile', [UserController::class, 'updateProfile'])->name('user.profile.update');
    Route::delete('/user/profile', [UserController::class, 'destroyAccount'])->name('user.destroy');
    Route::get('user/enrolled', [UserController::class, 'enrolled'])->name('user.enrolled');
    // Ruta para inscribirse a un curso (POST)
    Route::post('user/{course}/enroll', [UserController::class, 'enroll'])->name('user.enroll');
    // Ruta para desinscribirse de un curso (DELETE)
    Route::delete('user/{course}/unenroll', [UserController::class, 'cancelEnrollment'])->name('user.unenroll');
});
