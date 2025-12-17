@extends('layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Vendor', 'title' => 'Dashboard'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">

        <div class="lg:col-span-4 col-span-1">
            <div class="card">
                <div class="card-header">
                    <button
                        type="button"  onclick="openModal()"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white
                            bg-green-600 rounded-md shadow
                            hover:bg-green-700 focus:outline-none focus:ring-2
                            focus:ring-green-500 focus:ring-offset-2
                            transition">
                        Add New Category
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
                                Add New Category
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
                                <form  id="productForm" action="{{ route('vendor.category_store') }}" method="POST"  enctype="multipart/form-data">            
                                    @csrf                                    
                                        <input type="hidden"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="vendor_id"
                                            placeholder="Enter product name" value="{{ Session::get('vendor_id') }}">


                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Parent ID
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="parent_id"
                                            placeholder="Enter Name" value="" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Category Name
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="category_name"
                                            placeholder="Enter Name" value="" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Category Slug
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="category_slug"
                                            placeholder="Enter Slug" value="" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Position
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="position"
                                            placeholder="Enter Position" value="" required>                          

                                        <input type="submit" value="Add Category" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
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
                            <div class="overflow-hidden">
                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-150">
                                        <tr class="text-sm font-normal text-default-700">
                                            <th class="px-3.5 py-3 text-start">Parent id </th>
                                            <th class="px-3.5 py-3 text-start">Name</th>                                            
                                            <th class="px-3.5 py-3 text-start">Slug</th>
                                            <th class="px-3.5 py-3 text-start">Position</th>
                                         
                                            <th class="px-3.5 py-3 text-start">Edit</th>
                                            <th class="px-3.5 py-3 text-start">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                    
                                      @foreach($categories as $category)
                                        <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                                <td class="px-3.5 py-3 text-primary">#{{ $category->parent_id  }}</td>
                                                <td class="px-3.5 py-3">{{ $category->name  }}</td>
                                                <td class="px-3.5 py-3">{{ $category->slug }}</td>
                                                    <td class="px-3.5 py-3">{{ $category->position }}</td>
                        
                                                    
                                                <td class="px-3.5 py-3">
                                                    <a href="{{ route('vendor.edit_category', $category->id) }}" class="text-blue-500 hover:text-blue-700">
                                                        <i class="size-4" data-lucide="edit"></i>
                                                    </a>
                                                </td>
                                                <td class="px-3.5 py-3">
                                                    <a href="{{ route('vendor.category_delete', $category->id) }}" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?');">
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


