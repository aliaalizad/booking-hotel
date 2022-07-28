<!DOCTYPE html>
<html lang="en" dir="rtl">

<!--begin::Head-->
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <link rel="shortcut icon" href="/media/logos/favicon.ico" />
    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->
    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/css/style.css" rel="stylesheet" type="text/css" />
    <!--end::Global Stylesheets Bundle-->


</head>
<!--end::Head-->

<body id="kt_body" data-bs-spy="scroll" data-bs-target="#kt_landing_menu" data-bs-offset="200" class="position-relative persianNumber">

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">

        @include('layouts.app.header')


        <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
            <!--begin::Post-->
            <div class="post d-flex flex-column-fluid" id="kt_post">
                <div id="kt_content_container" class="container-xxl">
                    <!--begin::Layout-->
                        @yield('content')
                    <!--end::Layout-->
                </div>
            </div>
            <!--end::Post-->
    </div>


    </div>
    <!--end::Root-->
    <!--end::Main-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="/plugins/global/jquery-functions.js"></script>
    <script src="/js/scripts.bundle.js"></script>
    <script src="/plugins/global/plugins.bundle.js"></script>
    <script src="/plugins/global/persianumber.js"></script>
    <script src="/plugins/global/persian-date.js"></script>

</body>
</html>

