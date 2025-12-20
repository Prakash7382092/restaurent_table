@extends('vendor.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('vendor.layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])  

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
                                        @php
                                            $userName = \App\Models\User::find($orders->user_id)?->name;
                                        @endphp
                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50 w-1/4">User id </th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $userName }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Total Amount</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->total_amount}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Delivery Charges</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->delivery_charges}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Discount Amount</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->discount_amount}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Total Payable</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->total_payable}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Status</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->status}}</td>
                                        </tr>

                                        

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Shipping Tracking Code</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->shipping_tracking_code}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Payment Method</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->payment_method}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Order Currency</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$orders->order_currency}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Transaction ID</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3"> {{$orders->transaction_id }}</td>
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
                        <h6 class="card-title"> Product Items </h6>
                        
                                           
                        <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                            View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                        </a>
                    </div>
                    <div class="flex flex-col">
                        <div class="flex  min-h-screen bg-gray-50">
                            <div class="w-full bg-white p-6 rounded-lg shadow-lg">
                                <div class="overflow-hidden">
                                     @php
                                            $userName = \App\Models\User::find($orders->user_id)?->name;
                                        @endphp
                                <table class="min-w-full divide-y divide-default-200 mt-5">
                                    <thead class="bg-default-150">
                                        <tr class="text-sm font-normal text-default-700">
                                            <th class="px-3.5 py-3 text-start">Username</th>
                                            <th class="px-3.5 py-3 text-start">Product Variant Id </th>
                                            <th class="px-3.5 py-3 text-start">Quantity</th>
                                            <th class="px-3.5 py-3 text-start">Unit Price</th>
                                            <th class="px-3.5 py-3 text-start">Discount Price</th>      

                                    
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">

                                        @forelse($order_item as $item)
                                            <tr>
                                                <td class="px-3.5 py-3">{{$userName}}</td>
                                                <td class="px-3.5 py-3">{{ $item->product_variant_id }}</td>
                                                <td class="px-3.5 py-3">{{ $item->quantity }}</td>
                                                <td class="px-3.5 py-3">{{ number_format($item->unit_price, 2) }}</td>
                                                <td class="px-3.5 py-3">{{ number_format($item->discounted_price, 2) }}</td>

                                              
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="7" class="px-3.5 py-3 text-center text-gray-500">
                                                    No order items found
                                                </td>
                                            </tr>
                                        @endforelse

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