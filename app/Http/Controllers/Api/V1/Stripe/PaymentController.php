<?php

namespace App\Http\Controllers\Api\V1\Stripe;

use Stripe\Charge;
use Stripe\Stripe;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;


class PaymentController extends Controller
{
    public function pay(Request $request, string $orderId)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            $order = Order::with('items')->find($orderId);
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($user->id !== $order->user_id && !$user->hasRole('admin', 'seller')) {
                return response()->json(['message' => 'Forbidden'], 403);
            }

            if ($order->status === 'paid') {
                return response()->json(['message' => 'Order is already paid'], 400);
            }

            $validatedData = $request->validate([
                'payment_token' => 'required|string'
            ]);

            DB::beginTransaction();
            Stripe::setApiKey(env('STRIPE_SECRET'));

            $charge = Charge::create([
                'amount' => intval($order->total_price * 100), // Convert to cents
                'currency' => 'usd',
                'source' => $validatedData['payment_token'],
                'description' => "Payment for Order #{$order->id}"
            ]);

            if ($charge->status === 'succeeded') {
                $order->update(['status' => 'paid']);

                DB::commit();

                return response()->json([
                    'message' => 'Payment successful , Thanks for shopping with us ^^',
                    'order' => $order,
                ]);
            } else {
                DB::rollBack();
                return response()->json(['message' => 'Payment failed'], 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Payment error', 'error' => $e->getMessage()], 500);
        }
    }

}
