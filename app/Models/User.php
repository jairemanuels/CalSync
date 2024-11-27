<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'uuid',
        'id',
        'name',
        'email',
        'password',
        'provider_id',
        'provider_token',
        'provider_name',
        'refresh_token',
        'expires_in',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }

    public function activeTenant()
    {
        return $this->belongsTo(Tenant::class, 'active_tenant_id');
    }

    public function events()
    {
        return $this->hasMany(Event::class);
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'owner_id');
    }

    public function teamMember()
    {
        return $this->hasMany(TeamMember::class, 'user_id');
    }

    public function avatar(): string
    {
        return 'https://cdn.pixabay.com/photo/2015/10/05/22/37/blank-profile-picture-973460_1280.png';
    }


}
