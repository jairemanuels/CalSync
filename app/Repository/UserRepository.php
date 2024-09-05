<?php

namespace App\Repository;

use App\Models\User;

interface UserRepository
{
    /**
     * @return array<User>
     */
    public function all() : array;
    public function find(int $id) : ?User;
    public function save(User $user) : void;
    public function delete(User $user) : void;
}
