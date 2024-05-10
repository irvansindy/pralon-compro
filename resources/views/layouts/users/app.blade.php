<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @isset($title)
            {{ $title }}
        @endisset
        {{-- {{ config('app.name') }} --}}
    </title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/logo/favicon.png') }}">

    {{-- template css --}}
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/preloader.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/meanmenu.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/animate.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/swiper-bundle.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/backToTop.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/jquery-ui.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/magnific-popup.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/nice-select.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/fontAwesome6Pro.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/vendor/icomoon.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/plugins/odometer.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/main.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" integrity="sha512-3pIirOrwegjM6erE5gPSwkUzO+3cTjpnV9lexlNZqvupR64iZBnOOTiiLPb9M36zpMScbmUNIcHUqKD47M719g==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">

        <main class="py-4">
            @yield('content')
        </main>
    </div>
    <!-- JS here -->
    <script src="{{ asset('assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/meanmenu.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/magnific-popup.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/backToTop.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/nice-select.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/ajax-form.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/wow.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/imagesloaded.pkgd.min.js') }}"></script>z
    <script src="{{ asset('assets/js/vendor/jquery.appear.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery.odometer.min.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/jquery-ui-slider-range.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/slick.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/parallax-scroll.js') }}"></script>
    <script src="{{ asset('assets/js/vendor/js_circle-progress.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.30.1/moment-with-locales.min.js" integrity="sha512-4F1cxYdMiAW98oomSLaygEwmCnIP38pb4Kx70yQYqRwLVCs3DbRumfBq82T08g/4LJ/smbFGFpmeFlQgoDccgg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js" integrity="sha512-VEd+nq25CkR676O+pLBnDW09R7VQX9Mdiij052gVCp5yVH3jGtH70Ho/UUv4mJDsEdTvqRCFZg0NKGiojGnUCw==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="{{ asset('assets/js/main.js') }}"></script>
    @stack('js')
</body>

</html>
