<?php

namespace App\Http\Controllers\Api\V1\Cart;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Repositories\Cart\CartRepositoryInterface;

class CartController extends Controller
{
    //
    protected $cartRepository;

    public function __construct(CartRepositoryInterface $cartRepository)
    {
        $this->middleware('auth:api');
        $this->cartRepository = $cartRepository;
    }

    public function addtoCart(Request $request)
    {

        $request->validate([
            'product_id' => 'required|integer|exists:products,id',
            'quantity' => 'required|integer|min:1'
        ]);

        $this->cartRepository->add(Auth::id(), $request->product_id, $request->quantity);
    }

    public function removeFromCart($productId)
    {
        $this->cartRepository->remove(Auth::id(), $productId);
        return response()->json(['message' => 'Product removed from cart']);
    }

    public function getCart()
    {
        $cart = $this->cartRepository->getCart(Auth::id());
        return response()->json(['cart' => $cart]);
    }

    public function clearCart()
    {
        $this->cartRepository->clear(Auth::id());
        return response()->json(['message' => 'Cart cleared']);
    }
}
