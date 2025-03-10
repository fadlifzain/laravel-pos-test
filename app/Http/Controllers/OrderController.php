<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::latest()->get(); // Fetch all orders
        return view('orders.index', compact('orders'));
    }

    public function store(Request $request)
    {
        $cartItems = $request->input('cart'); // Receive cart items from frontend

        if (empty($cartItems)) {
            return response()->json(['message' => 'Cart is empty'], 400);
        }

        $total = 0;

        // Create Order
        $order = Order::create([
            'total' => 0 // We will update this later
        ]);

        // Loop through cart items and store them
        foreach ($cartItems as $item) {
            $product = Product::find($item['id']);

            if (!$product) {
                return response()->json(['message' => "Product not found: {$item['name']}"], 404);
            }

            $subtotal = $product->price * $item['quantity'];
            $total += $subtotal;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $item['quantity'],
                'price' => $product->price
            ]);
        }

        // Update total order price
        $order->update(['total' => $total]);

        return response()->json(['message' => 'Order stored successfully', 'order_id' => $order->id]);
    }

    public function show(Order $order)
    {
        return view('orders.show', compact('order'));
    }

}
