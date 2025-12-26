<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AttributeValue;
use App\Models\Category;
use App\Models\Attribute;

class AttributeValueController extends Controller
{
    // List all attribute values
    public function index()
    {
         $attributes = Attribute::all();
        $attributeValues = AttributeValue::with(['category','attribute'])->get();
        return view('admin.attribute_values.index', compact('attributeValues','attributes'));
    }

    // Show create form
    public function create()
    {
        $categories = Category::all();
        $attributes = Attribute::all();
        
        return view('admin.attribute_values.create', compact('categories','attributes'));
    }

    // Store new value
    public function store(Request $request)
    {
        echo "Welcome";
        $request->validate([
         
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255',
            'numeric_value' => 'nullable|numeric',
        ]);



         AttributeValue::insert([
            'attribute_id' => $request->attribute_id,
            'value' => $request->value,
            'numeric_value' => $request->numeric_value,
        ]);

        flash('success','Attribute value created successfully!');
        return redirect()->route('admin.attribute_values');
    }

    // Edit form
    public function edit($id)
    {
        $attributeValue = AttributeValue::findOrFail($id);
        $categories = Category::all();
        $attributes = Attribute::all();
        return view('admin.attribute_values.edit', compact('attributeValue','categories','attributes'));
    }

    // Update value
    public function update(Request $request)
    {
        $request->validate([
            'id' => 'required|exists:attribute_values,id',
           
            'attribute_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255',
            'numeric_value' => 'nullable|numeric',
        ]);

        AttributeValue::where('id', $request->id)->update([
           
            'attribute_id' => $request->attribute_id,
            'value' => $request->value,
            'numeric_value' => $request->numeric_value,
        ]);

        flash('success','Attribute value updated successfully!');
        return redirect()->route('admin.attribute_values');
    }

    // Delete
    public function delete($id)
    {
        AttributeValue::where('id',$id)->delete();
        flash('success','Attribute value deleted successfully!');
        return redirect()->route('admin.attribute_values');
    }
}
