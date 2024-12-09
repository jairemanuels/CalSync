<?php

namespace App\Models;

use App\Services\teamMemberService;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TeamRequest extends Model
{

    private $colorService;

    protected $fillable = [
        'team_id',
        'user_id',
        'status',
    ];

    protected $table = 'team_requests';


    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function teamMember(): BelongsTo
    {
        return $this->belongsTo(TeamMember::class);
    }

    public function scopeSearch($query, string $search): void
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }
    }

    public function generateColor($teamId)
    {

        $usedColors = TeamMember::where('team_id', $teamId)->pluck('color')->filter();

        $palette = [
            "#c4cea1","#d9e0a3","#fdf2b0","#f3d17c","#cf9963"
        ];

        $palette2 = [
            "#ffc8dd","#ffafcc","#bdb2ff","#bde0fe","#a2d2ff"
        ];
        $availableColors = collect($palette)->diff($usedColors);

        if ($availableColors->isEmpty()) {
            $availableColors = collect($palette2);
        }

        return $availableColors->random();
    }

    public function accept(): void
    {
        $this->status = 'active';
        $this->save();
        $teamId = $this->team_id;

        $color = $this->generateColor($teamId);

        TeamMember::create([
            'team_id' => $teamId,
            'user_id' => $this->user_id,
            'role' => 'viewer',
            'color' => $color,

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
