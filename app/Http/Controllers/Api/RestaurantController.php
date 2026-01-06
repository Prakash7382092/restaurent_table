<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Restaurant;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class RestaurantController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
         $restaurant = Restaurant::all();

        return response()->json([
            'categories' => $restaurant,
        ], 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //Insert 
         $request->validate([
            'name' => 'required|string|max:255',
            'address' => 'required|string',
            'phone_number' => 'required|string',         
            'email' => 'required|email|unique:restaurants,email',           
            'logo' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
         
        ]);

        // Generate slug
        $slug = Str::slug($request->name);

        // Create folder if not exists
        $folderPath = public_path("restaurants/{$slug}/uploaded_logo");
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $logoPath = null;

        if ($request->hasFile('logo')) {
            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move($folderPath, $logoName);
            $logoPath = "restaurants/{$slug}/uploaded_logo/{$logoName}";
        }


        $food_store = ([
             'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'phone_code' =>'+356',
            'email' => $request->email,
            'timezone' => 'GMT+1',
            'logo' => $logoName,
            'country_id' => '356',
            'currency_id' => '€',
        ]);



        $restaurant = Restaurant::insert([
           'name' => $request->name,
            'address' => $request->address,
            'phone_number' => $request->phone_number,
            'phone_code' =>'+356',
            'email' => $request->email,
            'timezone' => 'GMT+1',
            'logo' => $logoName,
            'country_id' => '356',
            'currency_id' => '€',
        ]);

        return response()->json([
            'message' => 'Restaurent created successfully',
            'Restaurent' => $food_store,
        ], 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
         $restaurant = Restaurant::where('id', $id)->get();

        return response()->json([
            'restaurant' => $restaurant,
        ], 200);

    }

    /**
     * Update the specified resource in storage.
     */
   public function update(Request $request, string $id){
        $restaurant = Restaurant::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'address'      => 'required|string',
            'phone_number' => 'required|string|max:15',
            'email'        => 'required|email|unique:restaurants,email,' . $restaurant->id,
     
        ]);

        // Old slug & new slug
        $oldSlug = Str::slug($restaurant->name);
        $newSlug = Str::slug($request->name);

        // If name changed → rename folder
        if ($oldSlug !== $newSlug) {
            $oldPath = public_path("restaurants/{$oldSlug}");
            $newPath = public_path("restaurants/{$newSlug}");

            if (File::exists($oldPath)) {
                File::move($oldPath, $newPath);
            }
        }

        $folderPath = public_path("restaurants/{$newSlug}/uploaded_logo");
        if (!File::exists($folderPath)) {
            File::makeDirectory($folderPath, 0755, true);
        }

        $logoName = $restaurant->logo;

        // If new logo uploaded
        if ($request->hasFile('logo')) {

            // Delete old logo
            if ($restaurant->logo && File::exists(public_path($restaurant->logo))) {
                File::delete(public_path($restaurant->logo));
            }

            $logo = $request->file('logo');
            $logoName = time() . '_' . $logo->getClientOriginalName();
            $logo->move($folderPath, $logoName);

            $logoName = "restaurants/{$newSlug}/uploaded_logo/{$logoName}";
        }

        // Update DB
        $restaurant->update([
            'name'         => $request->name,
            'address'      => $request->address,
            'phone_number' => $request->phone_number,
            'phone_code'   => $request->phone_code ?? $restaurant->phone_code,
            'email'        => $request->email,
            'timezone'     => $request->timezone ?? $restaurant->timezone,
            'logo'         => $logoName,
            'country_id'   => $request->country_id ?? $restaurant->country_id,
            'currency_id'  => $request->currency_id ?? $restaurant->currency_id,
        ]);

        return response()->json([
            'message'    => 'Restaurant updated successfully',
            'restaurant' => $restaurant,
        ], 200);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
        $restaurant = Restaurant::findOrFail($id);        
        $restaurant->delete();

        return response()->json([
            'message' => 'Restaurant deleted successfully',
        ], 200);

    }
}
