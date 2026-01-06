@extends('admin.layouts.vertical', ['title' => 'Dashboard'])

@section('css')
@endsection

@section('content')
    @include('admin.layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Dashboard'])

    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-2 col-span-1">
            <div class="card-body relative overflow-hidden bg-zinc-900 rounded-md mb-5">
                <div class="relative z-10 grid grid-cols-12 items-center">
                    <div class="lg:col-span-8 col-span-12">
                        <h5 class="mb-3 text-lg text-white">Welcome {{ auth()->user()->name }} 🎉</h5>
                        <p class="mb-5 text-white/70 text-sm">Manage your store, products, and orders from your vendor dashboard. Track your sales and inventory in real-time.</p>
                        <a href="{{ route('vendor.dashboard') }}" class="btn bg-primary text-white">Manage Products</a>
                    </div>
                    <div class="col-span-4 ms-auto lg:block hidden">
                        <img alt="" class="h-40" src="/images/dashboard.png" />
                    </div>
                </div>
                <div class="absolute inset-0">
                    <svg class="size-full" preserveaspectratio="none" version="1.1" viewbox="0 0 1440 560"
                        xmlns="http://www.w3.org/2000/svg" xmlns:svgjs="http://svgjs.dev/svgjs"
                        xmlns:xlink="http://www.w3.org/1999/xlink">
                        <g fill="none" mask='url("#SvgjsMask1000")'>
                            <use x="0" xlink:href="#SvgjsSymbol1007" y="0"></use>
                            <use x="720" xlink:href="#SvgjsSymbol1007" y="0"></use>
                        </g>
                        <defs>
                            <mask id="SvgjsMask1000">
                                <rect fill="#ffffff" height="560" width="1440"></rect>
                            </mask>
                            <path d="M-1 0 a1 1 0 1 0 2 0 a1 1 0 1 0 -2 0z" id="SvgjsPath1003"></path>
                            <path d="M-3 0 a3 3 0 1 0 6 0 a3 3 0 1 0 -6 0z" id="SvgjsPath1004"></path>
                            <path d="M-5 0 a5 5 0 1 0 10 0 a5 5 0 1 0 -10 0z" id="SvgjsPath1001"></path>
                            <path d="M2 -2 L-2 2z" id="SvgjsPath1005"></path>
                            <path d="M6 -6 L-6 6z" id="SvgjsPath1002"></path>
                            <path d="M30 -30 L-30 30z" id="SvgjsPath1006"></path>
                        </defs>
                        <symbol id="SvgjsSymbol1007">
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1003" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1003" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="30" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1003" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1004" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1003" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="90" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1005" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1005" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="150" xlink:href="#SvgjsPath1006" y="330">
                            </use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1004" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="150" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="210" xlink:href="#SvgjsPath1006"
                                y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1005" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1001" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="210" xlink:href="#SvgjsPath1006"
                                y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="210" xlink:href="#SvgjsPath1003" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="270" xlink:href="#SvgjsPath1006"
                                y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="270" xlink:href="#SvgjsPath1005" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="330" xlink:href="#SvgjsPath1006"
                                y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="330" xlink:href="#SvgjsPath1006"
                                y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1001" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1003" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="330" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1004" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1005" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1003" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1002" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="390" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1004" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1002" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1002" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="450" xlink:href="#SvgjsPath1001" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1003" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1005" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1005" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1004" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="510" xlink:href="#SvgjsPath1006"
                                y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1001" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="510" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1005" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1002" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="570" xlink:href="#SvgjsPath1006"
                                y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1005" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="570" xlink:href="#SvgjsPath1002" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1002" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1005" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1001" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="630" xlink:href="#SvgjsPath1006"
                                y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1002" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="630" xlink:href="#SvgjsPath1006"
                                y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1001" y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="630" xlink:href="#SvgjsPath1005" y="570"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1001" y="30"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1005" y="90"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1002" y="150"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1002" y="210"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1005" y="270"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1001" y="330"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1003" y="390"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1003" y="450"></use>
                            <use stroke="rgba(32, 43, 61, 1)" stroke-width="3" x="690" xlink:href="#SvgjsPath1006"
                                y="510"></use>
                            <use stroke="rgba(32, 43, 61, 1)" x="690" xlink:href="#SvgjsPath1003" y="570"></use>
                        </symbol>
                    </svg>
                </div>
            </div>
            <div class="grid lg:grid-cols-4 md:grid-cols-2 grid-cols-1 gap-5">
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-primary/10">
                            <i class="size-6 text-primary" data-lucide="package"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">10</h5>
                        <p class="text-center text-sm text-default-500">Total Products</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-success/10">
                            <i class="size-6 text-success" data-lucide="check-circle"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">5</h5>
                        <p class="text-center text-sm text-default-500">Active Products</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-warning/10">
                            <i class="size-6 text-warning" data-lucide="clock"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">4</h5>
                        <p class="text-center text-sm text-default-500">Pending Approval</p>
                    </div>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="flex items-center justify-center mx-auto rounded-full size-14 bg-info/10">
                            <i class="size-6 text-info" data-lucide="shopping-cart"></i>
                        </div>
                        <h5 class="mt-4 text-center mb-2 text-default-800 font-semibold text-lg">3</h5>
                        <p class="text-center text-sm text-default-500">Total Orders</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Store Information</h6>
                </div>
                <div class="card-body">
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex items-center justify-center rounded-md size-12 bg-primary/10">
                            <i class="size-6 text-primary" data-lucide="store"></i>
                        </div>
                       
                    </div>
                    <div class="flex items-center gap-3 mb-4">
                        <div class="flex items-center justify-center rounded-md size-12 bg-success/10">
                            <i class="size-6 text-success" data-lucide="dollar-sign"></i>
                        </div>
                        <div class="text-sm">
                            <p class="mb-1 text-default-500">Total Revenue</p>
                            <h6 class="font-semibold text-default-800">100</h6>
                        </div>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="flex items-center justify-center rounded-md size-12 bg-info/10">
                            <i class="size-6 text-info" data-lucide="shopping-bag"></i>
                        </div>
                        <div class="text-sm">
                            <p class="mb-1 text-default-500">Pending Orders</p>
                            <h6 class="font-semibold text-default-800">34</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="grid lg:grid-cols-3 grid-cols-1 gap-5 mb-5">
        <div class="lg:col-span-2 col-span-1">
            <div class="card">
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
                                            <th class="px-3.5 py-3 text-start">Product Name</th>
                                            <th class="px-3.5 py-3 text-start">SKU</th>
                                            <th class="px-3.5 py-3 text-start">Type</th>
                                            <th class="px-3.5 py-3 text-start">Status</th>
                                            <th class="px-3.5 py-3 text-start">Created</th>
                                        </tr>
                                    </thead>
                                    <tbody class="divide-y divide-default-200">
                                       
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-span-1">
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title">Recent Orders</h6>
                </div>
                <div class="card-body">
                    <div class="flex flex-col gap-4">
                      
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
