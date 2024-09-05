<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DateController;
use App\Http\Controllers\GoogleAuthController;
use App\Http\Controllers\GoogleEventsController;
use App\Http\Controllers\User\LoginAction;
use App\Http\Controllers\User\ListAction as UserListAction;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\User\RetrieveAction as UserRetrieveAction;
use App\Models\Event;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/signup', function () {
    return view('signup');
})->name('signup');

Route::post('/login-auth', LoginAction::class)->name('login-auth');

// Route::get('/day-view', function () {
//     return view('day-view')->name('day-view')->middleware('auth');
// });
Route::get('/week-view', [DashboardController::class, 'curWeekCal'])->middleware(['auth', 'verified'])->name('week-view')
->middleware('auth');
Route::get('/month-view', [DashboardController::class, 'curMonthCal'])->middleware(['auth', 'verified'])->name('month-view')
->middleware('auth');

Route::middleware('auth')->get('/importevents', [GoogleEventsController::class, 'importEvents']);

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/auth/google/redirect', [GoogleAuthController::class, 'redirect'])->name('google-redirect');

Route::get('/auth/google/callback', [GoogleAuthController::class, 'callback'])->name('callback');
Route::get('/users/list', UserListAction::class);
Route::get('users/me', UserRetrieveAction::class);


require __DIR__ . '/auth.php';
