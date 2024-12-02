<?php

namespace App\Http\Controllers;

use App\Models\Event as ModelsEvent;
use App\Models\TeamEvents;
use App\Models\TeamRequest;
use App\Models\User;
use App\Models\Event;

class AcceptMember extends Controller
{
    public function accept($requestId)
    {
        $request = TeamRequest::findOrFail($requestId);
        dd($request->teamMember->color);

        $events = Event::where($request->user_id, 'user_id');

        // plaats events in team_events met unieke kleur van user
         TeamEvents::create([
             'team_id' => $request->team_id,
             'event_id' => $events->id,
             'color' => $request->teamMember->color,
             'user_id' => $request->user_id,
         ]);

        $request->accept();

        // fetch events van geaccepteerde user in de shared calendar


        return redirect()->back()->with('success', 'User has been accepted');
    }
}
