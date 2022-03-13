<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="informaion_link" class="btn btn-link" data-bs-toggle="collapse" href="#informaion" aria-expanded="true">مشخصات</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="informaion">
        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label for="name" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">نام:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="name" id="name" class="form-control form-control-solid" placeholder="نام را وارد کنید" value="{{ old('name') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="fee" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">کارمزد:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="fee" id="fee" class="form-control form-control-solid" placeholder="کارمزد را وارد کنید" value="{{ old('fee') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->