<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    // 1️⃣ List all reviews (Admin)
    public function index()
    {
        return response()->json(
            Review::with(['customer', 'restaurants'])->latest()->get()
        );
    }
    
    // 2️⃣ Store review
    public function store(Request $request)
{
    $validator = Validator::make($request->all(), [
        'customer_id' => 'required|exists:users,id',
        'restaurent_id' => 'required|exists:restaurants,id',
        'rating' => 'required|integer|min:1|max:5',
        'comments' => 'nullable|string',
        'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048', // single image
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors(), 422);
    }

    $imageName = null;

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('reviews'), $imageName); // move to public/reviews
    }

    $review = Review::create([
        'customer_id' => $request->customer_id,
        'restaurent_id' => $request->restaurent_id,
        'rating' => $request->rating,
        'comments' => $request->comments,
        'images' => $imageName, // store single filename
        'is_approved' => false,
    ]);

    return response()->json([
        'message' => 'Review created successfully',
        'data' => $review,
    ], 201);
}



    // 3️⃣ Show single review
    public function show($id)
    {
        return response()->json(
            Review::with(['customer', 'product'])->findOrFail($id)
        );
    }

    // 4️⃣ Update review
    public function update(Request $request, $id)
    {
        $review = Review::findOrFail($id);

        $review->update($request->only([
            'customer_id' => $request->customer_id,
            'restaurent_id'  => $request->restaurent_id,
            'rating'      => $request->rating,
            'comments'    => $request->comments,        
            'is_approved' => true
        ]));

        return response()->json([
            'message' => 'Review updated',
            'data' => $review
        ]);

    }

    // 5️⃣ Delete review
    public function destroy($id)
    {
        Review::findOrFail($id)->delete();
        return response()->json([
            'message' => 'Review deleted successfully'
        ]);
    }
}
