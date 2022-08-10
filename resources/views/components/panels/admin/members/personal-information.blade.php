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
                    <span class="fs-6 fw-bold mt-2 mb-3">نام و نام خانوادگی:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="name" id="name" class="form-control " placeholder="نام و نام خانوادگی را وارد کنید" value="{{ isset($member) ? old('name', $member->name) : old('name') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="code" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">نام کاربری:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="username" id="username" class="form-control " placeholder="نام کاربری را وارد کنید" value="{{ isset($member) ? old('username', $member->username) : old('username') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="mobile" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">شماره موبایل:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="mobile" id="mobile" class="form-control " placeholder="شماره موبایل را وارد کنید" value="{{ isset($member) ? old('phone', $member->phone) : old('phone') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->