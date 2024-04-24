<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name_en',
        'name_bn',
        'category_id',
        'code',
        'short_description_en',
        'short_description_bn',
        'long_description_en',
        'long_description_bn',
        'image',
        'price',
        'discount',
        'quantity',
        'status',
    ];

    public function geProductList()
    {
        return DB::table('products')
            ->leftjoin('categories', 'products.category_id', '=', 'categories.id')
            ->select('products.*', 'categories.name_en as category_name_en', 'categories.name_bn as category_name_bn')
            ->paginate(5);
    }

    public function scopeGetProduct($query, $productId)
    {
        return $query->where('id', $productId)->first();
    }
}
