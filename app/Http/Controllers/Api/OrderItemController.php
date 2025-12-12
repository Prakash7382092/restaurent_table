<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\OrderItem;

class OrderItemController extends Controller
{
    //
    public function index()
    {
        $orderItems = OrderItem::all();
        return response()->json($orderItems);
    }

    public function show($id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }
        return response()->json($orderItem);
    }
    public function store(Request $request)
    {
        $request->validate([
            'order_id' => 'required|integer',
            'product_variant_id'  => 'required|integer',
            'quantity' => 'required|integer',
            'unit_price' => 'required|integer',
            'discounted_price' => 'required|integer',
          
        ]);


         $orderItem=[
            'order_id' => $request->order_id,
            'product_variant_id'  => $request->product_variant_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'discounted_price' => $request->discounted_price
         ];

        OrderItem::create([
            'order_id' => $request->order_id,
            'product_variant_id'  => $request->product_variant_id,
            'quantity' => $request->quantity,
            'unit_price' => $request->unit_price,
            'discounted_price' => $request->discounted_price,
        ]);

        return response()->json([
            'message' => 'Order Item created successfully',
            'order_item' => $orderItem
        ], 201);


    }

    public function update(Request $request, $id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }

        $request->validate([
            'order_id ' => 'sometimes|integer',
            'product_variant_id '  => 'sometimes|integer',
            'quantity' => 'sometimes|integer',
            'unit_price' => 'sometimes|integer',
            'discounted_price' => 'sometimes|integer',
        ]);

        $orderItem->update($request->all());

        return response()->json([
            'message' => 'Order Item updated successfully',
            'order_item' => $orderItem
        ], 200);
    }

    public function destroy($id)
    {
        $orderItem = OrderItem::find($id);
        if (!$orderItem) {
            return response()->json(['message' => 'Order Item not found'], 404);
        }

        $orderItem->delete();

        return response()->json(['message' => 'Order Item deleted successfully'], 200);
    }

}
