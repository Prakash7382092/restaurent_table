@extends('admin.layouts.vertical', ['title' => 'Edit Attribute Value'])

@section('content')
@include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Edit Attribute Value'])

<div class="flex justify-center">
    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow">

        <form id="productForm" method="POST" action="{{ route('admin.attribute_values_update') }}">
            @csrf
            <input type="hidden" name="id" value="{{ $attributeValue->id }}">

            <label class="block text-sm font-medium mb-1">Attribute</label>
            <select name="attribute_id" class="w-full rounded-md border-gray-300" required>
                @foreach($attributes as $attribute)
                    <option value="{{ $attribute->id }}"
                        {{ $attributeValue->attribute_id == $attribute->id ? 'selected' : '' }}>
                        {{ $attribute->name }}
                    </option>
                @endforeach
            </select>

            <label class="block text-sm font-medium mt-3 mb-1">Value</label>
            <input type="text" name="value"
                   value="{{ $attributeValue->value }}"
                   class="w-full rounded-md border-gray-300" required>

            <label class="block text-sm font-medium mt-3 mb-1">Numeric Value</label>
            <input type="number" step="0.01"
                   name="numeric_value"
                   value="{{ $attributeValue->numeric_value }}"
                   class="w-full rounded-md border-gray-300">

            <input type="submit"
                   value="Update"
                   class="w-full mt-4 bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
        </form>

    </div>
</div>
@endsection
