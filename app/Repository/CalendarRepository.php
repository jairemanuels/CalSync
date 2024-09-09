<?php

namespace App\Repository;

use App\Models\Calendar;

interface CalendarRepository
{
    /**
     * @return array<Calendar>
     */
    public function all() : array;
    public function find(int $id) : ?Calendar;
    public function save(Calendar $calendar) : void;
    public function delete(Calendar $calendar) : void;
}
