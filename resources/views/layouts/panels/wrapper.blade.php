<div class="wrapper d-flex flex-column flex-row-fluid" id="kt_wrapper">

    <!--begin::Header-->
    <div id="kt_header" class="header align-items-stretch">
        <!--begin::Container-->
        <div class="container-fluid d-flex align-items-stretch justify-content-between">

            <!--begin::Aside mobile toggle-->
            <div class="d-flex align-items-center d-lg-none ms-n3 me-1" title="نمایش منو">
                <div class="btn btn-icon btn-active-light-primary w-30px h-30px w-md-40px h-md-40px"
                    id="kt_aside_mobile_toggle">
                    <!--begin::Svg Icon | path: icons/duotone/Text/Menu.svg-->
                    <span class="svg-icon svg-icon-2x mt-1">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink"
                            width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <rect fill="#000000" x="4" y="5" width="16" height="3" rx="1.5" />
                                <path
                                    d="M5.5,15 L18.5,15 C19.3284271,15 20,15.6715729 20,16.5 C20,17.3284271 19.3284271,18 18.5,18 L5.5,18 C4.67157288,18 4,17.3284271 4,16.5 C4,15.6715729 4.67157288,15 5.5,15 Z M5.5,10 L18.5,10 C19.3284271,10 20,10.6715729 20,11.5 C20,12.3284271 19.3284271,13 18.5,13 L5.5,13 C4.67157288,13 4,12.3284271 4,11.5 C4,10.6715729 4.67157288,10 5.5,10 Z"
                                    fill="#000000" opacity="0.3" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                </div>
            </div>
            <!--end::Aside mobile toggle-->

            <!--begin::Mobile logo-->
            <div class="d-flex align-items-center flex-grow-1 flex-lg-grow-0">
                <h1 class="d-lg-none" style=" color: #646464; margin-top: 10px; ">@yield('mobile_logo')</h1>
            </div>
            <!--end::Mobile logo-->

            <!--begin::Wrapper-->
            <div class=" d-flex align-items-stretch justify-content-between flex-lg-grow-1 ">
                
                <!--begin::Navbar-->
                <div  class=" d-flex align-items-stretch " id="kt_header_nav">
                    <!--begin::Menu wrapper-->
                    <div class="header-menu align-items-stretch" data-kt-drawer="true" data-kt-drawer-name="header-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="end" data-kt-drawer-toggle="#kt_header_menu_mobile_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav'}">
                        <!--begin::Menu-->
                        <div class="menu menu-lg-rounded menu-column menu-lg-row menu-state-bg menu-title-gray-700 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-400 fw-bold my-5 my-lg-0 align-items-stretch" id="#kt_header_menu" data-kt-menu="true">
                            <div class="menu-item me-lg-1">
                            <!--begin::breadcrumb-->
                                @yield('breadcrumb')
                            <!--end::breadcrumb-->
                            </div>
                        </div>
                    </div>
                    <!--end::Menu wrapper-->
                </div>
                <!--end::Navbar-->

                <!--begin::Topbar-->
                <div class="d-flex align-items-stretch flex-shrink-0">
                    <!--begin::Toolbar wrapper-->
                    <div class="d-flex align-items-stretch flex-shrink-0">
                        <div class="d-flex align-items-center ms-1 ms-lg-3">
                       <!--begin::Trigger-->

                            <button type="button" class="btn btn-dark btn-sm btn-active-light-primary" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-start" data-kt-menu-flip="top-start">
                                <i class="bi bi-person-circle" style="margin-left: 10px;"></i>
                                    @yield('header_toolbar_name')
                                <i class="bi bi-caret-down-fill" style="margin-right: 10px;"></i>
                            </button>
                            <!--end::Trigger-->

                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-gray-600 menu-lg-rounded menu-state-bg fw-bold fs-7 w-200px py-2" data-kt-menu="true" >
                                <!--begin::Menu item-->
	                                @yield('header_toolbar_items')
                                <!--end::Menu item-->

                                <div class="separator my-2"></div>

                                <!--begin::Menu item-->
                                <form action='logout' method="post">
                                    @csrf
                                    <div class="menu-item px-1">
                                        <label class="menu-link" for="submit">
                                            <span class="menu-icon">
                                                <i class="bi bi-grid-1x2-fill"></i>
                                            </span>
                                            خروج از حساب کاربری
                                        </label>
                                        <input type="submit" id="submit" hidden>
                                    </div>
                                </form>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->

                        </div>

                    </div>
                    <!--end::Toolbar wrapper-->
                </div>
                <!--end::Topbar-->

            </div>
            <!--end::Wrapper-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Header-->

    <!--begin::Content-->
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div id="kt_content_container" class="container">

                @yield('content')

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
    <!--end::Content-->

    <!--begin::Footer-->
    <div class="footer py-4 d-flex flex-lg-column" id="kt_footer">
        <!--begin::Container-->
        <div class="container-fluid d-flex flex-column flex-md-row align-items-center justify-content-between">
            <!--begin::Copyright-->
            <div class="text-dark order-2 order-md-1">
                <span class="text-muted fw-bold me-1">نسخه {{ env('APP_VERSION') }}</span>
            </div>
            <!--end::Copyright-->
            <!--begin::Menu-->
            <ul class="menu menu-gray-600 menu-hover-primary fw-bold order-1">
                <li class="menu-item">
                    <a href="https://keenthemes.com" target="_blank" class="menu-link px-2">پشتیبانی</a>
                </li>
            </ul>
            <!--end::Menu-->
        </div>
        <!--end::Container-->
    </div>
    <!--end::Footer-->

</div>
