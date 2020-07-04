<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
{!! SEO::generate() !!}

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/custom.js') }}" defer></script>

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ asset('favicon.ico') }}" />

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link rel="dns-prefetch" href="//cdnjs.cloudflare.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito|Montserrat|Open+Sans" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet" type="text/css" >
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet" type="text/css" >
</head>
<body id="page-top" data-spy="scroll" data-target=".navbar-fixed-top">
    <div id="app">
        {{menu("main","layouts.nav")}}
        <main class="mt-5 pt-5">
            @yield('content')
            <!-- Footer -->
                <footer>
                    <div class="container text-center">
                        <p>Copyright &#xA9; GameRangerZ {{date("Y")}}</p>
                    </div>
                </footer>
        </main>

    </div>


    <script src="{{ asset('js/jquery.easing.min.js') }}" defer></script>
</body>
</html>
