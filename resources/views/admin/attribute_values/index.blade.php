@extends('admin.layouts.vertical', ['title' => 'Attribute Values'])

@section('css')
@endsection

@section('content')
@include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Attribute Values'])

<div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">
    <div class="lg:col-span-4 col-span-1">
        <div class="card">

            {{-- Add Button --}}
            <div class="card-header">
                <button onclick="openModal()"
                        class="inline-flex items-center px-4 py-2 text-sm font-medium text-white
                        bg-green-600 rounded-md shadow hover:bg-green-700 transition">
                    Add Attribute Value
                </button>
            </div>

            {{-- Modal --}}
            <div id="productModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
                <div class="bg-white rounded-lg shadow-lg w-full max-w-lg mx-4">

                    <div class="flex justify-between items-center px-5 py-4 border-b">
                        <h5 class="text-lg font-semibold">Add Attribute Value</h5>
                        <button onclick="closeModal()" class="text-xl">&times;</button>
                    </div>

                    <div class="px-6 py-4">

                        <form id="productForm" method="POST" action="{{ route('admin.attribute_values_store') }}">
                            @csrf

                            <label class="block text-sm font-medium mb-1">Attribute</label>
                            <select name="attribute_id" class="w-full rounded-md border-gray-300" required>
                                <option value="">Select Attribute</option>
                                @foreach($attributes as $attribute)
                                    <option value="{{ $attribute->id }}">{{ $attribute->name }}</option>
                                @endforeach
                            </select>

                            <label class="block text-sm font-medium mt-3 mb-1">Value</label>
                            <input type="text" name="value" class="w-full rounded-md border-gray-300" required>

                            <label class="block text-sm font-medium mt-3 mb-1">Numeric Value</label>
                            <input type="number" step="0.01" name="numeric_value" class="w-full rounded-md border-gray-300">

                            <input type="submit" value="Save"
                                   class="w-full mt-4 bg-green-600 text-white py-2 rounded-md hover:bg-green-700">
                        </form>
                    </div>
                </div>
            </div>

         
            <div class="card-header">
                <h6 class="card-title">Attribute Values List</h6>
            </div>

            <div class="overflow-x-auto">
                <table class="min-w-full border">
                    <thead class="bg-gray-100">
                        <tr class="text-sm uppercase">
                            <th class="px-4 py-2 text-left">Attribute</th>
                            <th class="px-4 py-2 text-left">Value</th>
                            <th class="px-4 py-2 text-left">Numeric</th>
                            <th class="px-4 py-2 text-center">Edit</th>
                            <th class="px-4 py-2 text-center">Delete</th>
                        </tr>
                    </thead>

                    <tbody class="divide-y">
                        @foreach($attributeValues as $row)
                        <tr class="hover:bg-gray-50">
                            <td class="px-4 py-2">{{ $row->attribute->name }}</td>
                            <td class="px-4 py-2">{{ $row->value }}</td>
                            <td class="px-4 py-2">{{ $row->numeric_value ?? '-' }}</td>

                            <td class="text-center">
                                <a href="{{ route('admin.attribute_values_edit',$row->id) }}"
                                   class="text-blue-600">
                                    <i data-lucide="edit"></i>
                                </a>
                            </td>

                            <td class="text-center">
                                <a href="{{ route('admin.attribute_values_delete',$row->id) }}"
                                   onclick="return confirm('Delete this value?')"
                                   class="text-red-600">
                                    <i data-lucide="trash-2"></i>
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
@endsection

    @section('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/jquery-validation@1.19.5/dist/jquery.validate.min.js"></script>
<script src="{{ asset('vendor/js/script.js')}}"></script>
    <script>
    $(document).ready(function () {
        $("#productForm").validate({

            ignore: [],

            rules: {
                attribute_id: {
                    required: true,
                    minlength: 1
                },
               
                value: {
                    required: true,
                  
                },
                numeric_value: {
                    required: true                   
                },
                              
            },

            messages: {
                attribute_id: "Attribute ID is required",
                value: "Value is required",
                numeric_value: "Numeric Value is Required"                       
                
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
