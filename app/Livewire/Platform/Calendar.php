<?php

namespace App\Livewire\Platform;

use App\Actions\Platform\Events\CreateEventAction;
use Livewire\Attributes\Renderless;
use Livewire\Component;
use App\Models\Event;

class Calendar extends Component
{
    public function render()
    {
        return view('platform::livewire.calendar');
    }

    public function refreshCalender()
    {
        $this->dispatch('calendar:refresh');
    }

    #[Renderless]
    public function saveEvent(Event $event, $start_time, $end_time = null)
    {
        if($event) {
            $event->update([
                'starts_at' => $start_time,
                'ends_at' => $end_time
            ]);
        }
    }
}
