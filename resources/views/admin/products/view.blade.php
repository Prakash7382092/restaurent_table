@extends('admin.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">
        <div class="lg:col-span-4 col-span-1">
            <div class="card">    
                
                <div class="card-header">
                    <h6 class="card-title">Recent Products</h6>                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                   <!-- Products  Start  -->
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
                    <!-- Products  End  -->              
            </div>

            
                <!--  Products  Variant Start --> 
            <div class="lg:col-span-4 col-span-1 mt-10">
                <div class="card">  
                    <div class="card-header">
                        <h6 class="card-title"> Product Variant </h6>
                        
                                           
                        <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('admin.dashboard') }}">
                            View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                        </a>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex  min-h-screen bg-gray-50">
                            <div class="w-full bg-white p-6 rounded-lg shadow-lg">
                                <div class="overflow-hidden">
                                      <button type="button"  onclick="openModal()" class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                                        Add Product Variant
                                    </button>

                                    <!-- Modal Backdrop -->
                                        <div id="productModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50  overflow-y-auto">

                                            <!-- Modal Box -->
                                            <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">

                                                <!-- Modal Header -->
                                                <div class="flex items-center justify-between px-5 py-4 border-b">
                                                    <h5 class="text-lg font-semibold">
                                                        Add  Product Variant
                                                    </h5>

                                                    <!-- Close Button -->
                                                    <button onclick="closeModal()"
                                                            class="text-gray-400 hover:text-gray-600 text-xl">
                                                        &times;
                                                    </button>
                                                </div>

                                                <!-- Modal Body -->
                                                <div class="px-6 py-4 max-h-[70vh] overflow-y-auto">
                                                    <!-- Example Input -->
                                                    <div>
                                                        <form  id="productForm" action="{{ route('admin.product_variant_store') }}" method="POST"  enctype="multipart/form-data">            
                                                            @csrf                                    
                                                                <input type="hidden"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="vendor_id"
                                                                    placeholder="Enter product name" value="{{ Session::get('vendor_id') }}">


                                                                <input type="hidden"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="product_id"
                                                                    placeholder="Enter product name" value="{{ $product->id }}">


                                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                                    Variant Name
                                                                </label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="variant_name"
                                                                    placeholder="Enter product variant name" value="" required>

                                                                <label class="block text-sm font-medium text-gray-700 mb-1"> Base Price</label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="base_price"
                                                                    placeholder="Enter product Base Price" value="" required>



                                                                <label class="block text-sm font-medium text-gray-700 mb-1"> Original Price</label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="original_price"
                                                                    placeholder="Enter product Original Price" value="" required>


                                                                <label class="block text-sm font-medium text-gray-700 mb-1"> Attrribute Value ids</label>
                                                                <input type="number"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="attribute_value_ids"
                                                                    placeholder="Enter Attrribute Value ids" value="" required>


                                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                                    Width
                                                                </label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="width"
                                                                    placeholder="Enter product Width" value="">

                                                                
                                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                                    Height
                                                                </label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500" name="height"
                                                                    placeholder="Enter product Height" value="">

                                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                                Breadth
                                                                </label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500"
                                                                    placeholder="Enter product Sku" name="breadth" value="">


                                                                
                                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                                Length
                                                                </label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500"
                                                                    placeholder="Enter product Sku" name="length" value="">


                                                                <label class="block text-sm font-medium text-gray-700 mb-1">
                                                                Stock
                                                                </label>
                                                                <input type="text"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500"
                                                                    placeholder="Enter product Stock" name="stock" value="">


                                                                
                                                                <input type="hidden"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500"
                                                                    placeholder="Enter product Availability" name="availability" value="1">

                                                                
                                                                <input type="hidden"
                                                                    class="w-full rounded-md border-gray-300
                                                                            focus:border-green-500 focus:ring-green-500"
                                                                    placeholder="Enter product Availability" name="status" value="1">


                                                                <input type="submit" value="Add Product" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
                                                        </form>                 

                                                    </div>

                                                </div>
                                                <!-- Modal Footer -->
                                            

                                            </div>
                                        </div>
                                    <!-- End Modal Backdrop -->
                                     

                                <table class="min-w-full divide-y divide-default-200 mt-5">
                                    <thead class="bg-default-150">
                                        <tr class="text-sm font-normal text-default-700">
                                            <th class="px-3.5 py-3 text-start">Variant Name</th>
                                            <th class="px-3.5 py-3 text-start">Base Price</th>
                                            <th class="px-3.5 py-3 text-start">Original Price</th>
                                            <th class="px-3.5 py-3 text-start">Attribute Value ids</th>
                                            <th class="px-3.5 py-3 text-start">Width</th>
                                            <th class="px-3.5 py-3 text-start">Height</th>
                                            <th class="px-3.5 py-3 text-start">Breadth</th>
                                             <th class="px-3.5 py-3 text-start">Length</th>
                                                <th class="px-3.5 py-3 text-start">Stock</th>
                                                
                                            
                                            <th class="px-3.5 py-3 text-start">Edit</th>
                                            <th class="px-3.5 py-3 text-start">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">                                    
                                    @foreach($product_variant as $product)
                                        <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                                <td class="px-3.5 py-3 text-primary">{{ $product->variant_name }}</td>
                                                <td class="px-3.5 py-3">{{ $product->base_price }}</td>
                                                <td class="px-3.5 py-3">{{ $product->original_price }}</td>
                                                    <td class="px-3.5 py-3">{{ $product->attribute_value_ids }}</td>
                                                    <td class="px-3.5 py-3">{{ $product->width }}</td>
                                                    <td class="px-3.5 py-3">{{ $product->height }}</td>
                                                    <td class="px-3.5 py-3">{{ $product->breadth }}</td>
                                                    <td class="px-3.5 py-3">{{ $product->length }}</td>
                                                    <td class="px-3.5 py-3">{{ $product->stock }}</td>
                                            
                                        
                                                    
                                                <td class="px-3.5 py-3">
                                                    <a href="{{route('admin.product_variant_edit', $product->id)}}" class="text-blue-500 hover:text-blue-700">
                                                        <i class="size-4" data-lucide="edit"></i>
                                                    </a>
                                                </td>
                                                <td class="px-3.5 py-3">
                                                    <a href="{{route('admin.product_variant_delete', $product->id)}}" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?');">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </td>

                                        </tr>
                                    @endforeach                                        
                                    </tbody>
                                </table>

                                    

                                      

                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
                <!--  Products  Variant End --> 
        </div>        
    </div>

    
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="{{ asset('vendor/js/script.js')}}"></script>
<script>
    $(document).ready(function () {
        $("#productForm").validate({

            ignore: [],

            rules: {
                variant_name: {
                    required: true,
                    minlength: 3
                },
                

                base_price: {
                    required: true                   
                },


                original_price: {
                    required: true,                
                },

                attribute_value_ids: {
                    required: true
                },

                width: {
                    required: true
                },

                height: {
                    required: true
                },

                breadth: {
                    required: true
                },

                length: {
                    required: true
                },

                stock: {
                    required: true,
                    number: true
                }

               

                
            },

            messages: {
                variant_name: "Variant name is required",
                base_price: "Base Price is required",
                original_price: "Orginal Price is required",
                attribute_value_ids: "Attribute value id is requured",
                width: "Product widht is required",
                height: "Product height is required",
                breadth: "Product Breadth is required",
                length: "Product Length is required",
                stock: "Total Stock quantity is required"
                
            },

            errorElement: "span",
            errorClass: "text-red-500 text-sm block mt-1",

            errorPlacement: function (error, element) {
                error.insertAfter(element);
            },

            highlight: function (element) {
                $(element)
                    .addClass("border-red-500")
                    .removeClass("border-gray-300");
            },

            unhighlight: function (element) {
                $(element)
                    .removeClass("border-red-500")
                    .addClass("border-gray-300");
            },

            success: function (label) {
                label.remove(); // 🔥 removes error text when valid
            }
        });

    });

 
</script>
@endsection