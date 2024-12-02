<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function showCalendar(string $uuid)
    {
        $SelectTeam = Team::where('id', $uuid)->firstOrFail();
        $teams = Team::where('owner_id', auth()->id())->get();
        $events = $SelectTeam->event;
        $teamMember = TeamMember::where('team_id', $SelectTeam->id)->get();

        $teamMembers = [];
        foreach ($teamMember as $member) {
            $teamMembers[] = $member;
        }



        return view('platform::index', compact('teams', 'SelectTeam', 'events', 'teamMembers'));
    }
}
