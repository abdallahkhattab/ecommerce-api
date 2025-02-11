<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'brand_id',
        'category_id',
        'name',
        'is_trendy',
        'is_available',
        'slug',
        'description',
        'price',
        'discount',
        'image',
        'quantity',
    ];

    // Relationship with Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    // Relationship with Category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

}
