@extends('admin.layouts.vertical', ['title' => 'Edit Category Attribute'])

@section('content')
@include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Edit Category Attribute'])

<div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">
    <div class="lg:col-span-4 col-span-1">
        <div class="card">
            <div class="card-body">
                <form action="{{ route('admin.category_attributes.update') }}" method="POST">
                    @csrf
                    <input type="hidden" name="idi" value="{{ $categoryAttribute->id }}">
                    <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                    <select name="category_id" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required>
                        @foreach($categories as $cat)
                            <option value="{{ $cat->id }}" {{ $categoryAttribute->category_id == $cat->id ? 'selected' : '' }}>{{ $cat->name }}</option>
                        @endforeach
                    </select>

                    <label class="block text-sm font-medium text-gray-700 mb-1 mt-2">Attribute</label>
                    <select name="attribute_id" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required>
                        @foreach($attributes as $attr)
                            <option value="{{ $attr->id }}" {{ $categoryAttribute->attribute_id == $attr->id ? 'selected' : '' }}>{{ $attr->name }}</option>
                        @endforeach
                    </select>

                    <input type="submit" value="Update Assignment" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 cursor-pointer">
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

