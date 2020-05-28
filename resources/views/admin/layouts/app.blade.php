<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>


    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
</head>

<body>
    <div id="app">
        <div class="wrapper">
            <!-- Navbar -->
            @include('admin/includes/header')
            <!-- /.navbar -->

            <!-- Main Sidebar Container -->
            <aside class="main-sidebar sidebar-dark-primary elevation-4">

                @include('admin/includes/sidebar')
            </aside>

            @yield('content')
        </div>
    </div>
    <!-- Scripts -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.0/jquery.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.2/standard/ckeditor.js"></script>
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/main.js') }}" defer></script>
    @yield('script')
    <script>
        $("body").on("change", "#select-all", function() {

            if ($(this).is(':checked')) {
                $("input[type='checkbox']").attr('checked', 'checked');
            } else {
                $("input[type='checkbox']").removeAttr('checked');
            }
        });
        $("body").on("change", ".check_item", function() {
            if ($(this).is(':checked')) {
                $(this).attr('checked', 'checked');
            } else {
                $(this).removeAttr('checked');
                $('#select-all').removeAttr('checked');
            }

        });


    </script>
</body>

</html>
