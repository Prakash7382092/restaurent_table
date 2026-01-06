<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;

use App\Models\Vendor;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Session;

class DashboardController extends Controller
{
    public function index()
    {
        $vendor = Vendor::where('user_id', auth()->id())->first();          
        if (!$vendor) {
            return redirect()->route('login')->with('error', 'No vendor account found.');
        }
        return view('vendor.index', compact('vendor'));
    }


    public function AdminIndex(){
        
         $user = User::where('id', auth()->id())->first(); 
        

           if (!$user) {
            return redirect()->route('login')->with('error', 'No vendor account found.');
        }

      

        return view('admin.index', compact('user'));


    }

    

    
}
