<?php

use App\Http\Controllers\GoogleLogin;
use App\Http\Controllers\GoogleLoginCallback;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Platform\ProjectsController;
use App\Http\Controllers\Platform\PlatformController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\AcceptMember;

Route::get('/auth/sso/google/redirect', GoogleLogin::class);
Route::get('/auth/sso/google/callback', GoogleLoginCallback::class);

Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/projects/create', [ProjectsController::class, 'create'])->name('projects.create');
    Route::get('/teams/{uuid}/calendar', [TeamController::class, 'showCalendar'])->name('teams.calendar');

});


Route::middleware(['web', 'auth'])->group(function () {
    Route::get('/', [PlatformController::class, 'index'])->name('platform.index');

    Route::prefix('/customers')->group(function () {
        Route::get('/', [PlatformController::class, 'customers'])->name('platform.customers.index');
    });
});


