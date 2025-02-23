<?php

namespace App\Repositories\Cart;

use App\Models\Cart;

class CartRepository implements CartRepositoryInterface
{
    public function add($userId, $productId, $quantity)
    {
        $cartItem = Cart::with('user')->where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
            } else if (!$cartItem) {
                
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $quantity,
            ]);
        }
    }

    public function remove($userId, $productId)
    {

        Cart::where('user_id', $userId)->where('product_id', $productId)->delete();
    }
    public function getCart($userId)
    {
       return Cart::where('user_id', $userId)->with('products')->get();
    }
    public function clear($userId)
    {
        Cart::where('user_id', $userId)->delete();
    }
}
