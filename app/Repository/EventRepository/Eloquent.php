<?php

namespace App\Repository\EventRepository;

use App\Models\Event;
use App\Repository\EventRepository;

Class Eloquent implements EventRepository{

    /**
     * @return array<Calendar>
     */

     //

    public function all() : array
    {
        return Event::all()->all();
    }

    public function find(int $id) : ?Event
    {
        return Event::find($id);
    }

    public function save(Event $event) : void
    {
        $event->save();
    }

    public function delete(Event $event) : void
    {
        $event->delete();
    }

}

