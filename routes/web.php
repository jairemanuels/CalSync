<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GoogleEventsController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/day-view', function () {
    return view('day-view') ->name('day-view');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->get('/importevents', [GoogleEventsController::class, 'importEvents']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect'])->name('redirect');

Route::get('/auth/callback', [GoogleAuthController::class, 'callback']);

require __DIR__.'/auth.php';
