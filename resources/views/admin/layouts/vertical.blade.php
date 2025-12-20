<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>

<head>
    @include('admin.layouts.partials/title-meta')

    @include('admin.layouts.partials/head-css')
</head>

<body>
    <div class="wrapper">

        @include('admin.layouts.partials/sidenav')

        <div class="page-content">

            @include('admin.layouts.partials/topbar')

            <main>

                @yield('content')

            </main>

            @include('admin.layouts.partials/footer')
            
        </div>

    </div>

    @include('admin.layouts.partials/customizer')
</body>

</html>
