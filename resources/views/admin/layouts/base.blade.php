<!DOCTYPE html>
<html lang="en" @yield('html_attribute')>
<head>
    @include('admin.layouts.partials/title-meta')

    @include('admin.layouts.partials/head-css')
</head>
<body>
    @yield('content')

    @include('admin.layouts.partials/customizer')
</body>
</html>