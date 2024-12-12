<!DOCTYPE html>
<html lang="en">

@php
    $aliasTitle = implode(
        '',
        array_map(function ($word) {
            return strtoupper($word[0]);
        }, explode(' ', env('APP_NAME'))),
    );
@endphp

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>{{ $aliasTitle }}</title>

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset('assets/img/Logo.png') }}" />

    <!-- General CSS Files -->
    <link rel="stylesheet" href="{{ asset('assets/modules/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/modules/fontawesome/css/all.min.css') }}">

    <!-- CSS Libraries -->
    @stack('css')
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">

<body id="body">

    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            @include('admin.partials.user-nav')
            @include('admin.partials.sidebar')

            <!-- Main Content -->
            <div class="main-content">
                @yield('main')
            </div>
            @include('admin.partials.watermark')
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="{{ asset('assets/modules/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/modules/popper.js') }}"></script>
    <script src="{{ asset('assets/modules/tooltip.js') }}"></script>
    <script src="{{ asset('assets/modules/bootstrap/js/bootstrap.min.j') }}s"></script>
    <script src="{{ asset('assets/modules/nicescroll/jquery.nicescroll.min.js') }}"></script>
    <script src="{{ asset('assets/modules/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Page Specific JS File -->
    @stack('js')
    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <!-- Sweetalert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{ asset('assets/js/sweetalert2@11.js') }}"></script>
    @if (session('success'))
        <script type="text/javascript">
            let successTime;
            Swal.fire({
                title: "Success!",
                text: "{{ session('success') }}",
                timer: 5000,
                icon: 'success',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    successTime = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif
    @if (session('failed'))
        <script type="text/javascript">
            let failedTime;
            Swal.fire({
                title: "Fail!",
                text: "{{ session('failed') }}",
                timer: 500000,
                icon: 'error',
                timerProgressBar: true,
                confirmButtonText: 'Oke',
                didOpen: () => {
                    failedTime = setInterval(() => {}, 100)
                },
                willClose: () => {

                }
            }).then((result) => {
                if (result.dismiss === Swal.DismissReason.timer) {

                }
            });
        </script>
    @endif
</body>

</html>
