<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    protected $table = 'events';

    protected $fillable = [
        'tenant_id',
        'customer_id',
        'description',
        'starts_at',
        'ends_at',
        'all_day',
        'color',
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

    /**
     * Set global scope to tenant
     */
    protected static function booted()
    {
        static::addGlobalScope(new \App\Scopes\TenantScope());

        static::creating(function ($model) {
            $model->id = modelId();
        });
    }

    public function tenant(): BelongsTo
    {
        return $this->belongsTo(Tenant::class);
    }

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }
}
