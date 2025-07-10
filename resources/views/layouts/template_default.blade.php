<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    @include('includes.style');
<style>
    .preloader {
        position: fixed;
        width: 100%;
        height: 100%;
        background-color: #ffffff;
        z-index: 9999;
        top: 0;
        left: 0;
        transition: opacity 0.5s ease;
    }

    .pulse-logo {
        animation: pulse 1.5s infinite ease-in-out;
    }

    @keyframes pulse {
        0% {
            transform: scale(1);
            opacity: 1;
        }
        50% {
            transform: scale(1.05);
            opacity: 0.8;
        }
        100% {
            transform: scale(1);
            opacity: 1;
        }
    }

    /* Optional: hide preloader after page loads */
    body.loaded .preloader {
        opacity: 0;
        visibility: hidden;

    }
</style>

</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="wrapper">

   <!-- Preloader -->
<div id="preloader" class="preloader d-flex flex-column justify-content-center align-items-center bg-white">
    <img class="pulse-logo" src="{{ asset('assets/img/logoft.png') }}" alt="logo" width="120">
    <span class="text-muted mt-2 small">Loading...</span>
</div>


        <div class="mb-4 pb-4">
            @include('includes.navbar')
        </div>

        @include('includes.sidebar')

        <!-- Content Wrapper. Contains page content -->
        @yield('content')
        <!-- /.content-wrapper -->
        <div class="mb-4 pb-4">
            @include('includes.footer')

        </div>
        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->
    </div>
    <!-- ./wrapper -->

    @include('includes.script')
    <script>
    window.addEventListener('load', function () {
        document.body.classList.add('loaded');
    });
</script>

</body>

</html>
