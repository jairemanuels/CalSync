<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;

class PlatformController extends Controller
{
    public function index()
    {
        $events = Event::query()->where('user_id', auth()->user()->id)->get();
        $teams = Team::where('owner_id', auth()->id())->get();
        


        return view(
            'platform::index',
            compact('events', 'teams')

        );
    }

    public function customers()
    {
        return view('platform::customers.index');
    }
}
