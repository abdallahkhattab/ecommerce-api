<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory , SoftDeletes;

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

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function setNameAttribute($value){
        $this->attributes['name'] = $value;
        $this->attributes['slug'] = Str::slug($value);
    }

}
