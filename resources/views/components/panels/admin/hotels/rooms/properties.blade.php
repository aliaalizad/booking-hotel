<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="properties_link" class="btn btn-link" data-bs-toggle="collapse" href="#properties_collapse" aria-expanded="true">امکانات و ویژگی ها</a>
        </div>

        <div class="card-toolbar">
            <a id="propertiesAddRow" class="btn btn-sm btn-primary">افزودن</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="properties_collapse">
        
        <!--begin::Row-->
        <div id="properties" class="mb-8">

            @if(isset($room) && isset($room->properties))
                @foreach($room->properties as $property)
                    <div class="row mt-2">
                        <div class="col-xl-11">
                            <div class="input-group mb-5">
                                <input type="text" name="properties[]" class="form-control" value="{{ $property }}" />
                            </div>
                        </div>
                        <div class="col-xl-1">
                            <a class="btn btn-sm btn-danger propertiesRemoveRow">حذف</a>
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