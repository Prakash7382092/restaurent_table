@extends('admin.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">

        <div class="lg:col-span-4 col-span-1">
            <div class="card">
                <div class="card-header">
                  
                </div>                
                <div class="card-header">
                    <h6 class="card-title">Recent Products</h6>
                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center justify-center min-h-screen bg-gray-50">
                        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
                            <form id="productForm" action="{{ route('admin.products_update') }}" method="POST" enctype="multipart/form-data">            
                                @csrf

                                 <input type="hidden" name="idi" value="{{$product_data->id}}">

                                <input type="hidden" name="vendor_id" value="{{ Session::get('vendor_id') }}">

                                <label class="block text-sm font-medium text-gray-700 mb-1">Product Name</label>
                                <input type="text" name="name" placeholder="Enter product name"
                                    class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 mb-3" value="{{ $product_data->name }}" required>

                                <label class="block text-sm font-medium text-gray-700 mb-1">Short Description</label>
                                <textarea name="short_description" id="short_description" rows="3"
                                        class="w-full rounded-md border-gray-300 px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500 mb-3"
                                        placeholder="Enter product short description" required>{{ $product_data->short_description }}</textarea>

                                <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                <textarea name="description" rows="3"
                                        class="w-full rounded-md border-gray-300 px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500 mb-3"
                                        placeholder="Enter product description" required>{{ $product_data->description }}</textarea>

                                <label class="block text-sm font-medium text-gray-700 mb-1">Product Type</label>
                                <input type="text" name="type" placeholder="Enter product type"
                                    class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 mb-3" value="{{ $product_data->type }}" required>

                                <label class="block text-sm font-medium text-gray-700 mb-1">Product Slug</label>
                                <input type="text" name="slug" placeholder="Enter product slug"
                                    class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 mb-3" value="{{ $product_data->slug }}" required />

                                <label class="block text-sm font-medium text-gray-700 mb-1">Product SKU</label>
                                <input type="text" name="sku" placeholder="Enter product SKU"
                                    class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 mb-3" value="{{ $product_data->sku }}" required />

                                <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                <select name="category_id" class="w-full rounded-md border-gray-300 mb-3">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>

                                <label class="block text-sm font-medium text-gray-700 mb-1">Total Allowed Quantity</label>
                                <input type="number" name="total_allowed_qty" placeholder="Enter Total Allowed Quantity"
                                    class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 mb-3" value="{{ $product_data->total_allowed_qty }}" required />

                                  <img src="{{ asset('products/' . $product_data->name . '/' . $product_data->featured_image) }}" alt="Featured Image" class="w-24 h-24 object-cover rounded-md mb-2">
                                    <label class="block text-sm font-medium text-gray-700 mb-1">Featured Image</label>
                                    <input type="hidden" name="ofeatured_image" value="{{ $product_data->featured_image }}"/>

                                <input type="file" name="featured_image"
                                    class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 mb-3">
                                    

                                <label class="block text-sm font-medium text-gray-700 mb-1">Images</label>

                                    <div class="grid grid-cols-3 gap-4">
                                        @php
                                            $imagesArray = json_decode($product_data->images, true);
                                            
                                        @endphp

                                        @foreach($imagesArray as $key => $image)
                                          
                                                 @if(!$loop->last)
                                                   <img src="{{ asset('products/' . $product_data->name . '/' . $image) }}" alt="Product Image {{ $key + 1 }}" class="w-24 h-24 object-cover rounded-md mb-2">
                                                 @endif
                                        @endforeach

                                      
                                    </div>
                                <input type="file" name="images[]" multiple 
                                    class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 mb-3">
                                    <input type="hidden" name="oimages" value="{{ $product_data->images }}"/>

                                <input type="submit" value="Update Product"
                                    class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>        
    </div>
@endsection