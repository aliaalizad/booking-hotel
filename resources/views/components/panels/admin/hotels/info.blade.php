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
            <div class="col-xl-4">
                <label for="name" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3  required">نام:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="name" id="name" class="form-control" placeholder="نام را وارد کنید" value="{{ isset($hotel) ? old('name', $hotel->name) : old('name') }}"/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="phone" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">شماره تلفن:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <input type="text" name="phone" id="phone" class="form-control" placeholder="شماره تلفن را وارد کنید" value="{{ isset($hotel) ? old('phone', $hotel->phone) : old('phone') }}""/>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->

        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="city" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">شهرستان:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <select class="form-select" name="city" id="city" data-control="select2" @if(isset($hotel)) {{ 'disabled' }} @endif  data-placeholder="شهرستان را انتخاب کنید">
                    <option></option>
                    <optgroup>
                        @php
                            if (guard('admin')) {
                                $cities = App\Models\City::all();
                            } elseif (guard('manager')) {
                                $cities = App\Models\City::where('state_id', user('manager')->city->state->id)->get();
                            }
                        @endphp
                        @foreach($cities as $city)
                            <option value="{{ $city->id }}" @if(isset($hotel)) @selected($hotel->city_id == $city->id) @endif>{{ $city->name }}</option>
                        @endforeach
                    </optgroup>
                </select>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
        
        <!--begin::Row-->
        <div class="row mb-8">
            <!--begin::Col-->
            <div class="col-xl-4 ">
                <label for="address" class="form-label d-flex align-items-center">
                    <span class="fs-6 fw-bold mt-2 mb-3 required">آدرس:</span>
                </label>
            </div>
            <!--end::Col-->
            <!--begin::Col-->
            <div class="col-xl-8">
                <textarea class="form-control" name="address" id="address" cols="30" rows="3" placeholder="آدرس را وارد کنید">{{ isset($hotel) ? old('address', $hotel->address) : old('address') }}</textarea>
            </div>
            <!--end::Col-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</div>
<!--end::Card-->