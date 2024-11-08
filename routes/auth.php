<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Platform\AuthController;

Route::middleware(['guest'])->group(function () {
    Route::get('/login', [AuthController::class, 'login'])->name('login');
});
