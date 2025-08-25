<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\TodoController;
use Illuminate\Support\Facades\Auth;

// Google OAuth Routes
Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google.redirect');
Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback']);

// Dashboard route (protected by 'auth' middleware)
Route::middleware('auth')->get('/dashboard', function () {
    $user = Auth::user();
    return view('dashboard', compact('user'));
})->name('dashboard');

// Login route (updated to use welcome.blade.php)
Route::middleware('guest')->get('/login', function () {
    return view('welcome');
})->name('login');

// Logout route
Route::post('/logout', function () {
    Auth::logout();
    session()->invalidate();
    session()->regenerateToken();
    return redirect('/login')->with('status', 'You have been logged out!');
})->name('logout');

// Calendar route
Route::middleware('auth')->get('/calendar', [CalendarController::class, 'index'])->name('calendar');

// Email route
Route::middleware('auth')->get('/email', [EmailController::class, 'index'])->name('email');

// Todos route
Route::middleware('auth')->get('/todos', [TodoController::class, 'index'])->name('todos');