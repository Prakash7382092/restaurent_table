<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductVariant;
use App\Models\Product;
use App\Models\CategoryAttribute;
use App\Models\AttributeValue;
use App\Models\Attribute;

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
           $attribute_value_ids =implode(',', $request->attribute_value_ids ?? []);        
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
        return redirect()->back();
           
    }

    public function Edit($id){    
         $product_variant = ProductVariant::where('id',$id)->first();
         $product_variant_id = $product_variant->id;
          $product_id= $product_variant->product_id;   
        $product = Product::where('id',$product_id)->first();
        $product_name=  $product->name;    
        $category_id= $product->category_id;       
        $attributeIds = CategoryAttribute::where('category_id', $category_id)->pluck('attribute_id');      
        $attributeValues = AttributeValue::whereIn('attribute_id', $attributeIds) ->get();    
        $attributes = Attribute::whereIn('id', $attributeIds)->get();
      
       return view('vendor.products.product_variant_edit',compact('product_variant_id','product_variant','product_id','product_name','category_id','attributes','attributeIds','attributeValues','attributes','product_variant'));

    }

    public function Update(Request $request){
              $id  = $request->variant_id;
            $product_id = $request->product_id;         
            $variant_name = $request->variant_name;         
            $base_price = $request->base_price;         
            $original_price = $request->original_price;      
            $attribute_value_ids =implode(',', $request->attribute_value_ids ?? []);
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
        return redirect()->back();
           
    }

    public function Delete($id){
         ProductVariant::where('id', $id)->delete();
        flash('success', 'Product Variant deleted successfully!');
        return redirect()->back();
    }
}
