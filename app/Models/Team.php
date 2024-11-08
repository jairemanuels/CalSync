<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'description',
        'uuid',
        'is_private',
        'is_collaborative',
        'owner_id',

    ];

    protected $table = 'teams';


    public function users()
    {
        return $this->belongsToMany(User::class)->withPivot('role'); // Add any pivot attributes if necessary
    }

    public function event()
    {
        return $this->belongsToMany(Event::class, 'team_events', 'team_id', 'event_id');
    }

    public function invites()
    {
        return $this->hasMany(TeamInvite::class);
    }

    public function members()
    {
        return $this->hasMany(TeamMember::class);
    }

    public function hasUser(User $user)
    {
        return $this->users()->where('id', $user->id)->exists();
    }

    public function addUser(User $user, $role = 'viewer')
    {
        if (!$this->hasUser($user)) {
            $this->users()->attach($user->id, ['role' => $role]);
        }
    }

    public function removeUser(User $user)
    {
        if ($this->hasUser($user)) {
            $this->users()->detach($user->id);
        }
    }

    public function isPrivate()
    {
        return $this->is_private;
    }

}

