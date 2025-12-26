<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\Product;
use App\Models\ProductVariant;

// CHANGED: required imports
use Illuminate\Support\Facades\File;                     // CHANGED: needed for Str::slug()
use Illuminate\Support\Str;   
use Validator;


class ProductController extends Controller
{
    //
    public function Index()
    {
        $categories = Category::all();
        $products = Product::all();        
       return view('admin.products.index',compact('categories','products'));
    }

     // Create a new product
    public function store(Request $request){
        echo "Update method called";     
          
         $vendor_id = $request->vendor_id;
         $name = $request->name;
         $short_description = $request->short_description;
         $description = $request->description;
         $type = $request->type;
         $slug = $request->slug;
         $sku = $request->sku;
         $category_id = $request->category_id;
         $total_allowed_qty = $request->total_allowed_qty;

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

        // Create the product

         $images_list = [];

        // NOTE: Postman must send files as images[] (multiple rows)
        if ($request->hasFile('images')) {

            foreach ($request->file('images') as $file) {

                $image_dir = $baseFolder; // images stored in public/products/{slug}/

                // ensure exists
                if (! File::exists($image_dir)) {
                    File::makeDirectory($image_dir, 0755, true);
                }

                $image_name = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();

                $file->move($image_dir, $image_name);

                // store relative path
                $images_list[] = $image_name;
            }
        }

         $product = [
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'type' => $request->type,
            'slug' => $request->slug ? Str::slug($request->slug) : Str::slug($request->name),
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'total_allowed_qty' => $request->total_allowed_qty,
            'product_name' => $product_name,
            'featured_image' => $imageName,
            'images' => $images_list,
        ];
        print_r($product);

        Product::insert([
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'type' => $request->type,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'total_allowed_qty' => $request->total_allowed_qty,
            'featured_image' => $imageName,
            'images' => json_encode($images_list),
        ]);
        
        flash('success', 'Product created successfully!');
        return redirect()->route('admin.products_index');
        
        // Create the product 

    }

    public function Edit($id)
    {
        //        
        $categories = Category::all();
        $product_data = Product::where('id', $id)->first();        
       
        return view('admin.products.edit', compact('product_data', 'categories'));
    }

    public function Update(Request $request)
    {
         echo "Update method called";        
         $vendor_id = $request->vendor_id;
         $name = $request->name;
         $short_description = $request->short_description;
         $description = $request->description;
         $type = $request->type;
         $slug = $request->slug;
         $sku = $request->sku;
         $category_id = $request->category_id;
         $total_allowed_qty = $request->total_allowed_qty;
         $ofeatured_image = $request->ofeatured_image;
         $oimages = $request->oimages;
         $id = $request->idi;

            // Update the product

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
            if (File::exists(public_path('products/'.$product_name.'/'.$ofeatured_image))) {
                unlink(public_path('products/'.$product_name.'/'.$ofeatured_image));
            }

            $file = $request->file('featured_image');

            $imageName = uniqid().'.'.$file->getClientOriginalExtension();

            $file->move(public_path('products/'.$product_name), $imageName); // 🔥 Image gets saved
        } else {
            $imageName = $ofeatured_image;
        }

        // NOTE: Postman must send files as images[] (multiple rows)
        if ($request->hasFile('images')) {
            $oldImages = json_decode($product->images, true);
            if (is_array($oldImages)) {
                foreach ($oldImages as $img) {
                    $fullPath = $folderPath.$img;
                    if (File::exists(public_path('products/'.$product_name.'/'.$img))) {
                        unlink(public_path('products/'.$product_name.'/'.$img));
                    }

                }
            }

            $images_list = [];

            foreach ($request->file('images') as $file) {
                $image_dir = $baseFolder; 

                // ensure exists
                if (! File::exists($image_dir)) {
                    File::makeDirectory($image_dir, 0755, true);
                }
                $image_name = time().'_'.uniqid().'.'.$file->getClientOriginalExtension();
                $file->move($image_dir, $image_name);

                // store relative path
                $images_list[] = $image_name;
            }
            $images_list = json_encode($images_list);

        } else {
            $images_list = $oimages; // keep existing images
            // Delete old images one by one
        }

         Product::where('id', $id)->update([
            'vendor_id' => $request->vendor_id,
            'name' => $request->name,
            'short_description' => $request->short_description,
            'description' => $request->description,
            'type' => $request->type,
            'slug' => $request->slug,
            'sku' => $request->sku,
            'category_id' => $request->category_id,
            'total_allowed_qty' => $request->total_allowed_qty,
            'featured_image' => $imageName,
            'images' => $images_list,
        ]);
        flash('success', 'Product updated successfully!');
        return redirect()->route('admin.products_index');
    }


    public function view($id){
        //
        $categories = Category::all();
        $product = Product::where('id', $id)->first();
        $product_variant = ProductVariant::where('product_id',$id)->get();
        return view('admin.products.view', compact('product','categories','product_variant'));
    }

    public function Delete($id){
        //        

         $product = Product::find($id);

        if (! $product) {
            flash('error', 'Product deleted successfully!');
            return redirect()->route('admin.products_index');
        }

        // Use correct column name
        $product_name = $product->name;

        $folderPath = public_path('products/'.$product_name);

        /* DELETE FEATURED IMAGE */
        $featuredImage = $product->featured_image;
        $featuredImagePath = $folderPath.'/'.$featuredImage;

        if ($featuredImage && File::exists($featuredImagePath)) {
            unlink($featuredImagePath);
        }

        /* DELETE EXTRA IMAGES */
        $images = json_decode($product->images, true);

        if (is_array($images)) {
            foreach ($images as $img) {
                $imgPath = $folderPath.'/'.$img;
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
        Product::where('id', $id)->delete();
        $product->delete();
        ProductVariant::where('product_id',$id)->delete();
        flash('success', 'Product deleted successfully!');
        return redirect()->route('admin.products_index');
    }


    public function Approve($id){
        echo $id;
        $user = Product::where('id',$id)->first();
        Product::where('id',$id)->update([
            'is_approved'=>'1'
        ]);        
        flash('success', 'Product Aproved successfully!');
        return redirect()->route('admin.products_index'); 
    }

    public function Reject($id){        
        $user = Product::where('id',$id)->first();
        Product::where('id',$id)->update([
            'is_approved'=>'0'
        ]);
        flash('error', 'Product Rejected successfully!');
        return redirect()->route('admin.products_index'); 
    }

    
}
