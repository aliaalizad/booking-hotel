<form action="{{ route('search') }}" id="search_form" autocomplete="off" class="form min-w-lg-1000px">
    <!--begin::Row-->
    <div class="row">
        <!--begin::Col-->
        <div class="col-xxl-3 mb-4 mb-md-0">
                <select class="form-select" name="dest" id="dest" data-control="select2" data-placeholder="مقصد یا هتل">
                    <option></option>
                    <optgroup label="شهر">
                        <option value="tabriz">تبریز</option>
                        <option value="tehran">تهران</option>
                        <option value="mashhad">مشهد</option>
                    </optgroup>
                    <optgroup label="هتل">
                        <option value="1">مرکز تکریم فرهنگیان تبریز</option>
                        <option value="2">باشگاه فرهنگیان تبریز</option>
                        <option value="3">خانه معلم 2 تبریز</option>
                    </optgroup>
                </select>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-4 mb-4 mb-md-0">
            <div class="d-flex form-group">
                <div class="input-control mx-1">
                    <input type="text" class="date-from input-field" readonly placeholder="تاریخ ورود">
                    <label class="input-label">تاریخ ورود</label>
                    <input type="hidden" name="checkin" class="date-from-date"/>
                </div>
                <div class="input-control mx-1">
                    <input type="text" class="date-to input-field" readonly placeholder="تاریخ خروج">
                    <label class="input-label">تاریخ خروج</label>
                    <input type="hidden" name="checkout" class="date-to-date"/>
                </div>
            </div>
        </div>
        <!--end::Col-->
        <!--begin::Col-->
        <div class="col-xxl-3 mb-4 mb-md-0">
            <!--begin::Menu toggle-->
            <div class="input-control show menu-dropdown" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
                <input type="text" id="passengers" class="input-field" value="1" readonly placeholder="مسافران" />
                <label class="input-label">مسافران</label>

            </div>
            <!--end::Menu toggle-->
            
            <!--begin::Menu-->
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px " data-kt-menu="true" id="kt_menu_61de0c0cad61e" style="z-index: 105; position: fixed; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-115px, 110px, 0px);" data-popper-placement="bottom-end">
                <!--begin::Form-->
                <div class="px-7 py-5">
                    <!--begin::Input group-->
                    <div class="row d-flex align-items-center my-2">
                        <div class="col-xxl-3">
                            <!--begin::Label-->
                            <label class="form-label fw-bold">بزرگسال:</label>
                            <!--end::Label-->
                        </div>
                        <div class="col-xxl-9">
                            <!--begin::Input-->
                            <div class="position-relative" data-kt-dialer="true" data-kt-dialer-min="1" data-kt-dialer-max="10" data-kt-dialer-step="1" >
                                <!--begin::Decrease control-->
                                <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 start-0 dialer-button" data-kt-dialer-control="decrease">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen042.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Decrease control-->
                                <!--begin::Input control-->
                                <input type="text" class="form-control form-control-solid border-0 text-center" data-kt-dialer-control="input" placeholder="Adults" name="adults" id="adults" readonly="readonly" value="1">
                                <!--end::Input control-->
                                <!--begin::Increase control-->
                                <button type="button" class="btn btn-icon btn-active-color-gray-700 position-absolute translate-middle-y top-50 end-0 dialer-button" data-kt-dialer-control="increase">
                                    <!--begin::Svg Icon | path: icons/duotune/general/gen041.svg-->
                                    <span class="svg-icon svg-icon-1">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                            <rect opacity="0.3" x="2" y="2" width="20" height="20" rx="10" fill="black"></rect>
                                            <rect x="10.8891" y="17.8033" width="12" height="2" rx="1" transform="rotate(-90 10.8891 17.8033)" fill="black"></rect>
                                            <rect x="6.01041" y="10.9247" width="12" height="2" rx="1" fill="black"></rect>
                                        </svg>
                                    </span>
                                    <!--end::Svg Icon-->
                                </button>
                                <!--end::Increase control-->
                            </div>
                            <!--end::Input-->
                        </div>
                        
                    </div>
                    <!--end::Input group-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Menu-->
        </div>

        <!--begin::Col-->
        <div class="col-xxl-2">
            <a class="btn btn-primary" onclick="document.getElementById('search_form').submit()">جستجو</a>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->
</form>
