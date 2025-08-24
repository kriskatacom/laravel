<?php

use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\Auth\NewPasswordController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\UserController;

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
    return view('index/home');
});

// Route::get('/users/register', function () {
//     return view('users/register');
// });

// Route::get('/users/login', function () {
//     return view('users/login');
// });

// Route::get('/users/password-reset', function () {
//     return view('users/password-reset');
// });

Route::get('/users/register', [UserController::class, 'showRegister'])->middleware("guest");
Route::post('/users/register', [UserController::class, 'register'])->middleware("guest");

Route::get('/users/login', [UserController::class, 'showLogin'])->middleware("guest")->name("login");
Route::post('/users/login', [UserController::class, 'login'])->middleware("guest");

Route::get('/users/password-reset', [UserController::class, 'showPasswordReset'])->middleware('guest');
Route::post('/users/password-reset', [UserController::class, 'passwordReset'])->middleware('guest');

Route::get('/reset-password/{token}', [NewPasswordController::class, 'create'])
    ->middleware('guest')
    ->name('password.reset');

Route::post('/reset-password', [NewPasswordController::class, 'store'])
    ->middleware('guest')
    ->name('password.update');

Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

Route::get('/dashboard', [AdminDashboardController::class, 'index'])
    ->name('dashboard')
    ->middleware(['auth', 'admin']);

Route::prefix('dashboard')->name('dashboard.')->middleware(['auth', 'admin'])->group(function () {
    Route::resource('categories', CategoryController::class);
});