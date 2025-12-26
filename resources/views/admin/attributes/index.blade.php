@extends('admin.layouts.vertical', ['title' => 'Attributes'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Attributes'])  

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
                        Add New Attributes
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
                                Add New Attributes
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
                                <form  id="productForm" action="{{route('admin.attributes_store')}}" method="POST"  enctype="multipart/form-data">            
                                    @csrf                                                        
                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Name
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="name"
                                            placeholder="Enter Name" value="" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Code
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="code"
                                            placeholder="Enter Name" value="" required>                             

                                                                

                                        <input type="submit" value="Add Attribute" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
                                </form>                 

                            </div>

                        </div>

                        <!-- Modal Footer -->
                    

                    </div>
                </div>
                <!-- End Modal Backdrop -->


                
                <div class="card-header">
                    <h6 class="card-title">Recent Attributes</h6>
                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-x-auto bg-white rounded-lg shadow">
                                <table class="min-w-full border border-gray-200 rounded-lg overflow-hidden">
                                    <thead class="bg-gray-100 border-b">
                                        <tr class="text-sm font-semibold text-gray-700 uppercase tracking-wide">
                                            <th class="px-6 py-3 text-left">Name</th>
                                            <th class="px-6 py-3 text-left">Code</th>
                                            <th class="px-6 py-3 text-center">Edit</th>
                                            <th class="px-6 py-3 text-center">Delete</th>
                                        </tr>
                                    </thead>

                                    <tbody class="divide-y divide-gray-200 text-sm text-gray-700">
                                        @forelse($attributes as $attr)
                                            <tr class="hover:bg-gray-50 transition">
                                                <td class="px-6 py-3 font-medium">
                                                    {{ $attr->name }}
                                                </td>

                                                <td class="px-6 py-3">
                                                    <span class="px-2 py-1 bg-gray-100 rounded text-xs font-semibold">
                                                        {{ $attr->code }}
                                                    </span>
                                                </td>

                                                <td class="px-6 py-3 text-center">
                                                    <a href="{{ route('admin.edit_attributes', $attr->id) }}"
                                                    class="inline-flex items-center justify-center text-blue-600 hover:text-blue-800 transition">
                                                        <i class="size-4" data-lucide="edit"></i>
                                                    </a>
                                                </td>

                                                <td class="px-6 py-3 text-center">
                                                    <a href="{{ route('admin.delete_attributes', $attr->id) }}"
                                                    class="inline-flex items-center justify-center text-red-600 hover:text-red-800 transition"
                                                    onclick="return confirm('Are you sure you want to delete this attribute?');">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="4" class="px-6 py-4 text-center text-gray-500">
                                                    No attributes found
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
                name: {
                    required: true,
                    minlength: 1
                },
                code: {
                    required: true                   
                },
                              
            },

            messages: {
                name: "Name is required",
                code: "Code is required",
                          
                
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


