@extends('layouts.app.master')

@section('title', 'جستجوی مراکز')


@push('styles')
    <!-- serchForm Styles -->
    <style>
        :root {
        --color-white: #ffffff;
        --color-light: #f8fafc;
        --color-black: #121212;
        --color-night: #001632;
        --color-blue: #1a73e8;
        --color-gray: #80868b;
        --color-grayish: #dadce0;
        --shadow-normal: 0 1px 3px 0 rgba(0, 0, 0, 0.1),
            0 1px 2px 0 rgba(0, 0, 0, 0.06);
        --shadow-medium: 0 4px 6px -1px rgba(0, 0, 0, 0.1),
            0 2px 4px -1px rgba(0, 0, 0, 0.06);
        --shadow-large: 0 10px 15px -3px rgba(0, 0, 0, 0.1),
            0 4px 6px -2px rgba(0, 0, 0, 0.05);
        }
        
        .form .input-control {
        position: relative;
        width: 100%;
        height: 3rem;
        margin-bottom: 1.25rem;
        }
        .form .input-label {
        position: absolute;
        font-family: inherit;
        font-size: 1rem;
        font-weight: 400;
        line-height: inherit;
        right: 1rem;
        top: 0.75rem;
        padding: 0 0.25rem;
        color: var(--color-gray);
        background: var(--color-white);
        transition: all 0.3s ease;
        }
        .form .input-field {
        position: absolute;
        font-family: inherit;
        font-size: 1rem;
        font-weight: 400;
        line-height: inherit;
        top: 0;
        right: 0;
        width: 100%;
        height: auto;
        padding: 0.75rem 1.25rem;
        z-index: 1;
        border: 2px solid var(--color-grayish);
        outline: none;
        border-radius: 0.5rem;
        color: var(--color-black);
        background: transparent;
        transition: all 0.3s ease;
        }
        .form .input-field::-moz-placeholder {
        opacity: 0;
        visibility: hidden;
        color: transparent;
        }
        .form .input-field:-ms-input-placeholder {
        opacity: 0;
        visibility: hidden;
        color: transparent;
        }
        .form .input-field::placeholder {
        opacity: 0;
        visibility: hidden;
        color: transparent;
        }
        .form .input-field:focus {
        border: 2px solid var(--color-blue);
        }
        .form .input-field:focus + .input-label {
        font-size: 0.9rem;
        font-weight: 500;
        top: -0.75rem;
        right: 1rem;
        z-index: 5;
        color: var(--color-blue);
        }
        .form .input-field:not(:-moz-placeholder-shown).input-field:not(:focus) + .input-label {
        font-size: 0.9rem;
        font-weight: 500;
        top: -0.75rem;
        right: 1rem;
        z-index: 5;
        }
        .form .input-field:not(:-ms-input-placeholder).input-field:not(:focus) + .input-label {
        font-size: 0.9rem;
        font-weight: 500;
        top: -0.75rem;
        right: 1rem;
        z-index: 5;
        }
        .form .input-field:not(:placeholder-shown).input-field:not(:focus) + .input-label {
        font-size: 0.9rem;
        font-weight: 500;
        top: -0.75rem;
        right: 1rem;
        z-index: 5;
        }
        .form .input-submit {
        font-family: inherit;
        font-size: 1rem;
        font-weight: 500;
        line-height: inherit;
        cursor: pointer;
        width: 100%;
        height: auto;
        padding: 0.75rem 1.25rem;
        margin-top: 1rem;
        border: none;
        outline: none;
        border-radius: 0.25rem;
        color: var(--color-white);
        background: var(--color-blue);
        box-shadow: var(--shadow-medium);
        text-transform: capitalize;
        }
    </style>

    <!-- datepicker styles -->
    <link href="/plugins/global/persian-datepicker.css" rel="stylesheet">

