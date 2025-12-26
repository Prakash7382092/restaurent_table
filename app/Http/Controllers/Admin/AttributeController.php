<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Attribute;

class AttributeController extends Controller
{
    //
    public function Index(){
      $attributes = Attribute::all();
        return view('admin.attributes.index',compact('attributes'));
    }

    public function Store(Request $request){
         $name = $request->name;
         $code = $request->code;

         Attribute::insert([
            'name'=>$name,
            'code'=>$code,
         ]);
          flash('success', 'Attributes Created successfully!');
        return redirect()->route('admin.attributes');


    }

    public function Edit($id){    
      $attribute_edit = Attribute::where('id',$id)->first();
      return view('admin.attributes.edit',compact('attribute_edit'));
    }

    public function Update(Request $request){
      $id = $request->idi;
       $name = $request->name;
         $code = $request->code;

         Attribute::where('id',$id)->update([
            'name'=>$name,
            'code'=>$code,
         ]);
          flash('success', 'Attributes Updated successfully!');
        return redirect()->route('admin.attributes');

    }


    public function Delete($id){
                  Attribute::where('id', $id)->delete();
        flash('success', 'Product deleted successfully!');
        return redirect()->route('admin.attributes');
    }
    
}
?>