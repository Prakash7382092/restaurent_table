@extends('layouts.vertical', ['title' => 'Users Management'])

@section('css')
@endsection

@section('content')
    @include('layouts.partials/page-title', ['subtitle' => 'Admin', 'title' => 'Users Management'])

    <div class="card">
        <div class="card-header">
            <h6 class="card-title">Agents & Admins</h6>
            <button class="btn btn-sm bg-primary text-white" data-hs-overlay="#create-user-modal">
                <i class="size-4 me-1" data-lucide="plus"></i>Add User
            </button>
        </div>
        <div class="card-header">
            <div class="md:flex items-center md:space-y-0 space-y-4 gap-3">
                <div class="relative">
                    <input class="form-input form-input-sm ps-9" placeholder="Search for name, email" type="text"/>
                    <div class="absolute inset-y-0 start-0 flex items-center ps-3">
                        <i class="size-3.5 flex items-center text-default-500 fill-default-100" data-lucide="search"></i>
                    </div>
                </div>
                <select class="form-input form-input-sm">
                    <option selected="">All Roles</option>
                    <option>Admin</option>
                    <option>Agent</option>
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
                                    <th class="px-3.5 py-3 text-start">User ID</th>
                                    <th class="px-3.5 py-3 text-start">Name</th>
                                    <th class="px-3.5 py-3 text-start">Email</th>
                                    <th class="px-3.5 py-3 text-start">Role</th>
                                    <th class="px-3.5 py-3 text-start">Total Chats</th>
                                    <th class="px-3.5 py-3 text-start">Status</th>
                                    <th class="px-3.5 py-3 text-start">Joined Date</th>
                                    <th class="px-3.5 py-3 text-start">Action</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-default-200">
                                @forelse($users as $user)
                                <tr class="text-default-800 font-normal text-sm whitespace-nowrap">
                                    <td class="px-3.5 py-3 text-primary">#{{ $user->id }}</td>
                                    <td class="flex py-3 px-3.5 items-center gap-3">
                                        <div class="size-10 rounded-full bg-default-200 flex items-center justify-center font-semibold">
                                            {{ substr($user->name, 0, 2) }}
                                        </div>
                                        <div>
                                            <h6 class="mb-1 font-semibold">
                                                <a class="text-default-800" href="#">{{ $user->name }}</a>
                                            </h6>
                                            <p class="text-default-500 text-xs">{{ ucfirst($user->role) }}</p>
                                        </div>
                                    </td>
                                    <td class="py-3 px-3.5">{{ $user->email }}</td>
                                    <td class="py-3 px-3.5">
                                        @if($user->role === 'admin')
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-danger/10 text-danger rounded">
                                                <i class="size-3" data-lucide="shield"></i> Admin
                                            </span>
                                        @else
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-info/10 text-info rounded">
                                                <i class="size-3" data-lucide="user"></i> Agent
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3.5">{{ $user->assigned_chats_count }}</td>
                                    <td class="px-3.5 py-3">
                                        @if($user->is_online)
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-success/10 text-success rounded">
                                                <i class="size-3" data-lucide="check-circle-2"></i> Online
                                            </span>
                                        @else
                                            <span class="py-0.5 px-2.5 inline-flex items-center gap-x-1 text-xs font-medium bg-default-200 text-default-600 rounded">
                                                <i class="size-3" data-lucide="circle"></i> Offline
                                            </span>
                                        @endif
                                    </td>
                                    <td class="py-3 px-3.5">{{ $user->created_at->format('d M, Y') }}</td>
                                    <td class="px-3.5 py-3">
                                        <div class="hs-dropdown relative inline-flex">
                                            <button aria-expanded="false" aria-haspopup="menu" aria-label="Dropdown"
                                                class="hs-dropdown-toggle btn size-7.5 bg-default-200 hover:bg-default-600 text-default-500"
                                                hs-dropdown-placement="bottom-end" type="button">
                                                <i class="iconify lucide--ellipsis size-4"></i>
                                            </button>
                                            <div class="hs-dropdown-menu" role="menu">
                                                <a class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-default-500 hover:bg-default-150 rounded" href="#" data-hs-overlay="#edit-user-modal-{{ $user->id }}">
                                                    <i class="size-3" data-lucide="edit"></i> Edit
                                                </a>
                                                @if($user->id !== auth()->id())
                                                <form action="{{ route('admin.users.delete', $user) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="flex items-center gap-1.5 py-1.5 font-medium px-3 text-danger hover:bg-default-150 rounded w-full text-left"
                                                        onclick="return confirm('Are you sure you want to delete this user?')">
                                                        <i class="size-3" data-lucide="trash-2"></i> Delete
                                                    </button>
                                                </form>
                                                @endif
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                <div id="edit-user-modal-{{ $user->id }}" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
                                    <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
                                        <div class="bg-white border border-default-200 rounded-lg shadow-sm">
                                            <div class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                                                <h6 class="font-semibold text-base text-default-700">Edit User</h6>
                                                <button type="button" class="size-7 inline-flex justify-center items-center gap-2 rounded-full bg-default-100 hover:bg-default-200" data-hs-overlay="#edit-user-modal-{{ $user->id }}">
                                                    <i class="size-4" data-lucide="x"></i>
                                                </button>
                                            </div>
                                            <form action="{{ route('admin.users.update', $user) }}" method="POST" class="p-4">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium mb-2">Name</label>
                                                    <input type="text" name="name" value="{{ $user->name }}" required class="form-input" placeholder="Full name">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium mb-2">Email</label>
                                                    <input type="email" name="email" value="{{ $user->email }}" required class="form-input" placeholder="Email">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium mb-2">Password <span class="text-xs text-default-400">(leave blank to keep unchanged)</span></label>
                                                    <input type="password" name="password" class="form-input" placeholder="New password">
                                                </div>
                                                <div class="mb-4">
                                                    <label class="block text-sm font-medium mb-2">Role</label>
                                                    <select name="role" required class="form-select user-role-select" data-user-id="{{ $user->id }}">
                                                        <option value="agent" @if($user->role === 'agent') selected @endif>Agent</option>
                                                        <option value="admin" @if($user->role === 'admin') selected @endif>Admin</option>
                                                    </select>
                                                </div>
                                                <div class="mb-4 user-products-select" id="edit-user-products-select-{{ $user->id }}">
                                                    <label class="block text-sm font-medium mb-2">Assign Products</label>
                                                    <select name="product_ids[]" multiple class="form-select">
                                                        @foreach($allProducts as $product)
                                                            <option value="{{ $product->id }}" @if($user->allowedProducts->contains($product->id)) selected @endif>{{ $product->name }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                                <div class="flex justify-end gap-2">
                                                    <button type="button" class="btn bg-default-100 text-default-600" data-hs-overlay="#edit-user-modal-{{ $user->id }}">Cancel</button>
                                                    <button type="submit" class="btn bg-primary text-white">Update User</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @empty
                                <tr>
                                    <td colspan="8" class="px-3.5 py-8 text-center text-default-500">
                                        No users found
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-footer">
                <p class="text-default-500 text-sm">Showing <b>{{ $users->count() }}</b> of <b>{{ $users->total() }}</b> Results</p>
                {{ $users->links() }}
            </div>
        </div>
    </div>

    <!-- Create User Modal -->
    <div id="create-user-modal" class="hs-overlay hidden size-full fixed top-0 start-0 z-[80] overflow-x-hidden overflow-y-auto">
        <div class="hs-overlay-open:mt-7 hs-overlay-open:opacity-100 hs-overlay-open:duration-500 mt-0 opacity-0 ease-out transition-all sm:max-w-lg sm:w-full m-3 sm:mx-auto">
            <div class="bg-white border border-default-200 rounded-lg shadow-sm">
                <div class="flex justify-between items-center py-3 px-4 border-b border-default-200">
                    <h6 class="font-semibold text-base text-default-700">Create New User</h6>
                    <button type="button" class="size-7 inline-flex justify-center items-center gap-2 rounded-full bg-default-100 hover:bg-default-200" data-hs-overlay="#create-user-modal">
                        <i class="size-4" data-lucide="x"></i>
                    </button>
                </div>
                <form action="{{ route('admin.users.create') }}" method="POST" class="p-4">
                    @csrf
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Name</label>
                        <input type="text" name="name" required class="form-input" placeholder="Enter full name">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Email</label>
                        <input type="email" name="email" required class="form-input" placeholder="Enter email">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Password</label>
                        <input type="password" name="password" required class="form-input" placeholder="Enter password">
                    </div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium mb-2">Role</label>
                        <select name="role" required class="form-select" id="create-user-role-select">
                            <option value="agent">Agent</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <div class="mb-4" id="create-user-products-select">
                        <label class="block text-sm font-medium mb-2">Assign Products</label>
                        <select name="product_ids[]" multiple class="form-select">
                            @foreach($allProducts as $product)
                                <option value="{{ $product->id }}">{{ $product->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex justify-end gap-2">
                        <button type="button" class="btn bg-default-100 text-default-600" data-hs-overlay="#create-user-modal">Cancel</button>
                        <button type="submit" class="btn bg-primary text-white">Create User</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script>
    // No conditional display needed for product select
</script>
@endsection
