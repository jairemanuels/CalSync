<?php

namespace App\Livewire\Platform;

use App\Actions\Platform\Events\CreateEventAction;
use Livewire\Component;
use App\Models\Event;

class AddEventModal extends Component
{
    public $description;

    public $startsAt;

    public $endsAt;

    public bool $allDay = false;

    public function createEvent(CreateEventAction $createEventAction)
    {
        $event = $createEventAction->create(tenant(), [
            'user_id' => auth()->id(),
            'description' => $this->description,
            'starts_at' => $this->startsAt,
            'ends_at' => $this->endsAt,
            'all_day' => $this->allDay,
            'color' => 'info',
        ]);

        $this->dispatch('event.created');
    }

    public function render()
    {
        return view('platform::livewire.add-event-modal');
    }
}
