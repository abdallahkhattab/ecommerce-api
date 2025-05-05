<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    protected $hidden = ['created_at','updated_at'];

    protected $fillable = ['name','slug','description','image'];

    public function products()
{
    return $this->hasMany(Product::class);
}


    /*
    public function setNameAttribute($value){
        $this->attributes['name'] = $value; // Set the name attribute
        $this->attributes['slug'] = Str::slug($value); // Generate and set the slug
    }*/
}
