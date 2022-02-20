<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="personal_informaion_link" class="btn btn-link" data-bs-toggle="collapse" href="#personal_informaion" aria-expanded="true">مشخصات فردی</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="personal_informaion">
        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label for="name" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">نام و نام خانوادگی:</span>
                    <i class="fas fa-exclamation-circle ms-2 fs-7" data-bs-toggle="tooltip"  title="نام و نام خانوادگی را وارد کنید ببینیم چی میشود"></i>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ old('name') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="code" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">کد پرسنلی:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="personnel_code" id="personnel_code" class="form-control form-control-solid" placeholder="کد پرسنلی را وارد کنید" value="{{ old('personnel_code') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="phone" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">شماره موبایل:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="phone" id="phone" class="form-control form-control-solid" placeholder="شماره موبایل را وارد کنید" value="{{ old('phone') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->