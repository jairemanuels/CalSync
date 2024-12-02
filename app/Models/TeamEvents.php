<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TeamEvents extends Model
{
    protected $table = 'team_events';

    protected $fillable = [
        'team_id',
        'event_id',
        'color',
        'user_id',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function teamMember()
    {
        return $this->belongsTo(TeamMember::class);
    }
}
