<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="rules_link" class="btn btn-link" data-bs-toggle="collapse" href="#rules_collapse" aria-expanded="true">شرایط و قوانین</a>
        </div>

        <div class="card-toolbar">
            <a id="rulesAddRow" class="btn btn-sm btn-primary">افزودن</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="rules_collapse">
        
        <!--begin::Row-->
        <div id="rules" class="mb-8">

            @if(isset($hotel) && isset($hotel->rules))
                @foreach($hotel->rules as $rule)
                    <div class="row mt-2">
                        <div class="col-xl-11">
                            <div class="input-group mb-5">
                                <textarea type="text" name="rules[]" class="form-control">{{ $rule }}</textarea>
                            </div>
                        </div>
                        <div class="col-xl-1">
                            <a class="btn btn-sm btn-danger rulesRemoveRow">حذف</a>
                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <!--end::Row-->

    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->