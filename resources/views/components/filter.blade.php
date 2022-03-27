<!--begin::Card-->
<div class="card">
<form action="{{ route('search') }}" id="filter_form">
    <div class="card-header">
        <span class="card-title" style="font-size: 14px;">
            <span class="me-1 text-gray-600">نتایج:</span>
            <span>12</span>
        </span>
    </div>

    <!-- name -->
    <div>
        <div class="card-body py-5">
            <div class="d-flex align-items-start justify-content-start position-relative ps-0" >
                <a href="#name" data-bs-toggle="collapse">
                    <span>
                        <span>
                            <span class="text-gray-800 d-b" style="font-size: 16px;">جستجوی نام مرکز</span>
                        </span>
                    </span>
                </a>
            </div>
            <div class="collapse show" id="name">
                <!--begin::Row-->
                <div class="row my-6">
                    <div class="card">
                        <div class="input-group">
                            <span class="input-group-text">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                                <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                                </svg>
                            </span>
                            
                            <input type="text" name="hotel_name" class="form-control" placeholder="جستجوی نام مرکز" value="{{ request('hotel_name') }}">
                        </div>
                    </div>
                </div>
                <!--end::Row-->
            </div>
        </div>

        <div class="separator"></div>
    </div>

    <!-- price -->
    <div>
        <div class="card-body py-5">
            <div class="d-flex align-items-start justify-content-start position-relative ps-0" >
                <a href="#price" data-bs-toggle="collapse">
                    <span>
                        <span>
                            <span class="text-gray-800" style="font-size: 16px;">رنج قیمتی</span>
                            <span class="text-gray-400" style="font-size: 12px;">(هزار تومان)</span>
                        </span>
                    </span>
                </a>
            </div>
            <div class="collapse show" id="price">
                <!--begin::Row-->
                <div class="row my-6">
                <div class="card">
                        <div id="price_range" class="mt-10"></div>
                        <div id="price_range_drawer" class="mt-10"></div>
                    </div>
                    <input type="hidden" name="min_price" id="min_price">
                    <input type="hidden" name="max_price" id="max_price">
                </div>
                <!--end::Row-->
            </div>
        </div>

        <div class="separator"></div>
    </div>

    <!-- button -->
    <div>
        <div class="card-body py-5">
            <div class="d-flex row align-items-center justify-content-center position-relative" >
                <a onclick="document.getElementById('filter_form').submit()" class="btn btn-warning text-dark">اعمال فیلتر</a>
            </div>
        </div>
    </div>

</form>
</div>
<!--end::Card-->