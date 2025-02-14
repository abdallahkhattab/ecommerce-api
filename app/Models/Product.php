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
        'user_id',
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

    public function favoritedByUsers()
{
    return $this->belongsToMany(User::class, 'favorites')->withTimestamps();
}


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

    public function scopeFilterByRole($query, $user)
    {
        if ($user) {
            if ($user->hasRole('admin')) {
                return $query; // Admin sees all products
            } elseif ($user->hasAnyRole(['seller', 'editor'])) {
                return $query->where('user_id', $user->id); // Seller & Editor see their own products
            } else {
                return $query->where('is_available', true); // Regular users see available products
            }
        }
        return $query->where('is_available', true); // Guests see available products
    }
    
    public function scopeFilterByPrice($query, $priceFrom = null, $priceTo = null)
    {
        if (!is_null($priceFrom)) {
            $query->where('price', '>=', $priceFrom);
        }
        if (!is_null($priceTo)) {
            $query->where('price', '<=', $priceTo);
        }
        return $query;
    }
    
    public function scopeSortByPrice($query, $sortOrder = 'asc')
    {
        return $query->orderBy('price', in_array($sortOrder, ['asc', 'desc']) ? $sortOrder : 'asc');
    }
    

}
