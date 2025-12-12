<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
Use Illuminate\Support\Facades\Session;


class AuthController extends Controller{
    // Vendor AuthController methods
    public function Index(){
        if (Session::has('vendor_name')) { 
               
            return redirect()->route('vendor.dashboard');
        }else{   
             flash()->error('Please Login.');            
            return redirect()->route('vendor.login');
        }
    }

    public function login(Request $request){   
       
        // Vendor login logic here
       return view('vendor.login');
    }

    public function check(Request $request){
         $email = $request->input('email');
         $password = $request->input('password');
        $user = User::where('email', $email)->first();
        if ($user && $user->isVendor() && \Hash::check($password, $user->password)) {     
         
                Session::put('vendor_name', $user->name);
                Session::put('vendor_email', $user->email);

              flash()->success('Vendor Login successfully.');
            
           return view('vendor.index');  // Redirect to vendor dashboard or desired route
        } else {
            // Authentication failed...
             flash()->error('Invalid credentials or not a vendor.');
            return redirect()->route('vendor.login');
        }

    }


    public function logout(){
         // Remove only vendor session values
        Session::forget('vendor_name');
        Session::forget('vendor_email');

        flash()->success('Vendor Logout successfully.');

        return redirect()->route('vendor.login');
    }
}
