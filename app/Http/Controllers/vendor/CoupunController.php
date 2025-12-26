<?php

namespace App\Http\Controllers\Vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use App\Models\CouponCode;
use Illuminate\Support\Str;

class CoupunController extends Controller
{
    //
    public function Index(){
        $coupuns = CouponCode::all();        
        return view('vendor.coupun.index',compact('coupuns'));
    }

     public function Store(Request $request){
        // Validate the request
        $request->validate([
            'code' => 'required|unique:coupons,code|max:50',
            'title' => 'required|string|max:100',
            'description' => 'nullable|string',
            'discount_type' => 'required|in:percentage,fixed',
            'discount_value' => 'required|numeric|min:0',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        // Insert coupon into database
        CouponCode::create([
            'code' => strtoupper($request->code),
            'title' => $request->title,
            'description' => $request->description,
            'discount_type' => $request->discount_type,
            'discount_value' => $request->discount_value,
            'start_date' => $request->start_date,
            'end_date' => $request->end_date,
        ]);

        // Flash success message
        flash('success', 'Coupon created successfully!');

        // Redirect back to coupon list
        return redirect()->route('vendor.coupuns');
    }

}
