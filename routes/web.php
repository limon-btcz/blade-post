<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PostController;

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

Route::controller(AuthController::class)->prefix('auth')->middleware('guest')->group(function() {
  // auth views
  Route::view('login', 'auth.login')->name('login.form');
  Route::view('registration', 'auth.register')->name('register.form');
  Route::view('verify/notice', 'auth.verify_notice')->name('verification.notice');
  Route::view('forgot_password', 'auth.forgot_password')->name('password.email.form');
    
  Route::post('login', 'login')->name('login');
  Route::post('registration', 'registration')->name('register');

  // forgot password routes
  Route::get('reset_password/{token}', 'reset_password_form')->name('password.reset.form');
  Route::post('forgot_password', 'forgot_password')->name('password.email');
  Route::post('reset_password', 'reset_password')->name('password.reset');

  // verification routes
  Route::get('verify', 'verify')->name('verification.verify');
  Route::get('verify/resend_code', 'resend_email_verification')->name('verification.send');
});

Route::middleware(['auth', 'verified'])->group(function() {
  Route::get('/auth/logout', [AuthController::class, 'logout'])->name('logout');
  Route::get('/', [PostController::class, 'index'])->name('posts.index');
  Route::resource('posts', PostController::class)->except('index');
});

// public route
// if we want to make this routes dynamic
// we need to add a role_id column to users table.
// to maintain public routes.
// and also need database tables to store data.
Route::view('/about_us', 'pages.about')->name('about_us');