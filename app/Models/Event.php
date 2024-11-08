<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'user_id',
        'external_id',
        'name',
        'description',
        'event_time_start',
        'event_time_end',
        'color'
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'starts_at' => 'datetime',
            'ends_at' => 'datetime',
            'all_day' => 'boolean',
        ];
    }

    /**
     * Disable auto-incrementing for the primary key.
     */
    public $incrementing = false;



    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function team(): BelongsToMany
    {
        return $this->belongsToMany(Team::class, 'team_events', 'event_id', 'team_id');
    }
}
