<!--begin::Card-->
<div class="card card-bordered my-5">

<!--begin::Card header-->
<div class="card-header">
    <div class="card-title fs-3 fw-bolder">
        <a id="manager_link" class="btn btn-link" data-bs-toggle="collapse" href="#manager" aria-expanded="true">مدیر</a>
    </div>
</div>
<!--end::Card header-->

<!--begin::Card body-->
<div class="card-body collapse show" id="manager">
    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-4">
            <label for="hotel" class="form-label d-flex align-items-center">
                <span class="fs-6 fw-bold mt-2 mb-3">مدیر:</span>
            </label>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-8">
            <select name="manager" class="form-select" data-control="select2" @if(isset($hotel)) {{ 'disabled' }} @endif data-placeholder="مدیر را انتخاب کنید" >
                <option></option>
                @foreach ( App\Models\Manager::all() as $manager )
                    <option value="{{ $manager->id }}" @if(isset($hotel)) @selected($hotel->manager_id == $manager->id) @endif>{{ $manager->name }}</option>
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
