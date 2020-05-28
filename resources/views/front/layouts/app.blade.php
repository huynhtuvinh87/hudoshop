<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta property="og:image" content="@yield('og_image')">

    <!--Favicon-->
    <link rel="icon" href="{{ asset('images/favicon.png')}}" type="image/x-icon" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet">
    <link href="{{ asset('shop/css/jquery-ui.css') }}" rel="stylesheet">
    <link href="{{ asset('shop/fonts/css/font-awesome.min.css') }}" rel="stylesheet">
    <link href="{{ asset('shop/style.css') }}" rel="stylesheet">
</head>

<body contenteditable="false">
    <div id="wrapper">
        @include('front.includes.header')
        @yield('content')
        @include('front.includes.footer')
        @include('front.includes.mobile')
    </div>

    @include('front.includes.modal_order')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.10.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/shop/js/jquery-ui.js"></script>
    <script src="/shop/js/lazyload.js"></script>
    <script src="/shop/js/jquery-input-file-text.js"></script>
    <script src="/shop/js/lightbox.min.js"></script>
    <script src="/shop/js/jquery.scrollbar.js"></script>
    <script src="/shop/js/owl.carousel.min.js"></script>
    <script src="/shop/js/swiper.js"></script>
    <script src="/shop/js/slick.min.js"></script>
    <script src="/shop/js/jquery.easing-1.3.pack.js"></script>
    <script src="/shop/js/jquery.countdown.min.js"></script>
    <script src="/shop/js/jquery.balloon.min.js"></script>
    <script src="/shop/js/rAF.js"></script>
    <script src="/shop/js/ResizeSensor.js"></script>
    <script src="/shop/js/sticky-sidebar.js"></script>
    <script src="/shop/js/main.js"></script>
    <script>
        window.addEventListener("load", function(event) {
            lazyload();
        });
        $('.footer-top .widget-title').on('click', function() {
            if ($(this).hasClass('expanded')) {
                $(this).removeClass('expanded');
                $(this).siblings('.textwidget').removeClass('expanded');
            } else {
                $(this).addClass('expanded');
                $(this).siblings('.textwidget').addClass('expanded');
            }
        });
    </script>
    @yield('script')

</body>

</html>
