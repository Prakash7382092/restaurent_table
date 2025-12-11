<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    //
    public function index()
    {
        //
        $categories = Category::all();
        return response()->json([
            'categories' => $categories,
        ], 200);
    }   

   public function show($id){
      $categories = Category::where('id',$id)->get();
        return response()->json([
            'categories' => $categories,
        ], 200);     


   }

    public function store(Request $request)
    {
        //
         $request->validate([
            'parent_id' => 'required',
            'name' => 'required',
            'slug' => 'required',
            'position' => 'required|integer',
            
        ]);
        $category = Category::create([
            'parent_id' => $request->parent_id,
            'name' => $request->name,
            'slug' => $request->slug,
            'position' => $request->position,
        ]);
        return response()->json([
            'message' => 'Category created successfully',
            'category' => $category,
        ], 201);
        
    }
    //Update category

    public function update(Request $request, $id)
    {
        //
            $request->validate([
                'parent_id' => 'required',
                'name' => 'required',
                'slug' => 'required',
                'position' => 'required|integer',
                
            ]);

            $category = Category::findOrFail($id);
            $category->update([
                'parent_id' => $request->parent_id,
                'name' => $request->name,
                'slug' => $request->slug,   
                'position' => $request->position,
            ]);
            return response()->json([
                'message' => 'Category updated successfully',
                'category' => $category,
            ], 200);
    }
    //Delete category

    public function destroy($id)
    {
        //
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json([
                'message' => 'Category deleted successfully',
            ], 200);
    }
}
