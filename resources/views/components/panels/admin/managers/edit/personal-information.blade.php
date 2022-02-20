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
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ old('name', $manager->name) }}"/>
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
                <input type="text" name="phone" id="phone" class="form-control form-control-solid" placeholder="شماره موبایل را وارد کنید" value="{{ old('phone', $manager->phone) }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="email" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">ایمیل:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="email" id="email" class="form-control form-control-solid" placeholder="ایمیل را وارد کنید" value="{{ old('email', $manager->email) }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="province" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">استان:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="province" id="province" class="form-control form-control-solid" placeholder="استان را وارد کنید" value="{{ old('province', $manager->province) }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->