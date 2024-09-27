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
        return view('platform::livewire.calendar');
    }



    public function saveEvent($event)
    {
        $eventModel = Event::where('customter_id', $event['customer_id'])->first();
        if ($eventModel) {
            $eventModel->starts_at = $event['start'];
            $eventModel->ends_at = $event['end'];
            $eventModel->save();
        } else {
            // Handle the case where no event with the given user_id was found
        }
    }
}
