<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_bn',
        'status',
    ];

    /**
     * Get category by $categoryId
     * Eloquent Query Scopes applied
     * @param  mixed $query
     * @param  mixed $categoryId
     * @return void
     */
    public function scopeGetCategory($query, $categoryId)
    {
        return $query->where('id', $categoryId)->first();
    }
}
