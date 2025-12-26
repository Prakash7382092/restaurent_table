<!-- Start Sidebar -->
<aside class="app-menu" id="app-menu">
    <!-- Sidenav Menu Brand Logo -->
    <a class="logo-box sticky top-0 flex min-h-topbar-height items-center justify-start px-6 backdrop-blur-xs"
        href="{{ route('admin.dashboard') }}">
        <!-- Light Brand Logo -->
        <div class="logo-light">
            <img alt="Light logo" class="logo-lg h-6" src="/images/logo-light.png" />
            <img alt="Small logo" class="logo-sm h-6" src="/images/logo-sm.png" />
        </div>
        <!-- Dark Brand Logo -->
        <div class="logo-dark">
            <img alt="Dark logo" class="logo-lg h-6" src="/images/logo-dark.png" />
            <img alt="Small logo" class="logo-sm h-6" src="/images/logo-sm.png" />
        </div>
    </a>
    <!-- Sidenav Menu Toggle Button -->
    <div class="absolute top-0 end-5 flex h-topbar items-center justify">
        <button class="" id="button-hover-toggle">
            <i class="iconify tabler--circle size-5"></i>
        </button>
    </div>
    <!-- Sidenav Menu Item Link -->
    <div class="relative min-h-0 grow">
        <div class="size-full" data-simplebar="">
            <ul class="side-nav p-3 hs-accordion-group">
                <li class="menu-title">
                    <span>Main</span>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon"><i data-lucide="layout-dashboard"></i></span>
                        <span class="menu-text"> Dashboard </span>
                    </a>
                </li>
                <li class="menu-title">
                    <span>Store Management</span>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{route('admin.vendor')}}">
                        <span class="menu-icon"><i data-lucide="package"></i></span>
                        <div class="menu-text">Vendor Panel</div>
                    </a>
                </li>

                
                <li class="menu-item">
                    <a class="menu-link" href="{{route('admin.categories')}}">
                        <span class="menu-icon"><i data-lucide="shopping-cart"></i></span>
                        <div class="menu-text">Categories</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{route('admin.products_index')}}">
                        <span class="menu-icon"><i data-lucide="tags"></i></span>
                        <div class="menu-text">Products</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link" href="{{route('admin.attributes')}}">
                        <span class="menu-icon"><i data-lucide="layers"></i></span>
                        <div class="menu-text">Attribute</div>
                    </a>
                </li>

                <li class="menu-item">
                    <a class="menu-link" href="{{route('admin.attribute_values')}}">
                        <span class="menu-icon"><i data-lucide="layers"></i></span>
                        <div class="menu-text">Attribute values</div>
                    </a>
                </li>


                <li class="menu-item">
                    <a class="menu-link" href="{{route('admin.category_attributes')}}">
                        <span class="menu-icon"><i data-lucide="layers"></i></span>
                        <div class="menu-text"> Category Attribute </div>
                    </a>
                </li>
                


                <li class="menu-title">
                    <span>Analytics</span>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="#">
                        <span class="menu-icon"><i data-lucide="trending-up"></i></span>
                        <div class="menu-text">Sales Reports</div>
                    </a>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon"><i data-lucide="bar-chart-3"></i></span>
                        <div class="menu-text">Analytics</div>
                    </a>
                </li>
                <li class="menu-title">
                    <span>Settings</span>
                </li>
                <li class="menu-item">
                    <a class="menu-link" href="{{ route('admin.dashboard') }}">
                        <span class="menu-icon"><i data-lucide="store"></i></span>
                        <div class="menu-text">Store Settings</div>
                    </a>
                </li>
            </ul>
        </div>
    </div>
</aside>
<!-- End Sidebar -->
