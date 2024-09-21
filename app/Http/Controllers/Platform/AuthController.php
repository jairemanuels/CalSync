<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function login()
    {
        return view('platform::auth.login');
    }

    public function register()
    {
        return view('platform::auth.register');
    }
}
