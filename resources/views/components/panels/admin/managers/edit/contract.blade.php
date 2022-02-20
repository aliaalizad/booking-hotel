<!--begin::Card-->
<div class="card card-bordered my-5">

<!--begin::Card header-->
<div class="card-header">
    <div class="card-title fs-3 fw-bolder">
        <a id="contract_link" class="btn btn-link" data-bs-toggle="collapse" href="#contract" aria-expanded="true">قرارداد</a>
    </div>
</div>
<!--end::Card header-->

<!--begin::Card body-->
<div class="card-body collapse show" id="contract">
    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-4">
            <label for="hotel" class="form-label d-flex align-items-center">
                <span class="fs-6 fw-bold mt-2 mb-3 required">قرارداد:</span>
            </label>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-8">
            <select name="contract" class="form-select form-select-solid" data-control="select2" data-placeholder="قرارداد را انتخاب کنید" >
                @foreach ( App\Models\Contract::all() as $contract )
                    <option value="{{ $contract->id }}" @selected($contract->id == $manager->contract_id)>{{ $contract->name }}</option>
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
