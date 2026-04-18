<!DOCTYPE html>
<html lang="en">
@include('layouts.Admin.header')

<body class="sb-nav-fixed">
    <div id="layoutSidenav_content">
        @include('layouts.Admin.topbar')
        @include('layouts.Admin.nav')
        @yield('content')
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    @yield('page-script')
</body>

</html>
