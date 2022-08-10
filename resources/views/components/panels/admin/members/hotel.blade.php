<!--begin::Card-->
<div class="card card-bordered my-5">

<!--begin::Card header-->
<div class="card-header">
    <div class="card-title fs-3 fw-bolder">
        <a id="hotel_link" class="btn btn-link" data-bs-toggle="collapse" href="#hotel" aria-expanded="true">هتل</a>
    </div>
</div>
<!--end::Card header-->

<!--begin::Card body-->
<div class="card-body collapse show" id="hotel">
    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-4">
            <label for="hotel" class="form-label d-flex align-items-center">
                <span class="fs-6 fw-bold mt-2 mb-3">هتل:</span>
            </label>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-8">
            <select name="hotel" class="form-select" data-control="select2" data-placeholder="هتل را انتخاب کنید" >
                <option></option>
                @foreach ( $hotels as $hotel )
                    <option value="{{ $hotel->id }}" @if(isset($member)) @selected($hotel->id == $member->hotel_id) @endif>{{ $hotel->name }}</option>
                @endforeach
            </select>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

</div>
<!--end::Card body-->
</div>
<!--end::Card-->
