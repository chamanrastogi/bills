<!DOCTYPE html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
        $template = App\Models\SiteSetting::find(1);

        $style = STYLES[$template->style] . '.css';
    @endphp
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>@yield('title') </title>
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keywords')" />

    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset($template->favicon) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- All plugins -->
    <link href="{{ asset('frontend/assets/plugins/css/plugins.css') }}" rel="stylesheet">

    <!-- Custom style -->
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('frontend/assets/css/responsiveness.css') }}" rel="stylesheet">

    <link type="text/css" rel="stylesheet" id="jssDefault"
        href="{{ asset('frontend/assets/css/colors/' . $style . '') }}">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="{{ asset('frontend/js/html5shiv.min.js') }}"></script>
      <script src="{{ asset('frontend/js/respond.min.js') }}"></script>
    <![endif]-->

</head>

<body class="home-2">
    <div class="wrapper">

        <div class="clearfix"></div>
        {{ $slot }}

    </div>
    <!-- /Switcher -->
    <a id="back2Top" class="theme-bg" title="Back to top" href="#"><i class="ti-arrow-up"></i></a>


    <!-- START JAVASCRIPT -->
    <script src="{{ asset('frontend/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/bootsnav.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/bootstrap-select.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/bootstrap-touch-slider-min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/jquery.touchSwipe.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/chosen.jquery.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/datedropper.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/dropzone.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/jquery.fancybox.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/jquery.nice-select.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/jqueryadd-count.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/jquery-rating.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/timedropper.js') }}"></script>
    <script src="{{ asset('frontend/assets/plugins/js/waypoints.min.js') }}"></script>



    <!-- Custom Js -->
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>


    </div>
</body>

</html>
