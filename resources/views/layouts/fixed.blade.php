<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free-5.6.3-web/css/all.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    @yield('plugin-css')
    <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
    <link rel="shortcut icon" href="{{ asset('favicon.ico') }}">
    @yield('style')

    <style>
        .custom-alert {
            position: fixed;
            top: 10px;
            right: 10px;
            min-width: 300px;
            max-width: 90%;
            z-index: 9999;
            border-radius: 2px
        }

    </style>
</head>

<body class="hold-transition sidebar-mini">
    <div class="wrapper">
        <!-- Navbar -->
        <nav class="main-header navbar navbar-expand bg-white navbar-light border-bottom">
            @include('layouts.includes.header')
        </nav>
        <!-- /.navbar -->

        <!-- Main Sidebar Container -->
        <aside class="main-sidebar elevation-1 sidebar-light-info">
            @include('layouts.includes.left-sidebar')
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            @yield('content')
        </div>
        <!-- /.content-wrapper -->
        <footer class="main-footer">
            @include('layouts.includes.footer')
        </footer>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            @include('layouts.includes.right-aside')
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @if (Session::has('success'))
        <div class="custom-alert alert alert-success fade show" role="alert">
            <strong>Success!</strong>
            <p class="p-0 m-0">{{ Session::get('success') }}</p>
        </div>
    @endif
    @if (Session::has('warning'))
        <div class="custom-alert text-white alert alert-warning fade show" role="alert">
            <strong>Warning!</strong>
            <p class="p-0 m-0">{{ Session::get('warning') }}</p>
        </div>
    @endif
    @if (Session::has('error'))
        <div class="custom-alert alert alert-danger fade show" role="alert">
            <strong>Error!</strong>
            <p class="p-0 m-0">{{ Session::get('error') }}</p>
        </div>
    @endif

    <!-- jQuery -->
    <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('dist/js/adminlte.js') }}"></script>
    <script src="{{ asset('dist/js/demo.js') }}"></script>
    @yield('plugin')

    <script>
        $('.alert').delay(4000).fadeOut();
    </script>

    @yield('script')
    @stack('script')

</body>

</html>
