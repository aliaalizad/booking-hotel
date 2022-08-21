<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="map_collapse_link" class="btn btn-link" data-bs-toggle="collapse" href="#map_collapse" aria-expanded="true">نقشه</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse show" id="map_collapse">
        <div class="row">
            <p>لوکیشن هتل را روی نقشه انتخاب کنید</p>
        </div>
        <!--begin::Row-->
        <div class="row mw-100 mh-100 mb-8">
            <div id="map">
            </div>
    
            <input type="hidden" name="longitude" id="longitude">
            <input type="hidden" name="latitude" id="latitude">
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->