<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class GoogleLogin extends Controller
{
    public function __invoke(Request $request)
    {
        return Socialite::driver('google')->redirect();
    }
}
