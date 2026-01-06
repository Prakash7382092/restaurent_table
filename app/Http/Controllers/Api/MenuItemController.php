<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MenuItem;
use App\Models\Restaurant;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;    
use Illuminate\Support\Facades\File;

class MenuItemController extends Controller
{
    // List all menu items
    public function index(){
        $items = MenuItem::with(['menu', 'restaurant'])->get();
        return response()->json($items);
    }

    // Store a menu item
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'menu_id' => 'required|exists:menus,id',
            'restaurent_id' => 'required|exists:restaurants,id',
            'item_name' => 'required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'price' => 'required|numeric',
            'is_available' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

      
        $imageName = null;      

        if ($request->hasFile('image')) {            
            $restaurant = Restaurant::find($request->restaurent_id);           
            $restaurantSlug = Str::slug($restaurant->name);           
            $folderPath = public_path(
                'restaurants/' . $restaurantSlug
            );           
            if (!File::exists($folderPath)) {
                File::makeDirectory($folderPath, 0755, true);
            }         
            $image = $request->file('image');
            $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();            
            $image->move($folderPath, $imageName);
        }




        

        $item = MenuItem::create([
            'menu_id'=>$request->menu_id,
            'restaurent_id'=>$request->restaurent_id,
            'item_name'=>$request->item_name,
            'image'=>$imageName,
            'description'=>$request->description,
            'type'=>$request->type,
            'price'=>$request->price,
            'is_available'=>$request->is_available
        ]);


        return response()->json([
            'message' => 'Menu item created successfully',
            'data' => $item
        ]);
    }

    // Show single menu item
    public function show($id)
    {
        $item = MenuItem::with(['menu', 'restaurant'])->find($id);
        if (!$item) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }
        return response()->json($item);
    }

    // Update menu item
    public function update(Request $request, $id)
    {
        $item = MenuItem::find($id);
        if (!$item) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'menu_id' => 'sometimes|required|exists:menus,id',
            'restaurent_id' => 'sometimes|required|exists:restaurants,id',
            'item_name' => 'sometimes|required|string|max:255',
            'image' => 'nullable|image|max:2048',
            'description' => 'nullable|string',
            'type' => 'nullable|string',
            'price' => 'sometimes|required|numeric',
            'is_available' => 'nullable|boolean',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        // Handle image upload if exists
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('menu_items', 'public');
            $request->merge(['image' => $path]);
        }

        $item->update($request->all());

        return response()->json([
            'message' => 'Menu item updated successfully',
            'data' => $item
        ]);
    }

    // Delete menu item
    public function destroy($id)
    {
        $item = MenuItem::find($id);
        if (!$item) {
            return response()->json(['message' => 'Menu item not found'], 404);
        }

        $item->delete();
        return response()->json(['message' => 'Menu item deleted successfully']);
    }
}
