<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;

class GoogleLoginCallback extends Controller
{
    public function __invoke()
    {
        $user = Socialite::driver('google')->user();
        dd($user);
    }
}
