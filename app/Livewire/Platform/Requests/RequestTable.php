<?php

namespace App\Livewire\Platform\Requests;

use App\Models\Event;
use App\Models\TeamEvents;
use App\Models\TeamRequest;
use App\Models\teamMember;
use Livewire\Component;

class RequestTable extends Component
{
    public function accept($requestId)
    {
        $request = TeamRequest::with('teamMember')->findOrFail($requestId);
        $events = Event::where('user_id', $request->user_id)->get();

        $request->accept();

        $userColor = TeamMember::where('user_id', $request->user_id)->pluck('color')->first();

        // plaats events in team_events met unieke kleur van user
        foreach ($events as $event) {
            TeamEvents::create([
                'team_id' => $request->team_id,
                'event_id' => $event->id,
                'color' => $userColor,
                'user_id' => $request->user_id,
            ]);
        }

    }

    public function decline($requestId)
    {
        $request = TeamRequest::findOrFail($requestId);
        $request->decline();
    }

    public function remove($requestId)
    {
        $request = TeamRequest::findOrFail($requestId);
        $request->remove();
    }

    public function render()
    {
        return view('platform::livewire.requests.request-table');
    }
}
