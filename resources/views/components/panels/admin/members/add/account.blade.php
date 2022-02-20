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
        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="password" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">رمز عبور:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="password" id="password" name="password" class="form-control form-control-solid" placeholder="رمز عبور را وارد کنید"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="password_confirmation" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">تکرار رمز عبور:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control form-control-solid" placeholder="تکرار رمز عبور را وارد کنید"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 ">وضعیت حساب کاربری:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="1" id="status" name="status" checked="checked">
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