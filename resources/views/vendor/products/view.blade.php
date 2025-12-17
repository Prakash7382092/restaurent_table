@extends('layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">

        <div class="lg:col-span-4 col-span-1">
            <div class="card">               
                
                <div class="card-header">
                    <h6 class="card-title">Recent Products</h6>
                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="flex  min-h-screen bg-gray-50">
                        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
                             <div class="overflow-hidden">
                                <table class="min-w-full border border-gray-300 rounded-md overflow-hidden">
                                    <tbody class="divide-y divide-gray-200">
                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50 w-1/4">Id</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->id }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Name</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->name }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Short Description</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->short_description }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Description</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->description }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Type</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->type }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Slug</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->slug }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">SKU</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->sku }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Category ID</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->category_id }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Total Allowed Quantity</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $product->total_allowed_qty }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Featured Image</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">
                                                <img
                                                    src="{{ asset('products/' . $product->name . '/' . $product->featured_image) }}"
                                                    class="h-20 w-20 object-cover rounded border"
                                                >
                                            </td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Images</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">
                                                <div class="grid grid-cols-3 gap-3">
                                                    @php
                                                        $imagesArray = json_decode($product->images, true) ?? [];
                                                    @endphp

                                                    @forelse($imagesArray as $image)
                                                        <img
                                                            src="{{ asset('products/' . $product->name . '/' . $image) }}"
                                                            class="h-20 w-20 object-cover rounded border"
                                                        >
                                                    @empty
                                                        <span class="text-sm text-gray-500 col-span-3">
                                                            No images available
                                                        </span>
                                                    @endforelse
                                                </div>
                                            </td>
                                        </tr>

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>        
    </div>
@endsection