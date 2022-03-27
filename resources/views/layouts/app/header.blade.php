<!--begin::Header Section-->
<div class="mb-0" id="home">
    <!--begin::Wrapper-->
    <div class="bgi-no-repeat bgi-size-contain bgi-position-x-center bgi-position-y-bottom landing-dark-bg" style="background-image: url(/media/svg/illustrations/landing.svg)">
        <!--begin::Header-->
        <div class="landing-header" data-kt-sticky="true" data-kt-sticky-name="landing-header" data-kt-sticky-offset="{default: '200px', lg: '400px'}">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Wrapper-->
                <div class="d-flex align-items-center justify-content-between">
                    <!--begin::Logo-->
                    <div class="d-flex align-items-center flex-equal">
                        <!--begin::Mobile menu toggle-->
                        <button class="btn btn-icon btn-active-color-primary me-3 d-flex d-lg-none" id="kt_landing_menu_toggle">
                            <!--begin::Svg Icon | path: icons/duotune/abstract/abs015.svg-->
                            <span class="svg-icon svg-icon-2hx">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M21 7H3C2.4 7 2 6.6 2 6V4C2 3.4 2.4 3 3 3H21C21.6 3 22 3.4 22 4V6C22 6.6 21.6 7 21 7Z" fill="black" />
                                    <path opacity="0.3" d="M21 14H3C2.4 14 2 13.6 2 13V11C2 10.4 2.4 10 3 10H21C21.6 10 22 10.4 22 11V13C22 13.6 21.6 14 21 14ZM22 20V18C22 17.4 21.6 17 21 17H3C2.4 17 2 17.4 2 18V20C2 20.6 2.4 21 3 21H21C21.6 21 22 20.6 22 20Z" fill="black" />
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </button>
                        <!--end::Mobile menu toggle-->
                        <!--begin::Logo image-->
                        <a href="{{ route('home') }}">
                            <img alt="Logo" src="/media/logos/logo-landing.svg" class="logo-default h-25px h-lg-30px" />
                            <img alt="Logo" src="/media/logos/logo-landing-dark.svg" class="logo-sticky h-20px h-lg-25px" />
                        </a>
                        <!--end::Logo image-->
                    </div>
                    <!--end::Logo-->
                    <!--begin::Menu wrapper-->
                    <div class="d-lg-block" id="kt_header_nav_wrapper">
                        <div class="d-lg-block p-5 p-lg-0" data-kt-drawer="true" data-kt-drawer-name="landing-menu" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="200px" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_landing_menu_toggle" data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_body', lg: '#kt_header_nav_wrapper'}">
                            <!--begin::Menu-->
                            <div class="menu menu-column flex-nowrap menu-rounded menu-lg-row menu-title-gray-500 menu-state-title-primary nav nav-flush fs-5 fw-bold" id="kt_landing_menu">
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link--> 
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">منو 1</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">منو 2</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                                <!--begin::Menu item-->
                                <div class="menu-item">
                                    <!--begin::Menu link-->
                                    <a class="menu-link nav-link py-3 px-4 px-xxl-6" href="#" data-kt-scroll-toggle="true" data-kt-drawer-dismiss="true">منو 3</a>
                                    <!--end::Menu link-->
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        </div>
                    </div>
                    <!--end::Menu wrapper-->
                    <!--begin::Toolbar-->
                    <div class="flex-equal text-end ms-1">
                        @auth('web')
                            <!--begin::Trigger-->
                            <button type="button" class="btn btn-primary"
                                data-kt-menu-trigger="click"
                                data-kt-menu-placement="bottom-start">
                                {{ Auth::guard('web')->user()->name }}
                            </button>
                            <!--end::Trigger-->

                            <!--begin::Menu-->
                            <div class="menu menu-sub menu-sub-dropdown menu-column menu-rounded menu-gray-600 menu-state-bg-light-primary fw-bold fs-7 w-200px py-4"
                                data-kt-menu="true">
                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="{{ route('user.profile') }}" class="menu-link px-3">
                                        پروفایل
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        رزروها
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        مسافران
                                    </a>
                                </div>
                                <!--end::Menu item-->

                                <!--begin::Menu item-->
                                <div class="menu-item px-3">
                                    <a href="#" class="menu-link px-3">
                                        پیام ها
                                    </a>
                                </div>
                                <!--end::Menu item-->
                            </div>
                            <!--end::Menu-->
                        @endauth

                        @guest('web')
                            <a href="{{ route('user.login') }}" class="btn btn-primary">ورود | ثبت نام</a>
                        @endguest
                    </div>
                    <!--end::Toolbar-->
                </div>
                <!--end::Wrapper-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Header-->
        @yield('landing_hero')
    </div>
    <!--end::Wrapper-->

</div>
<!--end::Header Section-->

@yield('header_stick')