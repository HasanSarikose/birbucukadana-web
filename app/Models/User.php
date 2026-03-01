<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role', // rolü ekledik
        'team_id', // takım ID'sini ekledik
        'club_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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

    /**
     * Kullanıcının ait olduğu takımı al.
     */
    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Kullanıcının admin olup olmadığını kontrol et.
     */
    public function isAdmin()
    {
        return $this->role === 'admin';
    }

    /**
     * Kullanıcının süper admin olup olmadığını kontrol et.
     */
    public function isSuperAdmin()
    {
        return $this->role === 'super_admin';
    }

    public function club()
    {
        return $this->belongsTo(Club::class, 'club_id', 'id');
    }
}
