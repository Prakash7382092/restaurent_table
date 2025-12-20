<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\RegisterCustomerRequest;
use App\Http\Requests\RegisterVendorRequest;

use Illuminate\Support\Facades\File;                     // CHANGED: needed for Str::slug()
use Illuminate\Support\Str;   
use Validator;
use App\Models\User;
use App\Models\Vendor;



class VendorController extends Controller
{
    //
    public function Index(){
        $users = User::where('role','vendor')->get();
        return view('admin.vendor.index',compact('users'));
    }

    public function Store(Request $request){
        // ✅ Validation
        $request->validate([
            'vendor_name'     => 'required|string|max:255',
            'vendor_email'    => 'required|email|unique:users,email',
            'vendor_password' => 'required|min:6',
        ]);

        DB::beginTransaction();

        try {
               // ✅ Create user (RETURNS MODEL)
            $user = User::create([
                'name'     => $request->vendor_name,
                'email'    => $request->vendor_email,
                'password' => Hash::make($request->vendor_password),
                'is_admin' => 0,
                'role'     => 'vendor',
                'status'   => 'pending_approval',
            ]);

                // ✅ Now this WILL WORK
            $user_id = $user->id;



            
          // Prepare folder name: slug of product name
        $vendor_name = Str::slug($request->vendor_name);

        // base folder under public/
        $baseFolder = public_path("vendors/{$vendor_name}");

        // Ensure directories exist before moving files
        if (! File::exists($baseFolder)) {
            // CHANGED: recursively create directories
            File::makeDirectory($baseFolder, 0755, true);
        }

        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $store_logo = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('vendors/'.$vendor_name), $store_logo); // 🔥 Store Logo gets saved
        } else {
            $store_logo = '';
        }


        if ($request->hasFile('store_banner')) {
            $file = $request->file('store_banner');
            $store_banner = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('vendors/'.$vendor_name), $store_banner); // 🔥 Store Banner gets saved
        } else {
            $store_banner = '';
        }        


            // ✅ Create vendor profile (optional)
            Vendor::create([
                'user_id'           => $user_id,
                'store_name'        => $request->store_name,
                'store_description' => $request->description,
                'store_location'    => $request->store_location,
                'store_contact'     => $request->store_contact,
                'store_logo'        =>$store_logo,
                'store_banner'      =>$store_banner,
                'store_website'     =>$request->store_website,
                'commission_rate'   =>$request->commision_rate
            ]);

            DB::commit();

            return back()->with('success', 'Vendor created successfully');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => $e->getMessage()]);
        }
    }

    public function Show($id){        
         $users = User::where('id',$id)->first();         
         $vendors = Vendor::where('user_id',$id)->first();
         return view('admin.vendor.show',compact('users','vendors'));
    }

    public function Delete($id){
          User::where('id',$id)->delete();
         Vendor::where('user_id', $id)->delete();
        flash('success', 'Product Deleted successfully!');
        return redirect()->route('admin.vendor');        
    }

    public function Approve($id){
        echo $id;
        $user = User::where('id',$id)->first();
        User::where('id',$id)->update([
            'status'=>'active'
        ]);
        flash('success', 'Vendor Aproved successfully!');
        return redirect()->route('admin.vendor'); 
    }

    public function Reject($id){        
        $user = User::where('id',$id)->first();
        User::where('id',$id)->update([
            'status'=>'pending_approval'
        ]);
        flash('error', 'Vendor Rejected successfully!');
        return redirect()->route('admin.vendor'); 
    }


    public function Edit($id){        
         $users = User::where('id',$id)->first();         
         $vendors = Vendor::where('user_id',$id)->first();
         return view('admin.vendor.edit',compact('users','vendors'));
    }

    public function update(Request $request){
        $id = $request->idi;
        $store_name = $request->store_name;
        $description =$request->description;
        $store_location  = $request->store_location;
        $store_position = $request->store_position;
        $store_website = $request->store_website;
        $commision_rate = $request->commision_rate;
        $ostore_logo = $request->ostore_logo;
        $ostore_banner= $request->ostore_banner;


        if ($request->hasFile('store_logo')) {
            $file = $request->file('store_logo');
            $store_logo = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('vendors/'.$vendor_name), $store_logo); // 🔥 Store Logo gets saved
        } else {
            $store_logo = $ostore_logo;
        }


        if ($request->hasFile('store_banner')) {
            $file = $request->file('store_banner');
            $store_banner = uniqid().'.'.$file->getClientOriginalExtension();
            $file->move(public_path('vendors/'.$vendor_name), $store_banner); // 🔥 Store Banner gets saved
        } else {
            $store_banner = $ostore_banner;
        }  

        Vendor::where('id',$id)->update([
            'store_name'=>$request->store_name,
            'store_description'=>$request->store_description,
            'store_location'=>$request->store_location,
            'store_contact'=>$request->store_contact,
            'store_logo'=>$store_logo,
            'store_banner'=>$store_banner,
            'store_website'=>$store_website,
            'commission_rate'=>$request->commision_rate
        ]);

         flash('success', 'Vendor Updated successfully!');

        return redirect()->route('admin.vendor'); 

        
    }


    

    


}
