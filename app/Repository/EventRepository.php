<?php

namespace App\Repository;

use App\Models\Event;

interface EventRepository
{
    /**
     * @return array<Event>
     */
    public function all() : array;
    public function find(int $id) : ?Event;
    public function save(Event $event) : void;
    public function delete(Event $event) : void;
}
