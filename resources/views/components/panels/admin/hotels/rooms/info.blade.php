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
            <div class="col-xl-4 ">
                <label for="name" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">نام:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" id="name" name="name" class="form-control" placeholder="نام اتاق را وارد کنید"  value="{{ isset($room) ? old('name', $room->name) : old('name') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
         <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="capacity" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">ظرفیت:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" id="capacity" name="capacity" class="form-control" placeholder="ظرفیت اتاق را وارد کنید"  value="{{ isset($room) ? old('capacity', $room->capacity) : old('capacity') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->


        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="rooms" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">اتاق ها:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input name="rooms" class="form-control form-control-lg form-control" placeholder="شماره اتاق ها را وارد کنید" value="{{ isset($room) ? old('', implode(',' ,$room->numbers)) : old('rooms') }}" id="tagify"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="price" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">قیمت (1 شب):</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="input-group mb-5">
                    <input type="text" id="price" name="price" class="form-control" placeholder="قیمت اتاق را وارد کنید" aria-describedby="addon" dir="ltr" value="{{ isset($room) ? old('price', $room->price) : old('price') }}" />
                    <span class="input-group-text" id="addon">ریال</span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->