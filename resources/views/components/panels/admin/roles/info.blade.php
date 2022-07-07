<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="info_link" class="btn btn-link" data-bs-toggle="collapse" href="#info" aria-expanded="true">مشخصات</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="info">
        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label for="name" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">عنوان:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="name" id="name" class="form-control" placeholder="عنوان را وارد کنید" value="{{ isset($role) ? old('name', $role->name) : old('name') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label for="label" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">شرح:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="label" id="label" class="form-control" placeholder="شرح را وارد کنید" value="{{ isset($role) ? old('label', $role->label) : old('label') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->


        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="guard" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">پنل:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <select class="form-select" name="guard" id="guard" data-control="select2" data-hide-search="true"  data-placeholder="پنل را انتخاب کنید">
                    <option></option>    
                    <option value="admin" @if(isset($role)) @selected($role->guard == 'admin') @endif >مدیریت وبسایت</option>
                    <option value="manager" @if(isset($role)) @selected($role->guard == 'manager') @endif>مدیریت مراکز</option>
                    <option value="member" @if(isset($role)) @selected($role->guard == 'member') @endif>مسئول پذیرش</option>
                </select>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->