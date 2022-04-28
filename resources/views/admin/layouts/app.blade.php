<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Asman shop</title>

    <!-- Google Font: Source Sans Pro -->
    <link rel="stylesheet"
          href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{ asset('assets/lib/fontawesome-free/css/all.min.css') }}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{ asset('assets/admin/css/adminlte.min.css') }}">
    <!-- Bootstrap select -->
    <link rel="stylesheet" href="{{ asset('assets/lib/bootstrap-select/dist/css/bootstrap-select.min.css') }}">
    <!-- Styles -->
{{--    <link rel="stylesheet" href="{{ asset('css/app.css') }}">--}}
{{--    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">--}}

    @stack('styles')

</head>
<body class="hold-transition sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">
    <!-- Navbar -->
@include('admin.components.navbar')
<!-- /.navbar -->

    <!-- Main Sidebar Container -->
@include('admin.components.sidebar')

<!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        @yield('content')
    </div>
    <!-- /.content-wrapper -->

    <footer class="main-footer">
        <div class="float-right d-none d-sm-block">
            <b>Version</b> 3.2.0
        </div>
        <strong>Copyright &copy; 2014-2021 <a href="https://adminlte.io">AdminLTE.io</a>.</strong> All rights reserved.
    </footer>

    <!-- Control Sidebar -->
    <aside class="control-sidebar control-sidebar-dark">
        <!-- Control sidebar content goes here -->
    </aside>
    <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- App js -->

{{--<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>--}}
{{--<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>--}}
{{--<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>--}}



<!-- jQuery -->
<script src="{{ asset('assets/lib/jquery/jquery.min.js') }}"></script>
{{--<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>--}}

<!-- Bootstrap 4 -->
<script src="{{ asset('assets/lib/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<!-- AdminLTE App -->
<script src="{{ asset('assets/admin/js/adminlte.min.js') }}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{ asset('assets/admin/js/demo.js') }}"></script>

<script src="{{ asset('assets/lib/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

@stack('scripts')

</body>
</html>
