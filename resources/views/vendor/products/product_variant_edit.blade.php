@extends('vendor.layouts.vertical', ['title' => 'Dashboard']) @section('css') @endsection @section('content')
@include('vendor.layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])

<div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">
    <div class="lg:col-span-4 col-span-1">
        <div class="card">
            <div class="card-header"></div>

            <div class="card-header">
                <h6 class="card-title"> Product Variant</h6>

                <a class="btn btn-sm border-0 text-primary/90 hover:text-primary"
                    href="{{ route('vendor.dashboard') }}">
                    View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                </a>
            </div>
            <!-- Product Variants -->
            <div class="flex flex-col">
                <div class="flex items-center justify-center min-h-screen bg-gray-50">
                    <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
                        <form id="productForm" action="{{ route('vendor.product_variant_update') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <input
                                type="hidden"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="vendor_id"
                                placeholder="Enter product name"
                                value="{{ Session::get('vendor_id') }}"/>

                            <input
                                type="hidden"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="product_id"
                                placeholder="Enter product name"
                                value="{{ $product_id }}"
                            />

                            <input
                                type="hidden"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="variant_id"
                                placeholder="Enter product name"
                                value="{{ $product_variant->id }}"
                            />

                            <label class="block text-sm font-medium text-gray-700 mb-1"> Variant Name </label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="variant_name"
                                placeholder="Enter product variant name"
                                value="{{ $product_variant->variant_name }}"
                                required
                            />

                            <label class="block text-sm font-medium text-gray-700 mb-1"> Base Price</label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="base_price"
                                placeholder="Enter product Base Price"
                                value="{{$product_variant->base_price }}"
                                required
                            />

                            <label class="block text-sm font-medium text-gray-700 mb-1"> Original Price</label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="original_price"
                                placeholder="Enter product Original Price"
                                value="{{$product_variant->original_price }}"
                                required
                            />

                           @php
                                // Convert the comma-separated attribute_value_ids string into an array
                                $selectedAttributes = explode(',', $product_variant->attribute_value_ids ?? '');
                            @endphp

                            @foreach ($attributes as $attribute)
                                <label class="flex items-center space-x-2">
                                    <input
                                        type="checkbox"
                                        name="attribute_value_ids[]"
                                        value="{{ $attribute->id }}"
                                        class="rounded border-gray-300 text-green-600 focus:ring-green-500"
                                        @if(in_array($attribute->id, $selectedAttributes)) checked @endif
                                    >
                                    <span class="text-sm text-gray-700">
                                        {{ $attribute->name }}
                                    </span>
                                </label>
                            @endforeach


                            <label class="block text-sm font-medium text-gray-700 mb-1"> Width </label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="width"
                                placeholder="Enter product Width"
                                value="{{$product_variant->width }}"
                            />

                            <label class="block text-sm font-medium text-gray-700 mb-1"> Height </label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                name="height"
                                placeholder="Enter product Height"
                                value="{{$product_variant->height }}"
                            />

                            <label class="block text-sm font-medium text-gray-700 mb-1"> Breadth </label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                placeholder="Enter product Sku"
                                name="breadth"
                                value="{{$product_variant->breadth }}"
                            />

                            <label class="block text-sm font-medium text-gray-700 mb-1"> Length </label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                placeholder="Enter product Sku"
                                name="length"
                                value="{{$product_variant->length }}"
                            />

                            <label class="block text-sm font-medium text-gray-700 mb-1"> Stock </label>
                            <input
                                type="text"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                placeholder="Enter product Stock"
                                name="stock"
                                value="{{$product_variant->length }}"
                            />

                            <input
                                type="hidden"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                placeholder="Enter product Availability"
                                name="availability"
                                value="{{$product_variant->availability }}"
                            />

                            <input
                                type="hidden"
                                class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                placeholder="Enter product Availability"
                                name="status"
                                value="{{$product_variant->status }}"
                            />

                            <input
                                type="submit"
                                value="Update Product Variant"
                                class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer"
                            />
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
