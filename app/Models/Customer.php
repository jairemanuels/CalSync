<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Customer extends Model
{
    protected $table = 'customers';

    protected $fillable = [
        'tenant_id',
        'name',
        'email',
        'phone',
        'gender',
        'language',
        'address',
        'address2',
        'country',
        'region',
        'city',
        'zip_code',
        'last_seen_at',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'last_seen_at' => 'datetime',
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

    public function notes(): HasMany
    {
        return $this->hasMany(CustomerNote::class);
    }


    public function scopeSearch($query, string $search): void
    {
        if ($search) {
            $query->where('name', 'like', '%' . $search . '%')
                ->orWhere('email', 'like', '%' . $search . '%');
        }
    }
}
