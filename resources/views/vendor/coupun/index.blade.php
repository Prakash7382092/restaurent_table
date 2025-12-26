
@extends('vendor.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('vendor.layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">

        <div class="lg:col-span-4 col-span-1">
            <div class="card">
                <div class="card-header">
                    <button
                        type="button"  onclick="openModal()"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white bg-green-600 rounded-md shadow hover:bg-green-700 focus:outline-none focus:ring-2 focus:ring-green-500 focus:ring-offset-2 transition">
                        Add New Coupun
                    </button>
                </div>

                <!-- Modal Backdrop -->
                <div id="productModal"
                    class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50  overflow-y-auto">

                    <!-- Modal Box -->
                    <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">

                        <!-- Modal Header -->
                        <div class="flex items-center justify-between px-5 py-4 border-b">
                            <h5 class="text-lg font-semibold">
                                Add New Product
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
                                <form id="couponForm" action="{{ route('vendor.coupons_store') }}" method="POST">
                                    @csrf

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Coupon Code</label>
                                    <input type="text" name="code"
                                        class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                        placeholder="Enter coupon code" required>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Title</label>
                                    <input type="text" name="title"
                                        class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                        placeholder="Enter coupon title" required>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Description</label>
                                    <textarea name="description" rows="3"
                                        class="w-full rounded-md border border-gray-300 px-3 py-2 text-sm focus:border-green-500 focus:ring-green-500 focus:outline-none"
                                        placeholder="Enter coupon description" required></textarea>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Discount Type</label>
                                    <select name="discount_type"
                                        class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required>
                                        <option value="">Select Discount Type</option>
                                        <option value="percentage">Percentage</option>
                                        <option value="fixed">Fixed Amount</option>
                                    </select>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Discount Value</label>
                                    <input type="number" name="discount_value"
                                        class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500"
                                        placeholder="Enter discount value" required min="0" step="0.01">

                                    <label class="block text-sm font-medium text-gray-700 mb-1">Start Date</label>
                                    <input type="date" name="start_date"
                                        class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required>

                                    <label class="block text-sm font-medium text-gray-700 mb-1">End Date</label>
                                    <input type="date" name="end_date"
                                        class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required>

                                    <input type="submit" value="Add Coupon"
                                        class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
                                </form>                

                            </div>

                        </div>

                        <!-- Modal Footer -->
                    

                    </div>
                </div>
                <!-- End Modal Backdrop -->


                
                <div class="card-header">
                    <h6 class="card-title">Recent Products</h6>
                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-x-auto rounded-xl border border-default-200 bg-white shadow-sm">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-100">
                                        <tr class="text-sm font-semibold text-default-700 uppercase tracking-wide">
                                            <th class="px-4 py-3 text-left">ID</th>
                                            <th class="px-4 py-3 text-left">Code</th>
                                            <th class="px-4 py-3 text-left">Title</th>
                                            <th class="px-4 py-3 text-left">Description</th>
                                            <th class="px-4 py-3 text-left">Discount Type</th>
                                            <th class="px-4 py-3 text-left">Discount</th>
                                            <th class="px-4 py-3 text-left">Start Date</th>
                                            <th class="px-4 py-3 text-left">End Date</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-default-100 text-sm text-default-700">
                                        @foreach($coupuns as $cupun)
                                        <tr class="hover:bg-default-50 transition duration-200">
                                            <td class="px-4 py-3 font-medium text-default-800">
                                                #{{ $cupun->id }}
                                            </td>

                                            <td class="px-4 py-3">
                                                <span class="rounded-md bg-blue-50 px-2 py-1 text-xs font-semibold text-blue-600">
                                                    {{ $cupun->code }}
                                                </span>
                                            </td>

                                            <td class="px-4 py-3 font-semibold text-default-800">
                                                {{ $cupun->title }}
                                            </td>

                                            <td class="px-4 py-3 text-default-600 line-clamp-2">
                                                {{ $cupun->description }}
                                            </td>

                                            <td class="px-4 py-3">
                                                @if($cupun->discount_type === 'percentage')
                                                    <span class="rounded-full bg-green-100 px-3 py-1 text-xs font-semibold text-green-700">
                                                        Percentage
                                                    </span>
                                                @else
                                                    <span class="rounded-full bg-purple-100 px-3 py-1 text-xs font-semibold text-purple-700">
                                                        Flat
                                                    </span>
                                                @endif
                                            </td>

                                            <td class="px-4 py-3 font-semibold text-default-800">
                                                @if($cupun->discount_type === 'percentage')
                                                    {{ $cupun->discount_value }}%
                                                @else
                                                    ₹{{ number_format($cupun->discount_value, 2) }}
                                                @endif
                                            </td>

                                            <td class="px-4 py-3 text-default-600">
                                                {{ \Carbon\Carbon::parse($cupun->start_date)->format('d M Y') }}
                                            </td>

                                            <td class="px-4 py-3 text-default-600">
                                                {{ \Carbon\Carbon::parse($cupun->end_date)->format('d M Y') }}
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
    $("#couponForm").validate({
        rules: {
            code: { required: true },
            title: { required: true },
            description: { required: true },
            discount_type: { required: true },
            discount_value: { required: true, number: true, min: 0 },
            start_date: { required: true, date: true },
            end_date: { required: true, date: true }
        },
        messages: {
            code: "Coupon code is required",
            title: "Title is required",
            description: "Description is required",
            discount_type: "Please select a discount type",
            discount_value: "Discount value is required and must be a number",
            start_date: "Start date is required",
            end_date: "End date is required"
        },
        errorElement: "span",
        errorClass: "text-red-500 text-sm block mt-1",
        errorPlacement: function (error, element) { error.insertAfter(element); },
        highlight: function (element) { $(element).addClass("border-red-500").removeClass("border-gray-300"); },
        unhighlight: function (element) { $(element).removeClass("border-red-500").addClass("border-gray-300"); },
        success: function (label) { label.remove(); }
    });
});
</script>

@endsection


