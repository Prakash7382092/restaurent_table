<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Menu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class MenuController extends Controller
{
    // List all menus
    public function index()
    {
        $menus = Menu::with('restaurant')->get();
        return response()->json($menus);
    }

    // Create new menu
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'restaurent_id' => 'required|exists:restaurants,id',
            'menu_name' => 'required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu = Menu::create($request->all());

        return response()->json([
            'message' => 'Menu created successfully',
            'data' => $menu
        ]);
    }

    // Show single menu
    public function show($id)
    {
        $menu = Menu::with('restaurant')->find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }
        return response()->json($menu);
    }

    // Update menu
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $validator = Validator::make($request->all(), [
            'restaurent_id' => 'sometimes|required|exists:restaurants,id',
            'menu_name' => 'sometimes|required|string|max:255',
            'sort_order' => 'nullable|integer',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $menu->update($request->all());

        return response()->json([
            'message' => 'Menu updated successfully',
            'data' => $menu
        ]);
    }

    // Delete menu
    public function destroy($id)
    {
        $menu = Menu::find($id);
        if (!$menu) {
            return response()->json(['message' => 'Menu not found'], 404);
        }

        $menu->delete();

        return response()->json(['message' => 'Menu deleted successfully']);
    }
}
