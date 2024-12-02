<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role',
        'name',
        'email',
        'password',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];



    /**
     * Get user info by $userId 
     * Eloquent Query Scopes applied
     * @param  mixed $query
     * @param  mixed $userId
     * @return void
     */
    public function scopeUserInfoById($query, $userId)
    {
        return $query->where('id', $userId)->first();
    }

    /**
     * Find user role by email
     *
     * @param  mixed $query
     * @param  mixed $email
     * @return void
     */
    public function scopeFindRoleByEmail($query, $email)
    {
        return $query->where('email', $email)->value('role');
    }
}
