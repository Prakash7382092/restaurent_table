@extends('vendor.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('vendor.layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">

        <div class="lg:col-span-4 col-span-1">
            <div class="card">
                <div class="card-header">
                
                </div>



                
                <div class="card-header">
                    <h6 class="card-title">Recent Orders</h6>
                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-150">
                                        <tr class="text-sm font-normal text-default-700">
                                            <th class="px-3.5 py-3 text-start">User id </th>
                                            <th class="px-3.5 py-3 text-start">Total Amount</th>                                            
                                            <th class="px-3.5 py-3 text-start">Delivery Charge</th>
                                            <th class="px-3.5 py-3 text-start">discount_amount</th>
                                            <th class="px-3.5 py-3 text-start">View</th>
                                           
                                            <th class="px-3.5 py-3 text-start">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                    
                                      @foreach($orders as $order)
                                        <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                                <td class="px-3.5 py-3 text-primary">#{{ $order->user_id  }}</td>
                                                <td class="px-3.5 py-3">{{ $order->total_amount  }}</td>
                                                <td class="px-3.5 py-3">{{ $order->delivery_charges }}</td>
                                                    <td class="px-3.5 py-3">{{ $order->discount_amount }}</td>

                                                
                        
                                                    
                                                <td class="px-3.5 py-3">
                                                      <a href="{{ route('vendor.orders_show', $order->id) }}" class="text-green-500 hover:text-green-700" title="View Order">
                                                            <i class="size-4" data-lucide="eye"></i>
                                                        </a>
                                                </td>

                                                <td class="px-3.5 py-3">
                                                    <a href="{{ route('vendor.category_delete', $order->id) }}" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?');">
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
    </div>
@endsection

@section('script')
    <script>
        // Function to open the modal
        function openModal() {
            document.getElementById('productModal').classList.remove('hidden');
            document.getElementById('productModal').classList.add('flex');
        }

        // Function to close the modal
        function closeModal() {
            document.getElementById('productModal').classList.remove('flex');
            document.getElementById('productModal').classList.add('hidden');
        }
    </script>   

    @section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="{{ asset('vendor/js/script.js')}}"></script>
    <script>
    $(document).ready(function () {
        $("#productForm").validate({

            ignore: [],

            rules: {
                parent_id: {
                    required: true,
                    minlength: 1
                },
                category_name: {
                    required: true                   
                },
                category_slug: {
                    required: true,                
                },
                position: {
                    required: true
                },                
            },

            messages: {
                parent_id: "Parent ID name is required",
                category_name: "Category name is required",
                category_slug: "Category name is required",
                position: "Category name id is requured",              
                
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


