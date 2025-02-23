<?
namespace App\Repositories\Cart;

interface CartRepositaryInterface
{
    public function add($userId, $productId, $quantity);
    public function remove($userId, $productId);
    public function getCart($userId);
    public function clear($userId);
}
