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
        // $uri = $_SERVER['REQUEST_URI'];
        // $currentUuid = preg_replace('#^/teams/|/calendar$#', '', $uri);
        // $currentPage = preg_replace('#^/teams/' . $currentUuid . '/|/calendar$#', '', $uri);
        // $SelectTeam = Team::where('id', $currentUuid)->firstOrFail();
        $events = Event::query()->where('user_id', auth()->user()->id)->get();
        $teams = Team::where('owner_id', auth()->id())->get();
        // $teamMember = TeamMember::where('team_id', $SelectTeam->id)->get();

        $teamMembers = [];




        return view(
            'platform::index',
            compact('events', 'teams', 'teamMembers'),

        );
    }

    public function customers()
    {
        return view('platform::customers.index', ['teamMembers' => []]);
    }
}
