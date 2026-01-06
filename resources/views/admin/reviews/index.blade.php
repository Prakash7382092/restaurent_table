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
                    <h6 class="card-title">Recent Reviews</h6>
                    
                    <a class="btn btn-sm border-0 text-primary/90 hover:text-primary" href="{{ route('vendor.dashboard') }}">
                        View All <i class="ms-1 size-4" data-lucide="move-right"></i>
                    </a>
                </div>
                <div class="flex flex-col">
                    <div class="overflow-x-auto">
                        <div class="min-w-full inline-block align-middle">
                            <div class="overflow-hidden">                

                                @section('content')
                                <h1 class="text-2xl font-bold mb-4">All Reviews</h1>

                                @if(session('success'))
                                    <div class="bg-green-100 p-2 mb-4 text-green-700">{{ session('success') }}</div>
                                @endif

                                <table class="min-w-full divide-y divide-default-200">
                                    <thead class="bg-default-150">
                                        <tr class="text-sm font-normal text-default-700">
                                            <th class="px-3.5 py-3 text-start">ID</th>
                                            <th class="px-3.5 py-3 text-start">Customer</th>
                                            <th class="px-3.5 py-3 text-start">Product</th>
                                            <th class="px-3.5 py-3 text-start">Rating</th>
                                            <th class="px-3.5 py-3 text-start">Comments</th>
                                            <th class="px-3.5 py-3 text-start">Images</th>
                                            <th class="px-3.5 py-3 text-start">Status</th>
                                            <th class="px-3.5 py-3 text-start">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                        @foreach($reviews as $review)
                                        <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                            <td class="px-4 py-2">{{ $review->id }}</td>
                                            <td class="px-4 py-2">{{ $review->customer->name }}</td>
                                            <td class="px-4 py-2">{{ $review->product->name }}</td>
                                            <td class="px-4 py-2">{{ $review->rating }}</td>
                                            <td class="px-4 py-2">{{ $review->comments }}</td>
                                            <td class="px-4 py-2">
                                                @if($review->images)
                                                    @foreach($review->images as $image)
                                                        <img src="{{ asset('reviews/'.$image) }}" alt="" width="50">
                                                    @endforeach
                                                @endif
                                            </td>
                                              <td>
                                                    @if($review->is_approved!='1')
                                                    <a href="{{route('admin.reviews.approve',$review->id)}}" class="px-3 py-1 text-sm font-medium text-white bg-green-600 rounded hover:bg-green-700">
                                                       Approve
                                                    </a>
                                                    @endif

                                                  
                                                     @if($review->is_approved!='0')
                                                      <a href="{{route('admin.reviews.reject',$review->id)}}" class="px-3 py-1 text-sm font-medium text-white bg-red-600 rounded hover:bg-green-700">
                                                       Reject
                                                    </a>
                                                    @endif                                                 
                                                </td>

                                                <td class="px-3.5 py-3">
                                                    <a href="{{ route('admin.reviews.destroy', $review->id) }}" class="text-red-500 hover:text-red-700" onclick="return confirm('Are you sure you want to delete this product?');">
                                                        <i class="size-4" data-lucide="trash-2"></i>
                                                    </a>
                                                </td>
                                        </tr>
                                        @endforeach
                                    </tbody>
                                </table>

                                <div class="mt-4">
                                    {{ $reviews->links() }}
                                </div>
                                @endsection




                            
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>        
    </div>
@endsection

@section('script')

    @section('scripts')

 

@endsection


