<?php

namespace App\Livewire\Platform;

use App\Actions\Platform\Events\CreateEventAction;
use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    #[On('event.created')]
    public function render()
    {
        $events = Event::query()->where('user_id', auth()->user()->id)->get();
        return view('platform::livewire.calendar', compact('events'));
    }
}
