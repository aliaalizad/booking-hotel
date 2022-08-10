<div class="row g-5 g-xl-8 mt-3">
    <div class="col-xl-12">
        <!--begin::Mixed Widget 13-->
        <div class="card card-xl-stretch mb-xl-8 bg-white">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">جمع کل درآمد</a>
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0">{{ number_format($total_income) }}</span>
                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-600 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->
                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>
</div>

<div class="row g-5 g-xl-8">
    <div class="col-xl-4">
        <!--begin::Mixed Widget 13-->
        <div class="card card-xl-stretch mb-xl-8 bg-white">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">درآمد ماه فعلی</a>
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0">{{ number_format($this_month_income) }}</span>
                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-600 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->
                    <span class="@if($monthly_income_change_percentage >= 0) {{ 'text-success' }} @else {{ 'text-danger' }} @endif fw-bolder fs-3 lh-0 mx-4">@if(is_null($monthly_income_change_percentage)) {{ '' }} @else {{ '(' . abs($monthly_income_change_percentage) . '%)' }} @endif</span>

                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>

    <div class="col-xl-4">
        <!--begin::Mixed Widget 13-->
        <div class="card card-xl-stretch mb-xl-8 bg-white">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">درآمد هفته فعلی</a>
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0">{{ number_format($this_week_income) }}</span>
                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-600 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->
                    <span class="@if($weekly_income_change_percentage >= 0) {{ 'text-success' }} @else {{ 'text-danger' }} @endif fw-bolder fs-3 lh-0 mx-4">@if(is_null($weekly_income_change_percentage)) {{ '' }} @else {{ '(' . abs($weekly_income_change_percentage) . '%)' }} @endif</span>

                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>

    <div class="col-xl-4">
        <!--begin::Mixed Widget 13-->
        <div class="card card-xl-stretch mb-xl-8 bg-white">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">درآمد امروز</a>
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0">{{ number_format($today_income) }}</span>
                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-600 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->
                    <span class="@if($daily_income_change_percentage >= 0) {{ 'text-success' }} @else {{ 'text-danger' }} @endif fw-bolder fs-3 lh-0 mx-4">@if(is_null($daily_income_change_percentage)) {{ '' }} @else {{ '(' . abs($daily_income_change_percentage) . '%)' }} @endif</span>

                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>
</div>

<div style="height:100px"></div>

<div class="row g-5 g-xl-8">

    <div class="col-xl-6">
        <!--begin::Mixed Widget 13-->
        <div class="card card-xl-stretch mb-xl-8 bg-white">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">میانگین درآمد روزانه
                    </a>
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0">{{ number_format($avg_daily_income) }}</span>
                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-600 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->

                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>

    <div class="col-xl-6">
        <!--begin::Mixed Widget 13-->
        <div class="card card-xl-stretch mb-xl-8 bg-white">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">پر درآمدترین روز
                        <span class="text-gray-700 fw-bolder fs-3 lh-0 mx-4">( @if(!is_null($max_daily_income)) {{ $max_daily_income['date'] }} @else {{ '-' }} @endif )</span>
                    </a>
                    
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0"> @if(!is_null($max_daily_income)) {{ number_format($max_daily_income['amount']) }} @else {{ 0 }} @endif </span>
                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-700 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->

                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>

</div>

<div class="row g-5 g-xl-8">

    <div class="col-xl-6">
        <!--begin::Mixed Widget 13-->
        <div class="card mb-xl-8 bg-white bgi-no-repeat card-xl-stretch">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">میانگین درآمد ماهانه
                    </a>
                    
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0">{{ number_format($avg_monthly_income) }}</span>
                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-600 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->

                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>

    <div class="col-xl-6">
        <!--begin::Mixed Widget 13-->
        <div class="card card-xl-stretch mb-xl-8 bg-white">
            <!--begin::Body-->
            <div class="card-body d-flex flex-column">
                <!--begin::Wrapper-->
                <div class="d-flex flex-column flex-grow-1 mb-10">
                    <!--begin::Title-->
                    <a href="#" class="text-dark text-hover-primary fw-bolder fs-3">پر درآمدترین ماه
                        <span class="text-gray-700 fw-bolder fs-3 lh-0 mx-4">( @if(!is_null($max_monthly_income)) {{ verta()->parse($max_monthly_income['date'].'/01')->format("%B %Y") }} @else {{ '-' }} @endif )</span>                    </a>
                    
                    <!--end::Title-->
                </div>
                <!--end::Wrapper-->
                <!--begin::Stats-->
                <div class="pt-5">
                    <!--begin::Number-->
                    <span class="text-dark fw-bolder fs-3x me-2 lh-0"> @if(!is_null($max_monthly_income)) {{ number_format($max_monthly_income['amount']) }} @else {{ 0 }} @endif </span>

                    <!--end::Number-->
                    <!--begin::Symbol-->
                    <span class="text-gray-600 fw-bolder fs-2x lh-0">ریال</span>
                    <!--end::Symbol-->

                </div>
                <!--end::Stats-->
            </div>
            <!--end::Body-->
        </div>
        <!--end::Mixed Widget 13-->
    </div>

    
</div>
