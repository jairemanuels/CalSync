<?php

namespace App\Http\Controllers;

use App\Jobs\importEvents;
use App\Models\User;
use App\Models\UserProvider;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;

class GoogleAuthController extends Controller
{
    public function redirect()
    {
        $providerName = 'google';
        return Socialite::driver($providerName)
        ->scopes(['https://www.googleapis.com/auth/calendar.events'])
        ->redirect();
    }

    public function callback(Request $request)
    {
        $providerName = 'google';
        $googleUser = Socialite::driver($providerName)->user();

        $userProvider = UserProvider::where([
            'provider_name' => $providerName,
            'provider_id' => $googleUser->getId(),
        ])->first();

        if(!$userProvider) {
           $user = User::create([
                'email' => $googleUser->getEmail(),
                'name' => $googleUser->getName(),
                'password' => bcrypt(Str::random(10)),
            ]);

            $userProvider = UserProvider::create([
                'provider_name' => $providerName,
                'provider_id' => $googleUser->getId(),
                'provider_token' => $googleUser->token,
                'user_id' => $user->id,
            ]);
        } else {
            $userProvider->update(['provider_token' => $googleUser->token]);
        }
        Auth::loginUsingId($userProvider->user_id);

        // importEvents::dispatch();

        return redirect('/week-view');
    }
}

