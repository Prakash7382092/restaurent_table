@extends('admin.layouts.vertical', ['title' => 'Vendor Panel'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Vendor Panel'])  

    <div class="grid lg:grid-cols-4 grid-cols-4 gap-5 mb-5">

        <div class="lg:col-span-4 col-span-1">
            <div class="card">               
                
                <div class="card-header">
                    <h6 class="card-title">Vendor Panel</h6>                    
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
                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50 w-1/4">Id</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $users->id }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Name</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $users->name }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Email</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $users->email }}</td>
                                        </tr>                 
                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Store Name</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $vendors->store_name }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Store Location</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $vendors->store_location }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Store Contact</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{ $vendors->store_contact }}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Store Logo</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3"><img src="{{asset('vendors/'.$users->name.'/'.$vendors->store_logo)}}" style="height:90px;width:90px"/></td>
                                        </tr>


                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Store Banner</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3"><img src="{{asset('vendors/'.$users->name.'/'.$vendors->store_banner)}}" style="height:90px;width:90px"/></td>
                                        </tr>


                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Store Website</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$vendors->store_website}}</td>
                                        </tr>

                                        <tr>
                                            <th class="px-4 py-3 text-left font-medium bg-gray-50">Commision Rate</th>
                                            <td class="px-4 py-3">:</td>
                                            <td class="px-4 py-3">{{$vendors->commission_rate}}</td>
                                        </tr>

                                      

                                        

                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div> 
                    <!-- Products  End  -->              
            </div>

        </div>        
    </div>

    

@endsection