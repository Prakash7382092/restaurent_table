@extends('layouts.vertical', ['title' => 'Products Management'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Products Management'])

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Products</h6>
            <button class="btn btn-sm bg-primary text-white" data-hs-overlay="#create-product-modal">
                <i class="size-4 me-1" data-lucide="plus"></i>Add Product
            </button>
        </div>
        <div class="card-header">
            <div class="md:flex items-center md:space-y-0 space-y-4 gap-3">
                <div class="relative">
                    <input class="form-input form-input-sm ps-9" placeholder="Search for name, slug" type="text"/>
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <i class="size-3.5 flex items-center text-default-500 fill-default-100" data-lucide="search"></i>
                    </div>
                </div>
                <select class="form-input form-input-sm">
                    <option selected="">All Status</option>
                    <option value="1">Active</option>
                    <option value="0">Inactive</option>
                </select>
            </div>
        </div>
        <div class="flex flex-col">
            <div class="overflow-x-auto">
                <div class="min-w-full inline-block align-middle">
                    <div class="overflow-hidden">
                        <table class="min-w-full divide-y divide-default-200">
                            <thead class="bg-default-150">
                                <tr class="text-sm font-normal text-default-700 whitespace-nowrap">
                                    <th class="px-3.5 py-3 text-start">ID</th>
                                    <th class="px-3.5 py-3 text-start">Name</th>
                                    <th class="px-3.5 py-3 text-start">Slug</th>
                                    <th class="px-3.5 py-3 text-start">API Key</th>
                                    <th class="px-3.5 py-3 text-start">Status</th>
                                    <th class="px-3.5 py-3 text-start">Created</th>
                                    <th class="px-3.5 py-3 text-start">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                @forelse($products as $product)
                                <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                    <td class="px-3.5 py-3 text-primary">#{{ $product->id }}</td>
                                    <td class="px-3.5 py-3">{{ $product->name }}</td>
                                    <td class="px-3.5 py-3">{{ $product->slug }}</td>
                                    <td class="px-3.5 py-3 text-xs">{{ $product->api_key }}</td>
                                    <td class="px-3.5 py-3">
                                        @if($product->is_active)
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
                                                <i class="size-3" data-lucide="check-circle-2"></i> Active
                                            </span>
                                        @else
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-default-200 text-default-600 rounded">
                                                <i class="size-3" data-lucide="circle"></i> Inactive
                                            </span>
                                        @endif
                                    </td>
                                    <td class="px-3.5 py-3">{{ $product->created_at->format('d M, Y') }}</td>
                                    <td class="px-3.5 py-3">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
                                                hs-dropdown-placement="bottom-end" type="button">
                                                <i class="iconify lucide--ellipsis size-4"></i>
                                            </button>
                                            <div class="hs-dropdown-menu" role="menu">
                                                <button class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded" data-hs-overlay="#edit-product-modal-{{ $product->id }}">
                                                    <i class="size-3" data-lucide="edit"></i> Edit
                                                </button>
                                                <form action="{{ route('admin.products.delete', $product) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-danger hover:bg-default-150 rounded w-full text-left"
                                                        onclick="return confirm('Are you sure you want to delete this product?')">
                                                        <i class="size-3" data-lucide="trash-2"></i> Delete
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                        <!-- Edit Modal -->
                                        <div id="edit-product-modal-{{ $product->id }}" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
                                            <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                                <div class="bg-white border border-default-200 rounded-lg shadow-sm">
                                                    <div class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                                                        <h6 class="font-semibold text-base text-default-700">Edit Product</h6>
                                                        <button type="button" class="size-7 inline-flex justify-center items-center gap-2 rounded-full bg-default-100 hover:bg-default-200" data-hs-overlay="#edit-product-modal-{{ $product->id }}">
                                                            <i class="size-4" data-lucide="x"></i>
                                                        </button>
                                                    </div>
                                                    <form action="{{ route('admin.products.update', $product) }}" method="POST" class="p-4">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-medium mb-2">Name</label>
                                                            <input type="text" name="name" value="{{ $product->name }}" required class="form-input" placeholder="Product name">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-medium mb-2">Slug</label>
                                                            <input type="text" name="slug" value="{{ $product->slug }}" required class="form-input" placeholder="Unique slug">
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-medium mb-2">Status</label>
                                                            <select name="is_active" class="form-select">
                                                                <option value="1" @if($product->is_active) selected @endif>Active</option>
                                                                <option value="0" @if(!$product->is_active) selected @endif>Inactive</option>
                                                            </select>
                                                        </div>
                                                        <div class="mb-4">
                                                            <label class="block text-sm font-medium mb-2">Settings (JSON)</label>
                                                            <textarea name="settings" class="form-input" rows="2">{{ json_encode($product->settings, JSON_PRETTY_PRINT) }}</textarea>
                                                        </div>
                                                        <div class="flex justify-end gap-2">
                                                            <button type="button" class="btn bg-default-100 text-default-600" data-hs-overlay="#edit-product-modal-{{ $product->id }}">Cancel</button>
                                                            <button type="submit" class="btn bg-primary text-white">Update Product</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="px-3.5 py-8 text-center text-default-500">
                                        No products found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-default-500 text-sm">Showing <b>{{ $products->count() }}</b> of <b>{{ $products->total() }}</b> Results</p>
                {{ $products->links() }}
            </div>
        </div>
    </div>

    <!-- Create Product Modal -->
    <div id="create-product-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="bg-white border border-default-200 rounded-lg shadow-sm">
                <div class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                    <h6 class="font-semibold text-base text-default-700">Create New Product</h6>
                    <button type="button" class="size-7 inline-flex justify-center items-center gap-2 rounded-full bg-default-100 hover:bg-default-200" data-hs-overlay="#create-product-modal">
                        <i class="size-4" data-lucide="x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.products.create') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" name="name" required class="form-input" placeholder="Product name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Slug</label>
                        <input type="text" name="slug" required class="form-input" placeholder="Unique slug">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Status</label>
                        <select name="is_active" class="form-select">
                            <option value="1">Active</option>
                            <option value="0">Inactive</option>
                        </select>
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Settings (JSON)</label>
                        <textarea name="settings" class="form-input" rows="2"></textarea>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" class="btn bg-default-100 text-default-600" data-hs-overlay="#create-product-modal">Cancel</button>
                        <button type="submit" class="btn bg-primary text-white">Create Product</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
@endsection
