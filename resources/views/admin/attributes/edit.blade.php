@extends('admin.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Category'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">

        <div class="lg:col-span-4 col-span-1">
            <div class="card">
                <div class="card-header">
                  
                </div>  
                <div class="card-header">
                    <h6 class="card-title">Recent Categories </h6>                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center justify-center bg-gray-50">
                        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
                                <form  id="productForm" action="{{route('admin.attributes_update')}}" method="POST"  >            
                                    @csrf    
                                    
                                         <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="idi"
                                            placeholder="Enter Name" value="{{$attribute_edit->id}}" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Name
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="name"
                                            placeholder="Enter Name" value="{{$attribute_edit->name}}" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Code
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="code" value="{{$attribute_edit->code}}" placeholder="Enter Name" value="" required>                             

                                                                

                                        <input type="submit" value="Update Attribute" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
                                </form>  
                        </div>
                    </div>

                </div>
            </div>
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