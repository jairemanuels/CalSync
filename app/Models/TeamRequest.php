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
            '#1B1B2F', '#2F3E46', '#4D4D4D', '#8A8A8A', '#ABB2B9', '#77665E', '#ADA9A3', '#2C3E50', '#85929E'
        ];

        $palette2 = [
            "#582f0e","#7f4f24","#936639","#a68a64","#b6ad90","#c2c5aa","#a4ac86","#656d4a","#414833","#333d29"
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
