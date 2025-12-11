<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>

<head>
    @include('vendor.layouts.partials/title-meta')

    @include('vendor.layouts.partials/head-css')
</head>

<body>
    <div class="wrapper">

        @include('vendor.layouts.partials/sidenav')

        <div class="page-content">

            @include('vendor.layouts.partials/topbar')

            <main>

                @yield('content')

            </main>

            @include('vendor.layouts.partials/footer')
            
        </div>

    </div>

    @include('layouts.partials/customizer')
</body>

</html>
