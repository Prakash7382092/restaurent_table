<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>
<head>
    @include('vendor.layouts.partials/title-meta')

    @include('vendor.layouts.partials/head-css')
</head>
<body>
    @yield('content')

    @include('vendor.layouts.partials/customizer')
</body>
</html>