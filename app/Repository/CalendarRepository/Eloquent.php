<?php

namespace App\Repository\CalendarRepository;

use App\Repository\CalendarRepository;
use App\Models\Calendar;

class Eloquent implements CalendarRepository
{
    /**
     * @return array<Calendar>
     */
    public function all() : array
    {
        return Calendar::all()->toArray();
    }

    public function find(int $id) : ?Calendar
    {
        return Calendar::find($id);

    }

    public function save(Calendar $calendar) : void
    {
        $calendar->save();
    }

    public function delete(Calendar $user) : void
    {
        $user->delete();
    }
}
