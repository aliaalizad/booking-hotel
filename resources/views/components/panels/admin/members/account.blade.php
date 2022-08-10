<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="account_link" class="btn btn-link" data-bs-toggle="collapse" href="#account" aria-expanded="true">حساب کاربری</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="account">
    
        @if(isset($member))
            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Header-->
                <div class="py-3 d-flex flex-stack flex-wrap">
                    <!--begin::Toggle-->
                    <div class="d-flex align-items-center collapsible toggle collapsed" data-bs-toggle="collapse" data-bs-target="#change_password" aria-expanded="false">
                        <!--begin::Arrow-->
                        <div class="btn btn-sm btn-icon btn-active-color-primary ms-n3 me-2">
                            <!--begin::Svg Icon | path: icons/duotone/Interface/Minus-Square.svg-->
                            <span class="svg-icon toggle-on svg-icon-primary svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.25" d="M6.54184 2.36899C4.34504 2.65912 2.65912 4.34504 2.36899 6.54184C2.16953 8.05208 2 9.94127 2 12C2 14.0587 2.16953 15.9479 2.36899 17.4582C2.65912 19.655 4.34504 21.3409 6.54184 21.631C8.05208 21.8305 9.94127 22 12 22C14.0587 22 15.9479 21.8305 17.4582 21.631C19.655 21.3409 21.3409 19.655 21.631 17.4582C21.8305 15.9479 22 14.0587 22 12C22 9.94127 21.8305 8.05208 21.631 6.54184C21.3409 4.34504 19.655 2.65912 17.4582 2.36899C15.9479 2.16953 14.0587 2 12 2C9.94127 2 8.05208 2.16953 6.54184 2.36899Z" fill="#12131A"></path>
                                    <path d="M8 13C7.44772 13 7 12.5523 7 12C7 11.4477 7.44772 11 8 11H16C16.5523 11 17 11.4477 17 12C17 12.5523 16.5523 13 16 13H8Z" fill="#12131A"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                            <!--begin::Svg Icon | path: icons/duotone/Interface/Plus-Square.svg-->
                            <span class="svg-icon toggle-off svg-icon-2">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path opacity="0.25" fill-rule="evenodd" clip-rule="evenodd" d="M6.54184 2.36899C4.34504 2.65912 2.65912 4.34504 2.36899 6.54184C2.16953 8.05208 2 9.94127 2 12C2 14.0587 2.16953 15.9479 2.36899 17.4582C2.65912 19.655 4.34504 21.3409 6.54184 21.631C8.05208 21.8305 9.94127 22 12 22C14.0587 22 15.9479 21.8305 17.4582 21.631C19.655 21.3409 21.3409 19.655 21.631 17.4582C21.8305 15.9479 22 14.0587 22 12C22 9.94127 21.8305 8.05208 21.631 6.54184C21.3409 4.34504 19.655 2.65912 17.4582 2.36899C15.9479 2.16953 14.0587 2 12 2C9.94127 2 8.05208 2.16953 6.54184 2.36899Z" fill="#12131A"></path>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M12 17C12.5523 17 13 16.5523 13 16V13H16C16.5523 13 17 12.5523 17 12C17 11.4477 16.5523 11 16 11H13V8C13 7.44772 12.5523 7 12 7C11.4477 7 11 7.44772 11 8V11H8C7.44772 11 7 11.4477 7 12C7 12.5523 7.44771 13 8 13H11V16C11 16.5523 11.4477 17 12 17Z" fill="#12131A"></path>
                                </svg>
                            </span>
                            <!--end::Svg Icon-->
                        </div>
                        <!--end::Arrow-->

                        <div class="me-3">
                            <a class="btn btn-link btn-color-primary" aria-expanded="true">تغییر رمز عبور</a>
                        </div>

                    </div>
                    <!--end::Toggle-->

                </div>
                <!--end::Header-->

                <!--begin::Body-->
                <div id="change_password" class="fs-6 ps-10 collapse" >
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-4 ">
                            <label for="password" class="form-label d-flex align-items-center">
                                <span class="fs-6 fw-bold mt-2 mb-3">رمز عبور جدید:</span>
                            </label>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8">
                            <input type="password" id="password" name="password" class="form-control" placeholder="رمز عبور جدید را وارد کنید"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-4 ">
                            <label for="password_confirmation" class="form-label d-flex align-items-center">
                                <span class="fs-6 fw-bold mt-2 mb-3">تکرار رمز عبور جدید:</span>
                            </label>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8">
                            <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="تکرار رمز عبور جدید را وارد کنید"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                </div>
                <!--end::Body-->
            </div>
            <!--end::Row-->
        @else
            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-4 ">
                    <label for="password" class="form-label d-flex align-items-center">
                        <span class="fs-6 fw-bold mt-2 mb-3">رمز عبور:</span>
                    </label>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <input type="password" id="password" name="password" class="form-control" placeholder="رمز عبور را وارد کنید"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row mb-8">
                <!--begin::Col-->
                <div class="col-xl-4 ">
                    <label for="password_confirmation" class="form-label d-flex align-items-center">
                        <span class="fs-6 fw-bold mt-2 mb-3">تکرار رمز عبور:</span>
                    </label>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-8">
                    <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" placeholder="تکرار رمز عبور را وارد کنید"/>
                </div>
                <!--end::Col-->
            </div>
            <!--end::Row-->
        @endif
        
        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">وضعیت حساب کاربری:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="@if(isset($member)) {{ $member->is_blocked ? 0 : 1 }} @else {{ 0 }} @endif" id="status" name="status" @if(isset($member)) @checked($member->is_blocked == 0) @endif>
                    <label class="form-check-label fw-bold text-gray-400 ms-3" for="status">فعال</label>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->




