<!--begin::Card-->
<div class="card card-bordered my-5">

    <!--begin::Card header-->
    <div class="card-header">
        <div class="card-title fs-3 fw-bolder">
            <a id="fromTo_link" class="btn btn-link" data-bs-toggle="collapse" href="#fromTo_collapse" aria-expanded="true">تاریخ مشخص</a>
        </div>
    </div>
    <!--end::Card header-->

    <!--begin::Card body-->
    <div class="card-body collapse" id="fromTo_collapse">

        <!--begin::Row-->
        <div class="row mb-8">
            <div class="col-3 d-flex">
                <!--begin::Col-->
                <div class="col-xl-2">
                    <label for="rooms" class="form-label d-flex align-items-center">
                        <span class="fs-6 fw-bold mt-2 mb-3">اتاق:</span>
                    </label>
                </div>
                <!--end::Col-->
                <!--begin::Col-->
                <div class="col-xl-10">
                    <select name="room" class="form-select" data-control="select2" data-hide-search="true" data-placeholder="اتاق را انتخاب کنید" >
                        <option></option>
                        @php
                            if (guard('member')) {
                                $numbers = user('member')->hotel->rooms->flatMap(function($room){
                                    return $room->numbers;
                                })->sort();
                            } else {
                                $numbers = $hotel->rooms->flatMap(function($room){
                                    return $room->numbers;
                                })->sort();
                            }
                        @endphp

                        @foreach ( $numbers as $number )
                            <option value="{{ $number }}" >{{ $number }}</option>
                        @endforeach
                    </select>
                </div>
                <!--end::Col-->
            </div>

            <div class="col-2 d-flex">
                <input type="text" class="form-control date-from" readonly placeholder="از تاریخ ...">
                <input type="hidden" name="date_from" class="date-from-date"/>
            </div>

            <div class="col-2 d-flex align-items-center">
                <input type="text" class="form-control date-to" readonly placeholder="تا تاریخ ...">
                <input type="hidden" name="date_to" class="date-to-date"/>                
            </div>

            <div class="col-1">
                <a href="#" onclick="document.getElementById('fromTo').submit();" class="btn btn-primary">ثبت</a>
            </div>
        </div>
        <!--end::Row-->


    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->