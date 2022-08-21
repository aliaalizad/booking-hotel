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
                <label for="title" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">عنوان:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" id="title" name="title" class="form-control" placeholder="عنوان اتاق را وارد کنید"  value="{{ isset($room) ? old('title', $room->name) : old('title') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
         <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="capacity" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">ظرفیت:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-2">
                <!--begin::Dialer-->
                <div class="input-group"
                    data-kt-dialer="true"
                    data-kt-dialer-min="1"
                    data-kt-dialer-max="100"
                    data-kt-dialer-step="1">

                    <!--begin::Decrease control-->
                    <button class="btn btn-icon btn-outline btn-outline-secondary" type="button" data-kt-dialer-control="decrease">
                        <i class="bi bi-dash fs-1"></i>
                    </button>
                    <!--end::Decrease control-->

                    <!--begin::Input control-->
                    <input type="text" id="capacity" name="capacity" class="form-control text-center p-0" readonly placeholder="ظرفیت"  value="{{ isset($room) ? old('capacity', $room->capacity) : old('capacity', 1) }}" data-kt-dialer-control="input"/>
                    <!--end::Input control-->

                    <!--begin::Increase control-->
                    <button class="btn btn-icon btn-outline btn-outline-secondary" type="button" data-kt-dialer-control="increase">
                        <i class="bi bi-plus fs-1"></i>
                    </button>
                    <!--end::Increase control-->
                </div>
                <!--end::Dialer-->
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="rooms" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">اتاق ها:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input name="rooms" class="form-control form-control-lg form-control" placeholder="شماره اتاق ها را وارد کنید (با زدن دکمه Enter مورد جدید اضافه کنید)" value="@if(isset($room)) {{ old('', implode(',' ,$room->numbers)) }} @elseif(!is_null(old('rooms'))) {{ implode(',' ,old('rooms'))}} @endif" id="tagify"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="price" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">قیمت (1 شب):</span>
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

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">وضعیت رزرو:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="@if(isset($room)) {{ $room->is_bookable ? 1 : 0 }} @else {{ 0 }} @endif" id="bookable" name="bookable" @if(isset($room)) @checked($room->is_bookable == 1) @endif>
                    <label class="form-check-label fw-bold text-gray-400 ms-3" for="bookable">قابل رزرو</label>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->