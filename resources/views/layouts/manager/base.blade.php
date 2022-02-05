<!DOCTYPE html>
<html lang="en" dir="rtl" style="direction: rtl;">

<head>

    <title>پنل مدیریت - @yield('page_title')</title>

    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="/assets/panels/media/logos/favicon.ico" />

    <!--begin::Fonts-->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" />
    <!--end::Fonts-->

    <!--begin::Global Stylesheets Bundle(used by all pages)-->
    <link href="/assets/panels/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="/assets/panels/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />
    <link href="/assets/main/css/style.bundle.rtl.css" rel="stylesheet" type="text/css" />

    <!--end::Global Stylesheets Bundle-->

</head>


<body id="kt_body" class="header-tablet-and-mobile-fixed toolbar-enabled toolbar-fixed aside-enabled aside-fixed" style="--kt-toolbar-height:55px;--kt-toolbar-height-tablet-and-mobile:55px; font-family: IRAN Sans; ">

    <!--begin::Main-->
    <!--begin::Root-->
    <div class="d-flex flex-column flex-root">
        <!--begin::Page-->
        <div class="page d-flex flex-row flex-column-fluid">

            <!--begin::Aside-->
            @include('layouts.manager.aside')
            <!--end::Aside-->

            <!--begin::Wrapper-->
            @include('layouts.manager.wrapper')
            <!--end::Wrapper-->

        </div>
        <!--end::Page-->
    </div>
    <!--end::Root-->
    <!--end::Main-->


    <!--begin::Javascript-->

    <!--begin::Global Javascript Bundle(used by all pages)-->
    <script src="/assets/panels/plugins/global/plugins.bundle.js"></script>
    <script src="/assets/panels/js/scripts.bundle.js"></script>
    <!--end::Global Javascript Bundle-->
    
    <!--begin::Page Custom Javascript-->
    @yield('js')
    <!--end::Page Custom Javascript-->

    <!--end::Javascript-->

</body>
</html>