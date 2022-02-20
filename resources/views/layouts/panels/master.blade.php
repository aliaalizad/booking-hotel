<!DOCTYPE html>
<html lang="en" dir="rtl" style="direction: rtl;">

<head>

    <title>@yield('page_title_prefix') | @yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/media/logos/favicon.ico" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/plugins/global/plugins.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="/css/panels.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->

    @stack('styles')

</head>


<body id="kt_body" class="header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed persianNumber" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px; ">

    <!--begin::Main-->
        <!--begin::Root-->
        <div class="d-flex flex-column flex-root">
            <!--begin::Page-->
            <div class="page d-flex flex-row flex-column-fluid">

                <!--begin::Aside-->
                @include('layouts.panels.aside')
                <!--end::Aside-->

                <!--begin::Wrapper-->
                @include('layouts.panels.wrapper')
                <!--end::Wrapper-->

            </div>
            <!--end::Page-->
        </div>
        <!--end::Root-->
    <!--end::Main-->


    <!--begin::Javascript-->

        <!--begin::Global Javascript Bundle(used by all pages)-->
            <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
            <script src="/js/scripts.bundle.js"></script>
            <script src="/plugins/global/plugins.bundle.js"></script>
            <script src="/plugins/global/persianumber.js"></script>
        <!--end::Global Javascript Bundle-->
    
    <!--begin::Page Custom Javascript-->
        @stack('scripts')
    <!--end::Page Custom Javascript-->

    <!--end::Javascript-->
    
    <!--begin::JQuery-->
        <script type="text/javascript">$(document).ready(function(){$('.persianNumber').persiaNumber();});</script>
    <!--end::JQuery-->
    
</body>
</html>