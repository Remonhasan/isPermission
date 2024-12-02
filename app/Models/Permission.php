<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'scope',
        'create',
        'edit',
        'view',
        'delete',
        'list',
    ];
    
    /**
     * Get Permission
     * Eloquent Query Scopes applied
     * @param  mixed $query
     * @param  mixed $userId
     * @return void
     */
    public function scopeGetPermission($query, $userId, $scopeName)
    {
        return $query->where('user_id', $userId)->where('scope', $scopeName);
    }

    /**
     * Get Permission by userId
     * Eloquent Query Scopes applied
     * @param  mixed $query
     * @param  mixed $userId
     * @return void
     */
    public function scopeGetPermissionByUserId($query, $userId)
    {
        return $query->where('user_id', $userId)->get()->toArray();
    }
}
