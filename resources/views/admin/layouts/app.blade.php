<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="{{ asset('admin/favicon.ico') }}">

    <title>{{ $header . ' - ' . config('app.name', 'DiaT e-commerce') }}</title>

    <!-- Custom fonts for this template-->
    <link href="{{ asset('admin/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">

    <!-- Custom styles for this template-->
    <link href="{{ asset('admin/css/sb-admin-2.min.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="{{ asset('admin/vendor/bootstrap-select/dist/css/bootstrap-select.min.css') }}">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
    @stack('styles')
</head>

<body id="page-top">

@include('sweetalert::alert')

<!-- Page Wrapper -->
<div id="wrapper">

    <!-- Sidebar -->
@include('admin.components.sidebar')
<!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

        <!-- Main Content -->
        <div id="content">

            <!-- Topbar -->
        @include('admin.components.navbar')
        <!-- End of Topbar -->

            <!-- Begin Page Content -->
            <div class="container-fluid">

                <!-- Page Heading -->
                <div class="d-sm-flex align-items-center justify-content-between mb-4">
                    <h1 class="h3 mb-0 text-gray-800">{{ $header }}</h1>

                    {{-- <a href="{{ route('store.home') }}" target="_blank"
                    class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm">
                    <i class="fas fa-fw fa-globe fa-sm text-white-50"></i> {{ __('Visit store') }}
                    </a> --}}
                </div>

                <main>
                    {{ $slot }}
                </main>
            </div>
            <!-- /.container-fluid -->

        </div>
        <!-- End of Main Content -->
    @include('admin.components.footer')
    <!-- Footer -->

        <!-- End of Footer -->

    </div>
    <!-- End of Content Wrapper -->

</div>
<!-- End of Page Wrapper -->

<!-- Scroll to Top Button-->
<a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
</a>

<!-- Logout Modal-->
<div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
     aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">{{ __('Ready to leave?') }}</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div
                class="modal-body">{{ __('Select "Logout" below if you are ready to end your current session.') }}</div>
            <div class="modal-footer">
                <button class="btn btn-secondary" type="button" data-dismiss="modal">{{ __('Cancel') }}</button>

                <!-- Authentication -->
                <form method="POST" action="{{ route('admin.logout') }}">
                    @csrf
                    <button class="btn btn-primary">{{ __('Logout') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/app.js') }}"></script>

<!-- Core plugin JavaScript-->
<script src="{{ asset('admin/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

<!-- Custom scripts for all pages-->
<script src="{{ asset('admin/js/sb-admin-2.min.js') }}"></script>

<!-- Scripts -->
<script src="{{ asset('vendor/datatables/buttons.server-side.js') }}"></script>
<script src="{{ asset('admin/vendor/bootstrap-select/dist/js/bootstrap-select.min.js') }}"></script>

@livewireScripts
@stack('scripts')

<script>
    $(document).ready(function () {

        if (localStorage.getItem('bool') === null) {
            localStorage.setItem('bool', 0);
        }

        if (localStorage.getItem('bool') == 1) {
            $('body').addClass('sidebar-toggled');
            $('#accordionSidebar').addClass('toggled');
        } else if (localStorage.getItem('bool') == 0) {
            $('body').removeClass('sidebar-toggled');
            $('#accordionSidebar').removeClass('toggled');
        }

        $('#sidebarToggle,#sidebarToggleTop').click(function (e) {
            if (localStorage.getItem('bool') == 0) {
                localStorage.setItem('bool', 1);
                $('body').addClass('sidebar-toggled');
                $('#accordionSidebar').addClass('toggled');
            } else if (localStorage.getItem('bool') == 1) {
                localStorage.setItem('bool', 0);
                $('body').removeClass('sidebar-toggled');
                $('#accordionSidebar').removeClass('toggled');
            }
        });
    });
</script>

</body>

</html>
