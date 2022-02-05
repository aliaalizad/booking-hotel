<div id="kt_aside" class="aside aside-dark aside-hoverable " data-kt-drawer="true" data-kt-drawer-name="aside" data-kt-drawer-activate="{default: true, lg: false}" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'200px', '300px': '250px'}" data-kt-drawer-direction="start" data-kt-drawer-toggle="#kt_aside_mobile_toggle">
    
    <!--begin::Brand-->
    <div class="aside-logo flex-column-auto" id="kt_aside_logo">

        <!--begin::Logo-->
        <!-- <img alt="Logo" src="assets/media/logos/logo-1.svg" class="h-15px logo" /> -->
        <h1 class="logo" style="color: #e0e0e0; margin-top: 5px;">پنل مدیریت</h1>
        <!--end::Logo-->

        <!--begin::Aside toggler-->
        <div id="kt_aside_toggle" class="btn btn-icon w-auto px-0 btn-active-color-primary aside-toggle" data-kt-toggle="true" data-kt-toggle-state="active" data-kt-toggle-target="body" data-kt-toggle-name="aside-minimize">
            <span class="svg-icon svg-icon-1 ">
                <i class="bi bi-list fs-2x"></i>
            </span>
        </div>
        <!--end::Aside toggler-->

    </div>
    <!--end::Brand-->

    <!--begin::Aside menu-->
    <div class="aside-menu flex-column-fluid">
        <!--begin::Aside Menu-->
        <div class="hover-scroll-overlay-y my-5 my-lg-5" id="kt_aside_menu_wrapper" data-kt-scroll="true" data-kt-scroll-activate="{default: false, lg: true}" data-kt-scroll-height="auto" data-kt-scroll-dependencies="#kt_aside_logo, #kt_aside_footer" data-kt-scroll-wrappers="#kt_aside_menu" data-kt-scroll-offset="0">
            <!--begin::Menu-->
            <div class="menu menu-column menu-title-gray-800 menu-state-title-primary menu-state-icon-primary menu-state-bullet-primary menu-arrow-gray-500" id="#kt_aside_menu" data-kt-menu="true">
                
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('manager.dashboard') }}">
                        <i class="bi bi-grid-1x2-fill"></i>
                        <span class="menu-title" style="margin-right: 10px;">داشبورد</span>
                    </a>
                </div>
                
                <div class="menu-item">
                    <a class="menu-link" href="{{ route('manager.members.index') }}">
                        <i class="bi bi-people-fill"></i>
                        <span class="menu-title" style="margin-right: 10px;">کارمندان</span>
                    </a>
                </div>

                <div class="menu-item">
                    <a class="menu-link" href="{{ route('manager.hotels.index') }}">
                        <i class="bi bi-people-fill"></i>
                        <span class="menu-title" style="margin-right: 10px;">هتل ها</span>
                    </a>
                </div>

            </div>
            <!--end::Menu-->
        </div>
        <!--end::Aside Menu-->
    </div>
    <!--end::Aside menu-->
    
    <!--begin::Footer-->
    <div class="aside-footer flex-column-auto pt-5 pb-7 px-5" id="kt_aside_footer">
        <a href="#" class="btn btn-custom btn-primary w-100" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-dismiss-="click" >
            <span class="btn-label">تنظیمات</span>
            <span class="svg-icon btn-icon svg-icon-2">
                <i class="bi bi-gear-fill"></i>
            </span>
        </a>
    </div>
    <!--end::Footer-->

</div>
