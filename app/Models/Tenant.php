<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tenant extends Model
{
    protected $fillable = [
        'name',
        'user_id',
        'domain',
        'language',
        'country',
        'timezone',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
