<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //

    public function Index()
    {
         $categories = Category::all();        
       return view('vendor.category.index',compact('categories'));
    }

    public function Edit($id){
      
       $category_data = Category::where('id', $id)->first();  
      return view('vendor.category.edit', compact('category_data'));
    }

    public function Store(Request $request){
       
        $parent_id = $request->parent_id;
        $category_name  =$request->category_name;
        $category_slug = $request->category_slug;
        $position = $request->position;


        Category::insert([
          'parent_id'=>$parent_id,
          'name'=>$category_name,
          'slug'=>$category_slug,
          'position'=>$position
        ]);
         flash('success', 'Categories Created successfully!');
        return redirect()->route('vendor.categories');
    }

    public function Update(Request $request){
       $id  = $request->category_id;
        $parent_id = $request->parent_id;
        $category_name  =$request->category_name;
        $category_slug = $request->category_slug;
        $position = $request->position;


        Category::where('id',$id)->update([
          'parent_id'=>$parent_id,
          'name'=>$category_name,
          'slug'=>$category_slug,
          'position'=>$position
        ]);

         flash('success', 'Categories Updated successfully!');
        return redirect()->route('vendor.categories');
    }


     public function Delete($id){
         Category::where('id', $id)->delete();
        flash('success', 'Product deleted successfully!');
        return redirect()->route('vendor.categories');
    }

}
