<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Minegreat">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

	<!-- title -->
	<title>Minegreat</title>
	<!-- favicon -->
	<link rel="shortcut icon" type="image/png" href="{!! asset('assets/img/logo.png') !!}">
	<!-- google font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans+Thai:wght@300;400;700&display=swap" rel="stylesheet">
	{{-- <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Poppins:400,700&display=swap" rel="stylesheet"> --}}
	<!-- fontawesome -->
    <link href="{{ asset('vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
	<!-- bootstrap -->
	<link rel="stylesheet" href="{{ asset('assets/bootstrap/css/bootstrap.min.css') }}">
	<!-- owl carousel -->
	<link rel="stylesheet" href="{{ asset('assets/css/owl.carousel.css') }}">
	<!-- magnific popup -->
	<link rel="stylesheet" href="{{ asset('assets/css/magnific-popup.css') }}">
	<!-- animate css -->
	<link rel="stylesheet" href="{{ asset('assets/css/animate.css') }}">
	<!-- mean menu css -->
	<link rel="stylesheet" href="{{ asset('assets/css/meanmenu.min.css') }}">
	<!-- main style -->
	<link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
	<!-- responsive -->
	<link rel="stylesheet" href="{{ asset('assets/css/responsive.css') }}">
    {{-- custom --}}
    <link rel="stylesheet" href="{{ asset('assets/css/custom.css') }}">
    {{-- waitme --}}
    <link rel="stylesheet" href="{{ asset('vendor/waitMe/waitMe.min.css') }}">

    @livewireStyles
    @stack('css')

</head>
<body>

	<!--PreLoader-->
    <div class="loader">
        <div class="loader-inner">
            <div class="circle"></div>
        </div>
    </div>
    <!--PreLoader Ends-->

    @include('customer.layouts.header')

    @yield('top-bg')

    @include('customer.layouts.search')

    <div class="container py-4">
        @yield('content')
    </div>

    @include('customer.layouts.footer')
    @include('customer.layouts.copy')

	<!-- jquery -->
	<script src="{{ asset('assets/js/jquery-1.11.3.min.js') }}"></script>
    {{-- <script src="{{ asset('vendor/jquery/jquery.min.js') }}"></script> --}}
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
	<!-- bootstrap -->
	<script src="{{ asset('assets/bootstrap/js/bootstrap.min.js') }}"></script>
	<!-- count down -->
	{{-- <script src="assets/js/jquery.countdown.js"></script> --}}
	<!-- isotope -->
	<script src="{{ asset('assets/js/jquery.isotope-3.0.6.min.js') }}"></script>
	<!-- waypoints -->
	{{-- <script src="assets/js/waypoints.js"></script> --}}
	<!-- owl carousel -->
	<script src="{{ asset('assets/js/owl.carousel.min.js') }}"></script>
	<!-- magnific popup -->
	<script src="{{ asset('assets/js/jquery.magnific-popup.min.js') }}"></script>
	<!-- mean menu -->
	<script src="{{ asset('assets/js/jquery.meanmenu.min.js') }}"></script>
	<!-- sticker js -->
	<script src="{{ asset('assets/js/sticker.js') }}"></script>
	<!-- main js -->
	<script src="{{ asset('assets/js/main.js') }}"></script>
    {{-- sweet alert --}}
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.23/dist/sweetalert2.all.min.js"></script>
    <script src="{{ asset('js/utils/sweetAlert.js') }}"></script>
    <!-- waitme js -->
	<script src="{{ asset('vendor/waitMe/waitMe.min.js') }}"></script>

    <script>
        $(function () {
            getYearNow();
        });
        function getYearNow() {
            let now = new Date().getFullYear();
            $('#copyright').text(now);
        }
    </script>

    @livewireScripts
    @stack('scripts')

</body>
</html>
