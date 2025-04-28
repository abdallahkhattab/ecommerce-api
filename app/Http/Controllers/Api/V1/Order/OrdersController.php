<?php

namespace App\Http\Controllers\Api\V1\Order;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\Location;
use Illuminate\Http\Request;
use GuzzleHttp\Promise\Create;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\OrderRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\OrderResource;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $user = $request->user();

            if ($user && !$user->hasRole('admin', 'seller')) {
                $orders = $user->orders()->with(['items.product'])->paginate(10);
            } else {
                $orders = Order::with(['items.product'])->paginate(10);
            }

            if ($orders->isEmpty()) {
                return response()->json(['message' => 'No orders found'], 404);
            }

            return OrderResource::collection($orders);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching orders',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
    
            $validatedData = $request->validate([
                'items' => 'required|array|min:1',
                'items.*.product_id' => 'required|exists:products,id',
                'items.*.quantity' => 'required|integer|min:1',
            ]);

            $location = Location::where('user_id', $user->id)->first();
    
            DB::beginTransaction();


    
            $totalPrice = 0;
            $order = Order::create([
                'user_id' => $user->id,
                'location_id'=>$location->id,
                'order_number' => Order::generateOrderNumber(), // Correct way to generate order number
                'status' => 'pending',
                'total_price' => 0, // Will update later
            ]);
    
            foreach ($validatedData['items'] as $item) {
                $product = Product::find($item['product_id']);
                if (!$product || !$product->is_available) {
                    DB::rollBack();
                    return response()->json(['message' => "Product with ID {$item['product_id']} is not available"], 400);
                }
    
                $order->items()->create([
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $product->price,
                ]);
    
                $totalPrice += $product->price * $item['quantity'];
            }
    
            $order->update(['total_price' => $totalPrice]);
    
            DB::commit();
    
            return response()->json([
                'message' => 'Order created successfully',
                'order' => new OrderResource($order),
            ], 201);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error creating order', 'error' => $e->getMessage()], 500);
        }
    }
    
    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        try {
            $user = $request->user();
            $order = Order::with(['items.product'])->find($id);

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($user->id !== $order->user_id && !$user->hasRole('admin', 'seller')) {
                return response()->json(['message' => 'Forbidden'], 403);
            }

            return new OrderResource($order);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error fetching order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }


    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, string $id)
    {
        try {
            $user = $request->user();
            if (!$user) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }
    
            $order = Order::with('items')->find($id);
            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }
    
            if ($user->id !== $order->user_id && !$user->hasRole('admin', 'seller')) {
                return response()->json(['message' => 'Forbidden'], 403);
            }
    
            if (in_array($order->status, ['Delivered', 'shipped'])) {
                return response()->json(['message' => 'Cannot update shipped or delivered orders'], 400);
            }
    
            $validatedData = $request->validate([
                'items' => 'nullable|array|min:1',
                'items.*.product_id' => 'required_with:items|exists:products,id',
                'items.*.quantity' => 'required_with:items|integer|min:1',
                'status' => 'nullable|string|in:pending,processing,paid,shipped,delivered,canceled',
            ]);
    
            DB::beginTransaction();
    
            if (isset($validatedData['items'])) {
                $totalPrice = 0;
    
                foreach ($validatedData['items'] as $item) {
                    $product = Product::find($item['product_id']);
                    if (!$product || !$product->is_available) {
                        DB::rollBack();
                        return response()->json(['message' => "Product with ID {$item['product_id']} is not available"], 400);
                    }
    
                    $orderItem = $order->items()->where('product_id', $item['product_id'])->first();
    
                    if ($orderItem) {
                        $orderItem->update(['quantity' => $item['quantity'], 'price' => $product->price]);
                    } else {
                        $order->items()->create([
                            'product_id' => $item['product_id'],
                            'quantity' => $item['quantity'],
                            'price' => $product->price,
                        ]);
                    }
    
                    $totalPrice += $product->price * $item['quantity'];
                }
    
                $order->update(['total_price' => $totalPrice]);
            }
    
            if (isset($validatedData['status'])) {
                $order->update(['status' => $validatedData['status']]);
            }
    
            DB::commit();
    
            return response()->json([
                'message' => 'Order updated successfully',
                'order' => new OrderResource($order),
            ]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Error updating order', 'error' => $e->getMessage()], 500);
        }
    }
        
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        try {
            $user = $request->user();
            $order = Order::find($id);

            if (!$order) {
                return response()->json(['message' => 'Order not found'], 404);
            }

            if ($user->id !== $order->user_id && !$user->hasRole('admin', 'seller')) {
                return response()->json(['message' => 'Forbidden'], 403);
            }

            $order->delete();

            return response()->json(['message' => 'Order deleted successfully'], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting order',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    /**
 * Get the authenticated user's specific order details.
 */
public function userOrderDetails(Request $request, string $orderId)
{
    try {
        $user = $request->user();
        $order = Order::with(['items.product'])->where('id', $orderId)->where('user_id', $user->id)->first();

        if (!$order) {
            return response()->json(['message' => 'Order not found or access denied'], 404);
        }

        return new OrderResource($order);
    } catch (\Exception $e) {
        return response()->json([
            'message' => 'Error fetching order details',
            'error' => $e->getMessage(),
        ], 500);
    }
}


}
