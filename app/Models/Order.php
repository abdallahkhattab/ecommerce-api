<?php

namespace App\Models;

use App\Models\OrderItem;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

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
            return $this->hasMany(OrderItem::class);
        }
    

    public function location(){
        return $this->belongsTo(location::class);
    }

    public static function generateOrderNumber(){
        $order_number = 'ORD-'.date('y').'-'.rand(1000,9999);
        return $order_number;
    }

}
