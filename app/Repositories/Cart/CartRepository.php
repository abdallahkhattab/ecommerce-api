<?

namespace App\Repositories\Cart;

use App\Models\Cart;

class CartRepositary implements CartRepositoryInterface
{
    public function add($userId, $productId, $quantity)
    {
        $cartItem = Cart::where('user_id', $userId)->where('product_id', $productId)->first();

        if ($cartItem) {
            $cartItem->increment('quantity', $quantity);
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
        Cart::where('user_id', $userId)->with('products')->get();
    }
    public function clear($userId)
    {
        Cart::where('user_id', $userId)->delete();
    }
}
