<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="config_link" class="btn btn-link" data-bs-toggle="collapse" href="#config" aria-expanded="true">پیکربندی</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="config">

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 ">وضعیت رزرو:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="form-check form-switch form-check-custom form-check-solid">
                    <input class="form-check-input" type="checkbox" value="@if(isset($hotel)) {{ $hotel->is_bookable ? 1 : 0 }} @endif" id="bookable" name="bookable" @if(isset($hotel)) @checked($hotel->is_bookable == 1) @endif>
                    <label class="form-check-label fw-bold text-gray-400 ms-3" for="bookable">قابل رزرو</label>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label for="bookable_until" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">قابل رزرو تا:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-2">
                <div class="input-group mb-5">
                    <input type="text" id="bookable_until" name="bookable_until" class="form-control" aria-describedby="addon" style="text-align:center;" value="{{ isset($hotel) ? old('bookable_until', $hotel->bookable_until) : old('bookable_until', 90) }}"/>
                    <span class="input-group-text" id="addon">روز آینده</span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label for="min_bookable" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">حداقل مدت اقامت:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-2">
                <div class="input-group mb-5">
                    <input type="text" id="min_bookable" name="min_bookable" class="form-control" aria-describedby="addon" style="text-align:center;" value="{{ isset($hotel) ? old('min_bookable', $hotel->min_bookable) : old('min_bookable', 1) }}"/>
                    <span class="input-group-text" id="addon">شب</span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4">
                <label for="max_bookable" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">حداکثر مدت اقامت:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-2">
                <div class="input-group mb-5">
                    <input type="text" id="max_bookable" name="max_bookable" class="form-control" aria-describedby="addon" style="text-align:center;" value="{{ isset($hotel) ? old('max_bookable', $hotel->max_bookable) : old('max_bookable', 14) }}"/>
                    <span class="input-group-text" id="addon">شب</span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->