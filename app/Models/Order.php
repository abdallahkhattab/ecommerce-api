<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
    'user_id',
    'location_id',
    'order_number',
    'total_price',
    'date_of_delivery',
    'status'];

    public function user(){
        return $this->belongsTo(User::class);
    }

        // Relationship with OrderItems (products in the order)
        public function items()
        {
            return $this->hasMany(OrderItems::class);
        }
    

    public function location(){
        return $this->belongsTo(location::class);
    }

}
