<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GoogleEventsController;
use App\Http\Controllers\ProfileController;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::get('/day-view', function () {
    return view('day-view')->name('day-view');
});
Route::get('/week-view', [DashboardController::class, 'curWeekCal'])->middleware(['auth', 'verified'])->name('week-view');
Route::get('/month-view', [DashboardController::class, 'curMonthCal'])->middleware(['auth', 'verified'])->name('month-view');

Route::middleware('auth')->get('/importevents', [GoogleEventsController::class, 'importEvents']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/redirect', [GoogleAuthController::class, 'redirect'])->name('redirect');

Route::get('/auth/callback', [GoogleAuthController::class, 'callback'])->name('callback');

Route::post('/add-week', [DateController::class, 'addWeek'])->name('add.week');
Route::post('/sub-week', [DateController::class, 'subWeek'])->name('sub.week');
Route::post('/add-month', [DateController::class, 'addMonth'])->name('add.month');
Route::post('/sub-month', [DateController::class, 'subMonth'])->name('sub.month');


require __DIR__ . '/auth.php';
