<?php

namespace App\Http\Controllers;

use App\Models\Event;
use App\Models\Team;
use App\Models\TeamEvents;
use App\Models\TeamMember;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function showCalendar(string $uuid)
    {
        $SelectTeam = Team::where('id', $uuid)->firstOrFail();
        $teams = Team::where('owner_id', auth()->id())->get();

        $teamId = $SelectTeam->id;

        $teamMemberList = TeamMember::where('team_id', $SelectTeam->id)->get();
        $teamEventList = TeamEvents::where($teamId, $uuid)->get();

        $teamMembers = TeamMember::where('team_id', $SelectTeam->id)->get();

        $teamEvents = TeamEvents::where('team_id', $teamId)->get();

        return view('platform::index', compact('teams', 'teamEvents', 'SelectTeam', 'teamMembers'));
    }
}
