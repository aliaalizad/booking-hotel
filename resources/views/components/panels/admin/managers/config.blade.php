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
            <div class="col-xl-4 ">
                <label for="bank_account" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">شماره شبا:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <div class="input-group mb-5">
                    <input type="text" id="bank_account" name="bank_account" class="form-control" placeholder="شماره شبا را وارد کنید" aria-describedby="addon" dir="ltr" value="{{ isset($manager) ? old('bank_account', $manager->bank_account) : old('bank_account') }}"/>
                    <span class="input-group-text" id="addon">IR</span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="commission" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3">کارمزد:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-3">
                <div class="input-group mb-5">
                    <input type="text" id="commission" name="commission" class="form-control" placeholder="درصد را وارد کنید" aria-describedby="addon" style="text-align:center;" value="{{ isset($manager) ? old('commission', $manager->commission) : old('commission') }}" />
                    <span class="input-group-text" id="addon">%</span>
                </div>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->