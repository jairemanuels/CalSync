<?php

namespace App\Http\Controllers\Platform;

use App\Http\Controllers\Controller;
use App\Models\Event;
use App\Models\Team;
use App\Models\TeamMember;
use App\Services\teamMemberService;

class PlatformController extends Controller
{

    public function index()
    {

        $events = Event::query()->where('user_id', auth()->user()->id)->get();
        $teams = Team::where('owner_id', auth()->id())->get();
        $teamMembers = [];
        $teamEvents = [];

        return view(
            'platform::index',
            compact('events', 'teams', 'teamMembers', 'teamEvents'),

        );
    }

    public function customers()
    {
        return view('platform::customers.index', ['teamMembers' => []], ['teamEvents' => []]);
    }
}
