<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="personal_informaion_link" class="btn btn-link" data-bs-toggle="collapse" href="#personal_informaion" aria-expanded="true">مشخصات</a>
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
                <input type="text" name="name" id="name" class="form-control" placeholder="نام و نام خانوادگی را وارد کنید" value="{{ isset($manager) ? old('name', $manager->name) : old('name') }}"/>
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
                <input type="text" id="mobile" name="mobile" class="form-control" placeholder="شماره موبایل را وارد کنید" value="{{ isset($manager) ? old('phone', $manager->phone) : old('phone') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="email" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">ایمیل:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="email" id="email" class="form-control" placeholder="ایمیل را وارد کنید" value="{{ isset($manager) ? old('email', $manager->email) : old('email') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="city" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">شهرستان:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <select class="form-select" name="city" id="city" data-control="select2" @if(isset($manager)) {{ 'disabled' }} @endif data-placeholder="شهرستان را انتخاب کنید">
                    <option></option>
                    <optgroup>
                        @foreach(App\Models\City::all() as $city)
                            <option value="{{ $city->id }}" @if(isset($manager)) @selected($manager->city_id == $city->id) @endif>{{ $city->name }}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->