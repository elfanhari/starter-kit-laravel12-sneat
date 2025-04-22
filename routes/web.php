<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Auth::logout();
// Auth::loginUsingId(2);
Route::get('/', function () {
  if (Auth::check()) {
    return redirect(route('dashboard.index'))->with('info', 'Anda masih dalam sesi');
  } else {
    // return redirect('/login')->with('info', 'anda belum login');
    return view('welcome');
  }
})->name('home');

Route::middleware('guest')->group(function () {
  Route::get('/login', [AuthController::class, 'login'])->name('login');
  Route::get('/register', [AuthController::class, 'register'])->name('register');
  Route::post('/login', [AuthController::class, 'storeLogin'])->name('login');
  Route::post('/register', [AuthController::class, 'storeRegister'])->name('register');
});

Route::middleware('auth')->group(function () {
  Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard.index');
  Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

  Route::resource('user', UserController::class);
  Route::get('user', [UserController::class, 'index2'])->name('user.index');
  Route::post('/user/delete-multiple', [UserController::class, 'deleteMultiple'])->name('user.deleteMultiple');

  Route::get('/profile', [ProfileController::class, 'index'])->name('profile.index');
  Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
});
