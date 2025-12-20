<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;

class ProductVariantController extends Controller
{
    //
    public function index(){
        echo "Welcome";
    }

    public function store(Request $request){         
           $product_id = $request->product_id;          
           $variant_name = $request->variant_name;         
           $base_price = $request->base_price;          
           $original_price = $request->original_price;        
           $attribute_value_ids =$request->attribute_value_ids;          
           $width = $request->width;          
           $height = $request->height;         
           $breadth  =$request->breadth;          
           $length = $request->length;         
           $stock = $request->stock;          
           $availability  = $request->availability;          
           $status =  $request->status;

           ProductVariant::insert([
              'product_id'=>$product_id,
              'variant_name'=>$variant_name,
              'base_price' =>$base_price,
              'original_price' =>$original_price,
              'attribute_value_ids'=>$attribute_value_ids,
              'width'=>$width,
              'height'=>$height,
              'breadth'=>$breadth,
              'length'=>$length,
              'stock'=>$stock,
              'availability'=>$availability,
              'status'=>$status

           ]);

         flash('success', 'Product Variant Created successfully!');
        return redirect()->route('admin.products_index');
           
    }

    public function Edit($id){       
        $product_variant = ProductVariant::where('id',$id)->first();
         $product_id= $product_variant->product_id;   
        $product = Product::where('id',$product_id)->first();
        $product_name= $product->name;            
        return view('admin.products.product_variant_edit',compact('product_variant','product_id','product_name'));

    }

    public function Update(Request $request){
              $id  = $request->variant_id;
            $product_id = $request->product_id;         
            $variant_name = $request->variant_name;         
            $base_price = $request->base_price;         
            $original_price = $request->original_price;      
            $attribute_value_ids =$request->attribute_value_ids;
           $width = $request->width;        
           $height = $request->height;        
           $breadth  =$request->breadth;          
           $length = $request->length;         
           $stock = $request->stock;         
           $availability  = $request->availability;          
           $status =  $request->status;
           ProductVariant::where('id',$id)->update([
               'product_id'=>$product_id,
              'variant_name'=>$variant_name,
              'base_price' =>$base_price,
              'original_price' =>$original_price,
              'attribute_value_ids'=>$attribute_value_ids,
              'width'=>$width,
              'height'=>$height,
              'breadth'=>$breadth,
              'length'=>$length,
              'stock'=>$stock,
              'availability'=>$availability,
              'status'=>$status
           ]);


            flash('success', 'Product Variant Updated successfully!');
        return redirect()->route('admin.products_index');
           
    }

    public function Delete($id){
         ProductVariant::where('id', $id)->delete();
        flash('success', 'Product Variant deleted successfully!');
        return redirect()->route('admin.products_index');
    }
}
