<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;

class ProductVariantController extends Controller
{
    //
    public function index()
    {
        // Logic to list all product variants
         $product_variant = ProductVariant::all();
        return response()->json([
            'product_variant' => $product_variant,
        ], 200);      
    }

    public function show($id)
    {
       $product_variant = ProductVariant::where('id',$id)->get();
        return response()->json([
            'product_variant' => $product_variant,
        ], 200); 
    }

    public function store(Request $request)
    {
        // Logic to create a new product variant
         $request->validate([
            'product_id' => 'required|integer',
            'variant_name' => 'required|string',
            'base_price' => 'required|integer',
            'original_price' => 'nullable|integer',
            'attribute_value_ids' => 'nullable|string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'breadth' => 'nullable|integer',
            'length' => 'nullable|integer',
            'stock' => 'required|integer',
            'availability' => 'required|integer',
            'status' => 'required|integer'
        ]);

        $productVariant = [
            'product_id' => $request->product_id,
            'variant_name' => $request->variant_name,
            'base_price' => $request->base_price,
            'original_price' => $request->original_price,
            'attribute_value_ids' => $request->attribute_value_ids,
            'width' => $request->width,
            'height' => $request->height,
            'breadth' => $request->breadth,
            'length' => $request->length,
            'stock' => $request->stock,
            'availability' => $request->availability,
            'status' => $request->status
        ];

        ProductVariant::create([
            'product_id' => $request->product_id,
            'variant_name' => $request->variant_name,
            'base_price' => $request->base_price,
            'original_price' => $request->original_price,
            'attribute_value_ids' => $request->attribute_value_ids,
            'width' => $request->width,
            'height' => $request->height,
            'breadth' => $request->breadth,
            'length' => $request->length,
            'stock' => $request->stock,
            'availability' => $request->availability,
            'status' => $request->status
        ]);

        return response()->json([
                 'product' => $productVariant,
                'message' => 'Product Created successfully',                
        ], 200);
    }

    public function update(Request $request, $id)
    {
        // Logic to update an existing product variant
         $request->validate([
            'product_id' => 'required|integer',
            'variant_name' => 'required|string',
            'base_price' => 'required|integer',
            'original_price' => 'nullable|integer',
            'attribute_value_ids' => 'nullable|string',
            'width' => 'nullable|integer',
            'height' => 'nullable|integer',
            'breadth' => 'nullable|integer',
            'length' => 'nullable|integer',
            'stock' => 'required|integer',
            'availability' => 'required|integer',
            'status' => 'required|integer'
        ]);

        $productVariant = ProductVariant::findOrFail($id);
        $productVariant->update([
            'product_id' => $request->product_id,
            'variant_name' => $request->variant_name,
            'base_price' => $request->base_price,
            'original_price' => $request->original_price,
            'attribute_value_ids' => $request->attribute_value_ids,
            'width' => $request->width,
            'height' => $request->height,
            'breadth' => $request->breadth,
            'length' => $request->length,
            'stock' => $request->stock,
            'availability' => $request->availability,
            'status' => $request->status
        ]);

        return response()->json([
                 'product_variant' => $productVariant,
                'message' => 'Product Variant Updated successfully',                
        ], 200);
    }


    public function destroy($id){
        // Logic to delete a product variant
         $productVariant = ProductVariant::findOrFail($id);
        $productVariant->delete();

        return response()->json([
            'message' => 'Product Variant deleted successfully',
        ], 200);
    }
}
