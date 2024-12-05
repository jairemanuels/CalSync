<?php

namespace App\Livewire\Platform;

use App\Actions\Platform\Events\CreateEventAction;
use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public $teamEvents = [];

    public function mount($teamEvents)
    {
        $this->teamEvents = $teamEvents;
    }

    #[On('event.created')]
    public function render()
    {
        $events = Event::query()->where('user_id', auth()->user()->id)->get();
        $teamEvents = $this->teamEvents;
        return view('platform::livewire.calendar', compact('events', 'teamEvents'));
    }
}
