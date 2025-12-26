<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CategoryAttribute;
use App\Models\Category;
use App\Models\Attribute;


class CategoryAttributeController extends Controller
{
    // List all pivot entries
    public function index()
    {
        $CategoryAttribute = CategoryAttribute::all();      
        $categories = Category::all();
        $attributes =Attribute::all();        
        $categoryAttributes = CategoryAttribute::all();        
        return view('admin.category_attributes.index', compact('attributes','categories','CategoryAttribute'));
    }

    // Create form
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();
        return view('admin.category_attributes.create', compact('categories','attributes'));
    }

    // Store new pivot
    public function store(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id',
            'attribute_id' => 'required|exists:attributes,id',
        ]);

        CategoryAttribute::create($request->all());

        flash('success','Category-Attribute assigned successfully!');
        return redirect()->route('admin.category_attributes');
    }

    // Edit form
    public function edit($id)
    {
        $categoryAttribute = CategoryAttribute::findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::all();
        return view('admin.category_attributes.edit', compact('categoryAttribute','categories','attributes'));
    }

    // Update pivot
    public function update(Request $request)
    {
      

        CategoryAttribute::where('id', $request->idi)->update([
            'category_id' => $request->category_id,
            'attribute_id' => $request->attribute_id,
        ]);

        flash('success','Category-Attribute updated successfully!');
       return redirect()->route('admin.category_attributes');
    }

    // Delete pivot
    public function delete($id)
    {
        CategoryAttribute::where('id',$id)->delete();
        flash('success','Category-Attribute removed successfully!');
        return back();
    }
}