@endpush

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container">
                <div class="row" style="margin-bottom: 50px">
                    <x-searchForm-collapse />
                </div>

                <div class="row d-block d-lg-none">
                    <!--begin::Filter Trigger button-->
                    <button id="filter_button" class="btn btn-primary btn-sm">فیلتر</button>
                    <!--end::Filter Trigger button-->

                    <div id="filter" class="bg-white drawer drawer-start" data-kt-drawer="true" data-kt-drawer-activate="true" data-kt-drawer-toggle="#filter_button" data-kt-drawer-close="#filter_button_close" data-kt-drawer-name="docs" data-kt-drawer-overlay="true" data-kt-drawer-width="{default:'300px', 'md': '500px'}" data-kt-drawer-direction="start" style="width: 500px !important;">
                        <!--begin::Card-->
                        <div class="card rounded-0 w-100">
                            <!--begin::Card header-->
                            <div class="card-header pe-5 justify-content-start">
                                <!--begin::Card toolbar-->
                                <div class="card-toolbar">
                                    <!--begin::Close-->
                                    <div class="btn btn-sm btn-icon btn-active-light-primary" id="filter_button_close">
                                        <!--begin::Svg Icon -->
                                        <span class="svg-icon svg-icon-2">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-right" viewBox="0 0 16 16">
                                            <path fill-rule="evenodd" d="M1 8a.5.5 0 0 1 .5-.5h11.793l-3.147-3.146a.5.5 0 0 1 .708-.708l4 4a.5.5 0 0 1 0 .708l-4 4a.5.5 0 0 1-.708-.708L13.293 8.5H1.5A.5.5 0 0 1 1 8z"/>
                                            </svg>
                                        </span>
                                        <!--end::Svg Icon-->
                                    </div>
                                    <!--end::Close-->
                                </div>
                                <!--end::Card toolbar-->
                                <!--begin::Title-->
                                <div class="card-title">
                                    <!--begin::User-->
                                    <div class="d-flex justify-content-start flex-column me-3">
                                        <a href="#" class="fs-4 text-gray-900 text-hover-primary me-1 lh-1">فیلترها</a>
                                    </div>
                                    <!--end::User-->
                                </div>
                                <!--end::Title-->
                                
                            </div>
                            <!--end::Card header-->
                            <!--begin::Card body-->
                            <div class="card-body hover-scroll-overlay-y p-0">
                            </div>
                            <!--end::Card body-->
                        </div>
                        <!--end::Card-->
                    </div>

                </div>

                <div class="row">
                    <div class="col-lg-3 d-none d-lg-block">
                        <div class="card mb-0">
                            <x-filter />
                        </div>
                    </div>

                    <div class="col-lg-9 p-0">
                    
                    @foreach(range(1,10) as $item)

                        <div class="card mb-7 mx-3 shadow-sm">
                            <div class="row g-0">
                                <!-- image -->
                                <div class="col-md-3 d-none d-md-block ">
                                    <a href="#"><img src="/media/hotel/blank.png" class="img-fluid rounded-start " style="width: 239.9px; height: 167.75px; object-fit: cover; object-position: 50% 50%;" alt="..."></a>
                                </div>
                                <!-- details -->
                                <div class="col-md-6 ">
                                    <a href="#">
                                        <div class="card-body pb-0">
                                            <h3 class="card-title">مركز تكريم فرهنگيان</h3>
                                            <p class="card-text text-muted  "> تبریز ، چهارراه منصور ، خیابان شهید بهشتی ، جنب پل منصور</p>
                                            <p class="card-text text-muted  ">041-35237013</p>
                                            <!-- <p class="card-text text-muted">041-35237013</p> -->
                                        </div>
                                    </a>
                                </div>
                                <!-- price -->
                                <div class="col-md-3">

                                    <div class="card-body row align-items-center text-center border border-secondary border-top-0 border-bottom-0 border-right-0 d-none d-md-block">
                                        <div class="mb-4">
                                            <span>
                                                <strong class="h1 text-primary">1,500,000</strong>
                                                <small class="text-muted">ريال</small>
                                            </span>
                                        </div>

                                        <a href="#" class="btn btn-primary ">مشاهده اتاق ها و رزرو</a>

                                        <div class="mt-4">
                                            <span>
                                                <small class="text-muted">قیمت برای</small>
                                                <small class="text-muted">1</small>
                                                <small class="text-muted">شب</small>
                                            </span>
                                        </div>
                                    </div>

                                    <a href="#">
                                        <div class="card-body row align-items-end text-end d-block d-md-none pb-0" >
                                            <div class="mb-4">
                                                <div class="separator my-3 "></div>
                                                <span>
                                                    <small class="text-muted">1</small>
                                                    <small class="text-muted me-2">شب</small>
                                                    <strong class="h1 text-primary">1,500,000</strong>
                                                    <small class="text-muted">ريال</small>
                                                </span>
                                            </div>
                                        </div>
                                    </a>

                                </div>  
                            </div>
                        </div>
                    @endforeach

                    </div>

                </div>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

@endsection



@push('scripts')
    <script src="/plugins/global/persian-datepicker.js"></script>

    <!-- searchForm scripts -->
    <script>
        $(document).ready(function(){
            $('.dialer-button').click(function(){
            var adults = $('#adults').val();
            var children = $('#children').val();
            var passengers = +adults + +children;
                $('#passengers').val(passengers);
            });
        });
    </script>

    <!-- price filter scripts -->
    <script>

        var slider = document.querySelector("#price_range");
            
        var valueMin = document.querySelector("#min_price");
        var valueMax = document.querySelector("#max_price");

        noUiSlider.create(slider, {
            start: [{{ request('min_price') ?? 150 }}, {{ request('max_price') ?? 325 }} ],
            connect: true,
            range: {
                "min": 150,
                "max": 325
            },
            tooltips: [wNumb({decimals: 0}), wNumb({decimals: 0})],
        });
        
        slider.noUiSlider.on("update", function (values, handle) {
        if (handle) {
            valueMax.value = values[handle];
        } else {
            valueMin.value = values[handle];
        }
        });
    </script>
@endpush