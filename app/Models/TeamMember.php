<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Team;
use Illuminate\Database\Eloquent\Relations\Pivot;


class TeamMember extends Pivot
{

    protected $table = 'team_members';
    
    protected $fillable = [
        'team_id',
        'user_id',
        'role',
    ];

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
