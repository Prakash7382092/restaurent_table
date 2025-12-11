<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;

// CHANGED: required imports
use Illuminate\Support\Str;                     // CHANGED: needed for Str::slug()
use Illuminate\Support\Facades\File;           // CHANGED: create directories safely
use Illuminate\Validation\ValidationException; // optional, not required but okay

class ProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return response()->json($products);
    }

    public function show($id)
    {
        $product = Product::find($id);
        if (!$product) {
            return response()->json(['message' => 'Product not found'], 404);
        }
        return response()->json($product);
    }

    
 // Create a new product
    public function store(Request $request){
         $request->validate([
            'vendor_id' => 'required|integer',
            'name' => 'required|string',
            'short_description' => 'nullable|string',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'slug' => 'nullable|string',
            'sku' => 'required|string',
            'category_id' => 'required|integer',
            'total_allowed_qty' => 'required|integer',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
        // Prepare folder name: slug of product name
            $product_name = Str::slug($request->name);

            // base folder under public/
            $baseFolder = public_path("products/{$product_name}");

            // Ensure directories exist before moving files
            if (! File::exists($baseFolder)) {
                // CHANGED: recursively create directories
                File::makeDirectory($baseFolder, 0755, true);
            }

              if ($request->hasFile('featured_image')) {

                    $file = $request->file('featured_image');

                    $imageName = uniqid().'.'.$file->getClientOriginalExtension();

                    $file->move(public_path('products/'.$product_name), $imageName); // 🔥 Image gets saved
                }


                  $images_list = [];

            // NOTE: Postman must send files as images[] (multiple rows)
            if ($request->hasFile('images')) {

                foreach ($request->file('images') as $file) {

                    $image_dir = $baseFolder; // images stored in public/products/{slug}/

                    // ensure exists
                    if (! File::exists($image_dir)) {
                        File::makeDirectory($image_dir, 0755, true);
                    }

                    $image_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                    $file->move($image_dir, $image_name);

                    // store relative path
                    $images_list[] = $image_name;
                }
            }



        $product =[
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'type' => $request->type,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'total_allowed_qty' => $request->total_allowed_qty,
            'product_name'=>$product_name,
            'featured_image' => $imageName,
            'images' => $images_list
        ];


        Product::insert([
            'vendor_id'=>$request->vendor_id,
            'name'=>$request->name,
            'short_description'=>$request->short_description,
            'description'=>$request->description,
            'type'=>$request->type,
            'slug'=>$request->slug,
            'sku'=>$request->sku,
            'category_id'=>$request->category_id,
            'total_allowed_qty'=>$request->total_allowed_qty,
            'featured_image'=>$imageName,
            'images'=>json_encode($images_list)
        ]);         

            // Create the product

         return response()->json([
                'message' => 'Product Created successfully',
                'product' => $product
        ], 200);

    }


    //Update product

    public function update(Request $request, $id){
        
              $product = Product::where('id',$id)->first();            
              $vendorid = $product->vendor_id;           
              $oimages = $product->images;           
              $ofeatured_image = $product->featured_image;
              $product_name = $product->product_name; // already saved on insert
              $folderPath = public_path("products/{$product_name}/");


                $request->validate([
                    'vendor_id' => 'required|integer',
                    'name' => 'required|string',
                    'short_description' => 'nullable|string',
                    'description' => 'nullable|string',
                    'type' => 'nullable|string',
                    'slug' => 'nullable|string',
                    'sku' => 'required|string',
                    'category_id' => 'required|integer',
                    'total_allowed_qty' => 'required|integer',
                    'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
                ]);
                // Prepare folder name: slug of product name
                $product_name = Str::slug($request->name);

                // base folder under public/
                $baseFolder = public_path("products/{$product_name}");

                    // Ensure directories exist before moving files
                if (! File::exists($baseFolder)) {
                    // CHANGED: recursively create directories
                    File::makeDirectory($baseFolder, 0755, true);
                }

                if ($request->hasFile('featured_image')) {
                    if (File::exists(public_path('products/'.$product_name.'/'.$ofeatured_image))){
                     unlink(public_path('products/'.$product_name.'/'.$ofeatured_image));
                    }

                    $file = $request->file('featured_image');

                    $imageName = uniqid().'.'.$file->getClientOriginalExtension();

                    $file->move(public_path('products/'.$product_name), $imageName); // 🔥 Image gets saved
                }else{
                    $imageName = $ofeatured_image;                    
                }                

                 // NOTE: Postman must send files as images[] (multiple rows)
                if ($request->hasFile('images')) {     

                        $oldImages = json_decode($product->images, true);

                        if (is_array($oldImages)) {
                            foreach ($oldImages as $img) {
                                $fullPath = $folderPath . $img;                              
                                if (File::exists(public_path('products/'.$product_name.'/'.$img))) {
                                     unlink(public_path('products/'.$product_name.'/'.$img));
                                }
                              
                            }
                        }
                    
                     $images_list = [];

                    foreach ($request->file('images') as $file) {

                        $image_dir = $baseFolder; // images stored in public/products/{slug}/

                        // ensure exists
                        if (! File::exists($image_dir)) {
                            File::makeDirectory($image_dir, 0755, true);
                        }

                        $image_name = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();

                        $file->move($image_dir, $image_name);

                        // store relative path
                        $images_list[] = $image_name;
                    }

                    $images_list=json_encode($images_list);

                }else{
                    $images_list = $oimages; // keep existing images
                    // Delete old images one by one
                   
                }

                $product =[
                    'vendor_id' => $request->vendor_id,
                    'name' => $request->name,
                    'short_description' => $request->short_description,
                    'description' => $request->description,
                    'type' => $request->type,
                    'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
                    'sku' => $request->sku,
                    'category_id' => $request->category_id,
                    'total_allowed_qty' => $request->total_allowed_qty,
                    'product_name'=>$product_name,                
                    'vendor_id'=>$vendorid               
                ];


                Product::where('id',$id)->update([
                    'vendor_id'=>$request->vendor_id,
                    'name'=>$request->name,
                    'short_description'=>$request->short_description,
                    'description'=>$request->description,
                    'type'=>$request->type,
                    'slug'=>$request->slug,
                    'sku'=>$request->sku,
                    'category_id'=>$request->category_id,
                    'total_allowed_qty'=>$request->total_allowed_qty,
                    'featured_image'=>$imageName,
                    'images'=>$images_list
                ]);       
                
                

                    // Create the product

                return response()->json([
                        'message' => 'Product Updated successfully',
                        'product' => $product
                ], 200);

    }

// Delte Product
public function destroy($id){
    $product = Product::find($id);

    if (!$product) {
        return response()->json(['message' => 'Product not found'], 404);
    }

    // Use correct column name
    $product_name = $product->name;

    $folderPath = public_path("products/" . $product_name);

    /* DELETE FEATURED IMAGE */
    $featuredImage = $product->featured_image;
    $featuredImagePath = $folderPath . '/' . $featuredImage;

    if ($featuredImage && File::exists($featuredImagePath)) {
        unlink($featuredImagePath);
    }

    /* DELETE EXTRA IMAGES */
    $images = json_decode($product->images, true);

    if (is_array($images)) {
        foreach ($images as $img) {
            $imgPath = $folderPath . '/' . $img;
            if (File::exists($imgPath)) {
                unlink($imgPath);
            }
        }
    }

    /* DELETE product folder */
    if (File::exists($folderPath)) {
       rmdir($folderPath);
    }

    /* DELETE DATA FROM DB */
     $product->delete();

    return response()->json(['message' => 'Product deleted successfully']);
}







}
