@extends('admin.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Category'])  

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
                        Add Category Attributes
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
                                Add Category Attributes
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
                                    <form id="attributeForm" action="{{ route('admin.category_attributes.store') }}" method="POST">
                                            @csrf

                                            <label class="block text-sm font-medium text-gray-700 mb-1">Category</label>
                                            <select name="category_id" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required>
                                                <option value="">Select Category</option>
                                                @foreach($categories as $cat)
                                                    <option value="{{ $cat->id }}">{{ $cat->name }}</option>
                                                @endforeach
                                            </select>

                                            <label class="block text-sm font-medium text-gray-700 mb-1 mt-2">Attribute</label>
                                            <select name="attribute_id" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required>
                                                <option value="">Select Attribute</option>
                                                @foreach($attributes as $attr)
                                                    <option value="{{ $attr->id }}">{{ $attr->name }}</option>
                                                @endforeach
                                            </select>

                                            <input type="submit" value="Assign Attribute" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 cursor-pointer">
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
                                            <th class="px-3.5 py-3 text-start">Id</th>
                                            <th class="px-3.5 py-3 text-start">Category ID</th>
                                            <th class="px-3.5 py-3 text-start">Attribute ID</th>
                                           
                                            <th class="px-3.5 py-3 text-start">Edit</th>
                                            <th class="px-3.5 py-3 text-start">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                        @foreach($CategoryAttribute as $cat)
                                            <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                                <td class="px-3.5 py-3 text-primary">#{{ $cat->id }}</td>
                                                <td class="px-3.5 py-3">{{ $cat->category_id }}</td>
                                                <td class="px-3.5 py-3">{{ $cat->attribute_id }}</td>
                                               
                                                <td class="px-3.5 py-3">
                                                    <a href="{{ route('admin.category_attributes.edit', $cat->id) }}" class="text-blue-500 hover:text-blue-700">
                                                        <i class="size-4" data-lucide="edit"></i>
                                                    </a>
                                                </td>
                                                <td class="px-3.5 py-3">
                                                    <a href="{{ route('admin.category_attributes.delete', $cat->id) }}" class="text-blue-500 hover:text-blue-700">
                                                        <i class="size-4" data-lucide="trash"></i>
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


