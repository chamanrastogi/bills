<!doctype html>
<html class="no-js" lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    @php
    $template = App\Models\SiteSetting::find(1);


    @endphp
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <!-- Place favicon.ico in the root directory -->
    <title>@yield('title') </title>
    <meta name="description" content="@yield('meta_description')" />
    <meta name="keywords" content="@yield('meta_keywords')" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Favicon -->
    <link rel="shortcut icon" href="{{ asset($template->favicon) }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/fonts/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/fonts_lato/stylesheet.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.mmenu.css') }}">
  
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/jquery.bxslider.min.css') }}">


    <!-- Extra CSS here -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/custom.css') }}">
     <!-- Font Awesome CSS here -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css">
    @yield('style')
    <!-- End layout styles -->
</head>

<body>

        <!-- tp-offcanvus-area-end -->


        <!-- header-top area start -->
        <x-header-area></x-header-area>
        <!-- header-top area end -->


        {{ $slot }}


        <!-- footer area start -->
        <x-footer-area></x-footer-area>
        <!-- footer area end -->

             <!-- Extra js for this page -->
        @yield('script')
</body>


</html>
