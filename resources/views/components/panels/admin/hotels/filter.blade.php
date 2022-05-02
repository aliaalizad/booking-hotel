<!--begin::Form-->
<form>
    <!--begin::Card-->
    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Compact form-->
            <div class="d-flex align-items-center">
                <!--begin::Input group-->
                <div class="position-relative w-md-400px me-md-2">
                    <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" class="form-control form-control-solid ps-10" name="username" value="{{ request('username') }}" placeholder="جستجو بر اساس نام کاربری ..." />
                </div>
                <!--end::Input group-->
                <!--begin:Action-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-5">جستجو</button>
                    <a id="search_advanced_link" class="btn btn-link" data-bs-toggle="collapse" href="#search_advanced">جستجوی پیشرفته</a>
                </div>
                <!--end:Action-->
            </div>
            <!--end::Compact form-->
            <!--begin::Advance form-->
            <div class=@if( ! is_null(request('name')) or ! is_null(request('phone')) or ! is_null(request('status')) or ! is_null(request('province'))  ) {{ "" }} @else {{ 'collapse' }} @endif  id="search_advanced">
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-9 mb-6"></div>
                <!--end::Separator-->
                <!--begin::Row-->
                <div class="row g-8 mb-8">
                    <!--begin::Col-->
                    <div class="col-xxl-4">
                        <label class="fs-6 form-label text-dark">نام و نام خانوادگی</label>
                        <input type="text" class="form-control form-control-solid ps-10" name="name" value="{{ request('name') }}" placeholder="نام مدیر را وارد کنید ..." />
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-4">
                        <label class="fs-6 form-label text-dark">شماره تلفن</label>
                        <input type="text" class="form-control form-control-solid ps-10" name="phone" value="{{ request('phone') }}" placeholder="شماره تلفن را وارد کنید ..." />
                    </div>
                    <!--end::Col-->
                    <!--begin::Col-->
                    <div class="col-xxl-4">
                        <!--begin::Col-->
                        <div class="col-lg-8">
                            <label class="fs-6 form-label text-dark">وضعیت حساب کاربری</label>
                            <!--begin::Radio group-->
                            <div class="nav-group nav-group-fluid">
                                <!--begin::Option-->
                                <label>
                                    <input type="radio" class="btn-check" name="status" value="" checked="checked" />
                                    <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">-</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label>
                                    <input type="radio" class="btn-check" name="status" value="active" @checked(request('status') == 'active')/>
                                    <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">فعال</span>
                                </label>
                                <!--end::Option-->
                                <!--begin::Option-->
                                <label>
                                    <input type="radio" class="btn-check" name="status" value="inactive"  @checked(request('status') == 'inactive') />
                                    <span class="btn btn-sm btn-color-muted btn-active btn-active-primary fw-bolder px-4">غیرفعال</span>
                                </label>
                                <!--end::Option-->
                            </div>
                            <!--end::Radio group-->
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Col-->
                </div>
                <!--end::Row-->
                <!--begin::Row-->
                <div class="row g-8 mb-8">
                    <!--begin::Col-->
                    <div class="col-xxl-4">
                        <label class="fs-6 form-label text-dark">استان</label>
                        <input type="text" class="form-control form-control-solid ps-10" name="province" value="{{ request('province') }}" placeholder="نام استان را وارد کنید ..." />
                    </div>
                    <!--end::Col-->
                
                </div>
                <!--end::Row-->
                
            </div>
            <!--end::Advance form-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</form>
<!--end::Form-->