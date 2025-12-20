@extends('admin.layouts.vertical', ['title' => 'Vendor Panel'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Vendor Panel'])  

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
                        Add New Vendor
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
                                Add New Vendor
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
                                <form  id="productForm" action="{{ route('admin.vendor_store') }}" method="POST"  enctype="multipart/form-data">            
                                       @csrf                                    
                                        <input type="hidden"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="admin_id"
                                            placeholder="Enter vendor id" value="{{ auth()->user()->name }}"/>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Vendor Name
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="vendor_name"
                                            placeholder="Enter Vendor name" value="" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Vendor Email
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="vendor_email"
                                            placeholder="Enter Vendor Email" value="" required>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Vendor Password
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="vendor_password"
                                            placeholder="Enter Vendor Password" value="" required>    
                                            
                                            
                                            <label class="block text-sm font-medium text-gray-700 mb-1">
                                            Store Name
                                        </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="store_name"
                                            placeholder="Enter Store Name" value="" required> 

                                         <label class="block text-sm font-medium text-gray-700 mb-1">Store Contact </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="store_contact"
                                            placeholder="Enter Store Contact" value="" required> 

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Location </label>
                                        <input type="text"
                                            class="w-full rounded-md border-gray-300
                                                    focus:border-green-500 focus:ring-green-500" name="store_location"
                                            placeholder="Enter Store Location" value="" required> 


                                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Logo </label>
                                        <input type="file" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 border-2 border-[2px] p-2"  value="" name="store_logo">

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Banner </label>                                        
                                        <input type="file" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500 border-2 border-[2px] p-2" name="store_banner" value=""/>

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Store Website </label>
                                        <input type="text" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="store_website" placeholder="Enter Store Website"  required>                                         

                                        <label class="block text-sm font-medium text-gray-700 mb-1">Commision Rate </label>
                                        <input type="text" class="w-full rounded-md border-gray-300 focus:border-green-500 focus:ring-green-500" name="commision_rate" placeholder="Enter Commision Rate"  required> 
                                            
                                        
                                        
                                        <input type="submit" value="Add New Vendor" class="w-full mt-4 px-4 py-2 bg-green-600 text-white text-center font-semibold rounded-md hover:bg-green-700 transition cursor-pointer">
                                </form>     
                            </div>
                        </div>
                           <!-- Modal Footer -->
                    </div>
                </div>
                <!-- End Modal Backdrop -->


                
                <div class="card-header">
                    <h6 class="card-title">Recent Vendors</h6>
                    
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
                                            <th class="px-3.5 py-3 text-start"> Name</th>
                                            <th class="px-3.5 py-3 text-start">Email</th>
                                            <th class="px-3.5 py-3 text-start">Role</th>
                                            <th class="px-3.5 py-3 text-start">Approval </th>                                   
                                             <th class="px-3.5 py-3 text-start">View</th>     
                                             <th class="px-3.5 py-3 text-start">EDit</th>                                         
                                            <th class="px-3.5 py-3 text-start">Delete</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                        @foreach($users as $use)
                                        <tr>
                                            <td class="px-3.5 py-3 text-start">{{$use->name}}</td>
                                            <td class="px-3.5 py-3 text-start">{{$use->email}}</td>
                                            <td class="px-3.5 py-3 text-start">{{$use->role}}</td>      

                                            <td>
                                                    @if($use->status=='pending_approval')
                                                    <a href="{{route('admin.users_approve',$use->id)}}" class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                                                       Approve
                                                    </a>
                                                  
                                                    @elseif($use->status=='active')
                                                      <a href="{{route('admin.users_reject',$use->id)}}" class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded hover:bg-green-700">
                                                       Reject
                                                    </a>
                                                    @endif                                                 
                                            </td>


                                            


                                           
                                                
                                                <td><a href="{{route('admin.users_view',$use->id)}}" class="text-green-500 hover:text-green-700">
                                                        <i class="size-4" data-lucide="eye"></i>
                                                    </a>
                                                </td>


                                                <td><a href="{{route('admin.users_edit',$use->id)}}" class="text-green-500 hover:text-green-700">
                                                        <i class="size-4" data-lucide="edit"></i>
                                                    </a>
                                                </td>

                                                    
                                              
                                                <td class="px-3.5 py-3">
                                                    <a href="{{route('admin.users_delete',$use->id)}}" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?');">
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
                venodr_name: {
                    required: true,
                    minlength: 3
                },
                

                venodr_email: {
                    required: true                   
                },

                venodr_password: {
                    required: true,                
                },
                store_name:{
                    required: true,  
                },
                store_contact:{
                    required: true,  
                },
                store_location:{
                    required:true,
                },
                description:{
                     required:true
                },
                store_logo: {
                    required: true
                },
                store_banner:{
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
                venodr_name: "Vendor name is required",
                venodr_email: "Vendor Email is required",
                venodr_password: "Vendor Password is required",
                store_name:"Store Name is Required",
                store_contact:"Store Contact is Required",
                store_location:"Store Location is Required",
                description:"Description is Required",
                store_logo:"Store Logo is required",
                store_banner:"Store Banner is Required",
                store_website:"Store Website is Required",
                commision_rate:"Commision Rate is Required"            
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


