<?php

namespace App\Http\Controllers;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\TeamController;
use App\Models\TeamMember;
use App\Models\TeamRequest;

class TeamRequestController extends Controller
{

    public function createRequest($uuid)
    {
        // Find the team by the UUID
        $team = Team::where('id', $uuid)->firstOrFail();

        $user = auth()->user();

        // Check if the user is already part of the team
        if (TeamMember::where('user_id', $user->id)->where('team_id', $team->id)->exists()) {
            return redirect('/')->with('error', 'You are already part of this team.');
        }

        // Check if the user has already sent a request
        if (TeamRequest::where('user_id', $user->id)->where('team_id', $team->id)->exists()) {
            return redirect('/')->with('error', 'You have already sent a request to this team. Please wait for approval.');
        }
        // Create a new team request
        $teamRequest = new TeamRequest();
        $teamRequest->team_id = $team->id;
        $teamRequest->user_id = $user->id;
        $teamRequest->status = 'pending'; // or any other default status
        $teamRequest->save();


        return redirect('/')->with('success', 'Your request has been sent to the team owner.');
    }
}
