<?php

namespace App\Repository\UserRepository;

use App\Repository\UserRepository;
use App\Models\User;

class Eloquent implements UserRepository
{
    /**
     * @return array<User>
     */
    public function all() : array
    {
        $data = User::all();
        $users = [];
        foreach ($data as $user) {
            if (!$user instanceof User) {
                continue;
            }
            $users[] = $user;
        }
        return $users;

        // Even een test van Jens om te kijken of dit werkt :)
    }

    public function find(int $id) : ?User
    {
        $data = User::where('id', $id)->first();
        if (!$data instanceof User) {
            return null;
        }
        return $data;
    }

    public function save(User $user) : void
    {
        $user->save();
    }

    public function delete(User $user) : void
    {
        $user->delete();
    }
}
