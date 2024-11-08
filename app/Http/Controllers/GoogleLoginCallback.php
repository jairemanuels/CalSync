<?php

namespace App\Http\Controllers;

use App\Livewire\Platform\Projects\SetupWizard;
use App\Models\Team;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class GoogleLoginCallback extends Controller
{
    public function __invoke()
    {
        $providerName = 'google';
        $googleUser = Socialite::driver($providerName)->stateless()->user();

        $password =  Str::password(12);

        $loginUser = User::updateOrCreate([
            'email' => $googleUser->email,
        ], [
            'uuid' => Str::uuid(),
            'name' => $googleUser->name,
            'provider_id' => $googleUser->id,
            'provider_name' => $providerName,
            'password' => $password,
            'provider_token' => $googleUser->token,
        ]);

        Auth::login($loginUser);

        $events =  new GoogleEventsController();
        $events->importEvents();
        if (Team::where('owner_id', auth()->id())->exists()) {
            return redirect('/')->with('success', 'Welcome back!');
        } else {
            return view('platform::projects.create');
        }
    }
}
