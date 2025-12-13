<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller{
    public function store(Request $request){
        // Validate request
        $validated = $request->validate([
            'user_id' => 'required|exists:users,id',
            'total_amount' => 'required|numeric',
            'delivery_charges' => 'required|numeric',
            'discount_amount' => 'required|numeric',
            'total_payable' => 'required|numeric',
            'status' => 'required|string',
            'shipping_address_id' => 'required|exists:addresses,id',
            'shipping_tracking_code' => 'nullable|string',
            'payment_method' => 'nullable|string',
            'order_currency' => 'nullable|string',
            'transaction_id' => 'required|string',

            'items' => 'required|array',
            'items.*.product_variant_id' => 'required|exists:product_variants,id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.unit_price' => 'required|numeric',
            'items.*.discounted_price' => 'required|numeric'
        ]);

        // Create order
        $order = Order::create([
            'user_id' => $request->user_id,
            'total_amount' => $request->total_amount,
            'delivery_charges' => $request->delivery_charges,
            'discount_amount' => $request->discount_amount,
            'total_payable' => $request->total_payable,
            'status' => $request->status,
            'shipping_address_id' => $request->shipping_address_id,
            'shipping_tracking_code' => $request->shipping_tracking_code,
            'payment_method' => $request->payment_method,
            'order_currency' => $request->order_currency,
            'transaction_id' => $request->transaction_id
        ]);

        // Insert order items
        foreach ($request->items as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_variant_id' => $item['product_variant_id'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'discounted_price' => $item['discounted_price']
            ]);
        }

        return response()->json([
            'message' => 'Order created successfully',
            'order' => $order,
            'items' => $order->items
        ], 201);
    }
}
