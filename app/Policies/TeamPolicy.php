<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Team;

class TeamPolicy
{
    /**
     * Determine if the user can view the team.
     */
    public function view(User $user, Team $team)
    {
        // Check if the user is part of the team
        return $team->users()->where('id', $user->id)->exists();
    }

    /**
     * Determine if the user can invite other users to the team.
     */
    public function invite(User $user, Team $team)
    {
        // Only users with the 'owner' role can invite others
        return true;
    }

    /**
     * Determine if the user can remove a member from the team.
     */
    public function remove(User $user, Team $team, User $member)
    {
        // Only the owner can remove members from the team
        return $team->users()->where('id', $user->id)->where('role', 'owner')->exists() &&
            $team->users()->where('id', $member->id)->exists();
    }

    /**
     * Determine if the user can accept a new user into the team.
     */
    public function accept(User $user, Team $team, User $newUser)
    {
        // Only users with the 'owner' role can accept new users
        return $team->users()->where('id', $user->id)->where('role', 'owner')->exists();
    }

    /**
     * Check if the user is an owner of the team.
     */
    private function isOwner(User $user, Team $team)
    {
        return $team->users()->where('id', $user->id)->where('role', 'owner')->exists();
    }

    /**
     * Optional: Determine if the user can update the team's details.
     */
    public function update(User $user, Team $team)
    {
        // Example: only the owner can update team details
        return $team->users()->where('id', $user->id)->where('role', 'owner')->exists();
    }
}
