<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
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

       // Get vendor statistics
        $stats = [
            'total_products' => Product::where('vendor_id', $vendor->id)->count(),
            'active_products' => Product::where('vendor_id', $vendor->id)->where('is_active', true)->count(),
            'pending_products' => Product::where('vendor_id', $vendor->id)->where('is_approved', false)->count(),
            'total_orders' => Order::whereHas('items.productVariant', function ($query) use ($vendor) {
                $query->whereHas('product', function ($q) use ($vendor) {
                    $q->where('vendor_id', $vendor->id);
                });
            })->count(),
            'pending_orders' => Order::where('status', 'pending')
                ->whereHas('items.productVariant', function ($query) use ($vendor) {
                    $query->whereHas('product', function ($q) use ($vendor) {
                        $q->where('vendor_id', $vendor->id);
                    });
                })->count(),
            'completed_orders' => Order::where('status', 'completed')
                ->whereHas('items.productVariant', function ($query) use ($vendor) {
                    $query->whereHas('product', function ($q) use ($vendor) {
                        $q->where('vendor_id', $vendor->id);
                    });
                })->count(),
            'total_revenue' => Order::where('status', 'completed')
                ->whereHas('items.productVariant', function ($query) use ($vendor) {
                    $query->whereHas('product', function ($q) use ($vendor) {
                        $q->where('vendor_id', $vendor->id);
                    });
                })->sum('total_payable') ?? 0,
        ];

        // Get recent products
        $recentProducts = Product::where('vendor_id', $vendor->id)
            ->latest()
            ->take(5)
            ->get();

        // Get recent orders with proper eager loading
        $recentOrders = Order::whereHas('items.productVariant', function ($query) use ($vendor) {
            $query->whereHas('product', function ($q) use ($vendor) {
                $q->where('vendor_id', $vendor->id);
            });
        })
        
            ->with(['user', 'items.productVariant.product'])
            ->latest()
            ->take(5)
            ->get();

        return view('vendor.index', compact('stats', 'recentProducts', 'recentOrders', 'vendor'));
    }


    public function AdminIndex(){
        
         $user = User::where('id', auth()->id())->first(); 
        

           if (!$user) {
            return redirect()->route('login')->with('error', 'No vendor account found.');
        }

       // Get vendor statistics
        $stats = [
           
              'total_products' => Product::count(),
                'active_products' => Product::where('is_active', true)->count(),
                'pending_products' => Product::where('is_approved', false)->count(),
                'total_orders' => Order::count(),
        
            'pending_orders' => Order::where('status', 'pending') ->count(),
            'completed_orders' => Order::where('status', 'completed')->count(),
            'total_revenue' => Order::where('status', 'completed')
            ->whereHas('items.productVariant.product')
            ->sum('total_payable') ?? 0,
        ];

        // Get recent products
        $recentProducts = Product::latest()
                            ->take(5)
                            ->get();

        // Get recent orders with proper eager loading
        $recentOrders = Order::whereHas('items.productVariant.product')
            ->with(['user', 'items.productVariant.product'])
            ->latest()
            ->take(5)
            ->get();

        return view('admin.index', compact('stats', 'recentProducts', 'recentOrders', 'user'));


    }

    

    
}
