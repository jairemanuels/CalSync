<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamRequest extends Model
{
    protected $fillable = [
        'team_id',
        'user_id',
        'status',
    ];

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function scopeSearch($query, string $search): void
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }
    }

    public function accept(): void
    {
        $this->status = 'active';
        $this->save();

        TeamMember::create([
            'team_id' => $this->team_id,
            'user_id' => $this->user_id,
            'role' => 'viewer',
        ]);
    }

    public function decline(): void
    {
        $this->delete();
    }

    public function remove(): void
    {
        $member = TeamMember::where('team_id', $this->team_id)->where('user_id', $this->user_id)->first();

        if($member) {
            $member->delete();
            $this->delete();
        }
    }
}
