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
                    <h6 class="card-title">Recent Vendor</h6>
                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="flex items-center justify-center bg-gray-50">
                        <div class="w-full max-w-lg bg-white p-6 rounded-lg shadow-lg">
                            <form  id="productForm" action="{{route('admin.user_update')}}" method="POST"  enctype="multipart/form-data">            
                                    @csrf                                    
                                    

                                             <input type="hidden" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="idi" placeholder="Enter product id" value="{{$vendors->id}}">
                                             


                                        <label class="block text-sm font-medium text-gray-700 mb-1"> Store Name</label>
                                        <input type="text" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="store_name" placeholder="Enter Store Name" value="{{$vendors->store_name}}" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1"> Store Description</label>
    

                                        <textarea name="description" rows="4" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" required placeholder="Enter Store Description">{{ $vendors->store_description }}</textarea>



                                        <label class="block text-sm font-medium text-gray-700 mb-1"> Store Location</label>
                                        <input type="text" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="store_location" placeholder="Enter Store Location" value="{{$vendors->store_location}}" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Position</label>
                                        <input type="text"  class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="store_position" placeholder="Enter Store  Position" value="{{$vendors->store_contact}}" required>     
                                            
                                            
                                         <label class="block text-sm font-medium text-gray-700 mb-1">Store Logo </label>
                                         @if($vendors->store_logo!='')
                                         <img src="{{ asset('vendors/'.$users->name.'/'.$vendors->store_logo) }}"  style="height:100px;width:100px"/>
                                         @endif
                                        <input type="file" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 border-2 border-[2px] p-2"  value="" name="store_logo">
                                        <input type="hidden" name="ostore_logo" value="{{$vendors->store_logo}}"/>

                                        @if($vendors->store_banner!='')
                                         <img src="{{ asset('vendors/'.$users->name.'/'.$vendors->store_banner) }}" style="height:100px;width:100px"/>
                                         <input type="hidden" name="ostore_banner" value="{{$vendors->store_banner}}"/>
                                         @endif

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Banner </label>                                        
                                        <input type="file" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 border-2 border-[2px] p-2" name="store_banner" value=""/>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Website </label>
                                        <input type="text" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="store_website" placeholder="Enter Store Website" value="{{$vendors->store_website}}"  required>                                         

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Commision Rate </label>
                                        <input type="text" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="commision_rate" placeholder="Enter Commision Rate"  value="{{$vendors->commission_rate}}" required>                              

                                        <input type="submit" value="Update Vendor" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
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
                store_name: {
                    required: true,
                    minlength: 1
                },
                description: {
                    required: true                   
                },
                store: {
                    required: true,                
                },
                position: {
                    required: true
                }, 
                store_website:{
                    required:true
                },
                
                commision_rate:{
                    required:true
                }               
            },

            messages: {
                parent_id: "Parent ID name is required",
                category_name: "Category name is required",
                category_slug: "Category name is required",
                position: "Category name id is requured",   
                store_website:"Store Website is required",
                store_logo:"Store Logo is Requried",
                store_banner:"Store Banner is Required",
                commision_rate:"Commmision Rate is Required"               
                
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