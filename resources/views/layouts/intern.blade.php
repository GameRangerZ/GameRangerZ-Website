<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Meta -->
{!! SEO::generate() !!}
<!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('assets/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/css/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- Plugin css for this page -->
    <link rel="stylesheet" href="{{asset('assets/vendors/jvectormap/jquery-jvectormap.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/flag-icon-css/css/flag-icon.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendors/owl-carousel-2/owl.theme.default.min.css')}}">
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <!-- endinject -->
    <!-- Layout styles -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <!-- End layout styles -->
    <link rel="shortcut icon" href="{{asset('assets/images/favicon.png')}}"/>
</head>
<body>
<div class="container-scroller">
    <!-- Sidebar -->
{{menu("intern","layouts.sidebar")}}
<!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- Topbar -->
    @include('layouts.topbar')
    <!-- Content -->
        <div class="main-panel">
            <div class="content-wrapper">
                @yield('content')
                @if ($message = Session::get('achievement'))
                    <div id="achievement" class="fixed-bottom">
                        <div class="circle"></div>
                        <div class="copy">
                            <h4>Erfolg errungen!</h4>
                            <p>{{ $message }}</p>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('assets/vendors/js/vendor.bundle.base.js') }}"></script>
<!-- endinject -->
<!-- End plugin js for this page -->
<!-- inject:js -->
<script src="{{asset('assets/js/off-canvas.js') }}"></script>
<script src="{{asset('assets/js/hoverable-collapse.js') }}"></script>
<script src="{{asset('assets/js/misc.js') }}"></script>
<script src="{{asset('assets/js/settings.js') }}"></script>
<script src="{{asset('assets/js/todolist.js') }}"></script>
<!-- endinject -->
<!-- Custom js for this page -->
<script src="{{asset('assets/js/dashboard.js') }}"></script>
<!-- End custom js for this page -->

@if ($message = Session::get('achievement'))
    <script>
        function showAchievement() {
            $('#achievement .circle').removeClass('rotate');
            // Run the animations
            setTimeout(function () {
                $('#achievement').addClass('expand');
                setTimeout(function () {
                    $('#achievement').addClass('widen');
                    setTimeout(function () {
                        $('#achievement .copy').addClass('show');
                        var audio = new Audio("{{asset("/sound/wow.wav")}}");
                        audio.play();
                    }, 1000);
                }, 1000);
            }, 1000);
            // Hide the achievement
            setTimeout(function () {
                hideAchievement();
            }, 5000);
        }

        function hideAchievement() {
            setTimeout(function () {
                $('#achievement .copy').removeClass('show');
                setTimeout(function () {
                    $('#achievement').removeClass('widen');
                    $('#achievement .circle').addClass('rotate');
                    setTimeout(function () {
                        $('#achievement').removeClass('expand');
                        $('.refresh').fadeIn(300);
                    }, 1000);
                }, 1000);
            }, 3000);

            $('.refresh').click(function () {
                showAchievement();
                $(this).fadeOut(300);
            });
        }

        showAchievement();
    </script>
@endif
</body>
</html>
