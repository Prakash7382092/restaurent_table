<?php

namespace App\Http\Controllers\vendor;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;

class OrderController extends Controller
{
    //
      public function Index(){
         $orders = Order::all();        
       return view('vendor.orders.index',compact('orders'));
    }
    public function Show($id){        
        $orders= Order::where('id',$id)->first();
        $order_item= OrderItem::where('order_id',$id)->get();
        return view('vendor.orders.show',compact('orders','order_item'));      
    }

}
