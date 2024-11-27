<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> @yield('title') </title>
    <link rel="icon" type="image/x-icon" href="{{ asset('backend/assets/src/assets/img/favicon.ico') }}" />
    <link href="{{ asset('backend/assets/layouts/vertical-light-menu/css/light/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/layouts/vertical-light-menu/css/dark/loader.css') }}" rel="stylesheet"
        type="text/css" />
    <script src="{{ asset('backend/assets/layouts/vertical-light-menu/loader.js') }}"></script>

    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{ asset('backend/assets/src/bootstrap/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/layouts/vertical-light-menu/css/light/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/layouts/vertical-light-menu/css/dark/plugins.css') }}" rel="stylesheet"
        type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->
    <!-- Toastr styles -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" rel="stylesheet">
    <!-- End layout styles -->
    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('backend/assets/src/plugins/src/apex/apexcharts.css') }}" rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/src/assets/css/light/dashboard/dash_1.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/src/assets/css/dark/dashboard/dash_1.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/src/assets/color.css') }}" rel="stylesheet" type="text/css">
    <!-- END PAGE LEVEL PLUGINS/CUSTOM STYLES -->
    <link href="{{ asset('backend/assets/src/assets/css/light/components/font-icons.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/assets/src/assets/css/dark/components/font-icons.css') }}" rel="stylesheet"
        type="text/css">

    <link href="{{ asset('backend/assets/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/src/assets/css/light/scrollspyNav.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('backend/assets/src/plugins/src/sweetalerts2/sweetalerts2.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/assets/src/plugins/css/light/sweetalerts2/custom-sweetalert.css') }}"
        rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets//src/plugins/css/dark/sweetalerts2/custom-sweetalert.css') }}"
        rel="stylesheet" type="text/css" />

    <link href="{{ asset('backend/assets/src/plugins/src/table/datatable/datatables.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/assets/src/plugins/css/light/table/datatable/dt-global_style.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/src/plugins/css/light/table/datatable/custom_dt_miscellaneous.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/src/plugins/css/dark/table/datatable/dt-global_style.css') }}"
        rel="stylesheet" type="text/css">
    <link href="{{ asset('backend/assets/src/plugins/css/dark/table/datatable/custom_dt_miscellaneous.css') }}"
        rel="stylesheet" type="text/css">

    <!-- END GLOBAL MANDATORY STYLES -->
    <link href="{{ asset('backend/assets/src/plugins/src/font-icons/fontawesome/css/regular.css') }}" rel="stylesheet"
        type="text/css">
    <link href="{{ asset('backend/assets/src/plugins/src/font-icons/fontawesome/css/fontawesome.css') }}"
        rel="stylesheet" type="text/css">
    <!-- Scripts -->
    @yield('style')
    @vite(['resources/js/app.js'])
</head>

<body class="layout-boxed">
    <!-- BEGIN LOADER -->
    <div id="load_screen">
        <div class="loader">
            <div class="loader-content">
                <div class="spinner-grow align-self-center"></div>
            </div>
        </div>
    </div>
    <!--  END LOADER -->

    <!--  BEGIN NAVBAR  -->
    @include('admin.body.nav')

    <!--  END NAVBAR  -->

    <!--  BEGIN MAIN CONTAINER  -->
    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>

        <!--  BEGIN SIDEBAR  -->
        @include('admin.body.side')
        <!--  END SIDEBAR  -->

        <!--  BEGIN CONTENT AREA  -->
        <div id="content" class="main-content">
            <div class="layout-px-spacing">

                <div class="middle-content container-xxl p-0">

                    <!--  BEGIN BREADCRUMBS  -->
                    @include('admin.body.breadcrumbs')
                    <!--  END BREADCRUMBS  -->

                    <div class="row layout-top-spacing">

                        {{ $slot }}

                    </div>

                </div>

            </div>
            <!--  BEGIN FOOTER  -->
            @include('admin.body.footer')
            <!--  END FOOTER  -->
        </div>
        <!--  END CONTENT AREA  -->

    </div>
    <!-- END MAIN CONTAINER -->


    <!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
    <script src="{{ asset('backend/assets/src/plugins/src/global/vendors.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/perfect-scrollbar/perfect-scrollbar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/mousetrap/mousetrap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/assets/layouts/vertical-light-menu/app.js') }}"></script>
    <script src="{{ asset('backend/assets/src/assets/js/custom.js') }}"></script>
    <!-- END GLOBAL MANDATORY SCRIPTS -->
    <!-- Toastr js for this page -->
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        @if (Session::has('message'))
            var type = "{{ Session::get('alert-type', 'info') }}"
            switch (type) {
                case 'info':
                    toastr.info(" {{ Session::get('message') }} ");
                    break;

                case 'success':
                    toastr.success(" {{ Session::get('message') }} ");
                    break;

                case 'warning':
                    toastr.warning(" {{ Session::get('message') }} ");
                    break;

                case 'error':
                    toastr.error(" {{ Session::get('message') }} ");
                    break;
            }
        @endif
    </script>

    <!-- BEGIN PAGE LEVEL PLUGINS/CUSTOM SCRIPTS -->
    <script src="{{ asset('backend/assets/src/plugins/src/apex/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/assets/js/dashboard/dash_1.js') }}"></script>
    <script src="{{ asset('backend/assets/src/assets/js/forms/bootstrap_validation/bs_validation_script.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/sweetalerts2/sweetalerts2.min.js') }}"></script>
    {{-- <script src="{{ asset('backend/assets/src/plugins/src/sweetalerts2/custom-sweetalert.js')}}"></script> --}}
    <script src="{{ asset('backend/assets/src/plugins/src/font-icons/feather/feather.min.js') }}"></script>
    <script type="text/javascript">
        feather.replace();
    </script>
    <!-- BEGIN PAGE LEVEL SCRIPTS -->
    <script src="{{ asset('backend/assets/src/plugins/src/table/datatable/datatables.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/table/datatable/button-ext/dataTables.buttons.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/src/plugins/src/table/datatable/button-ext/jszip.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/table/datatable/button-ext/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/table/datatable/button-ext/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/src/plugins/src/table/datatable/custom_miscellaneous.js') }}"></script>

@yield('script')
    <!-- END PAGE LEVEL SCRIPTS -->

</body>

</html>
