@extends('layouts.app.master')

@section('title', config('app.title') . ' | ' . 'لیست مراکز اقامتی' )


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

                <div class="row justify-content-center">

                    <div class="col-lg-10 col-md-10 col-sm-10 p-0">

                    @foreach($hotels as $hotel)

                        <div class="card mb-7 mx-3 shadow-sm">
                            <div class="row g-0">
                                <!-- image -->
                                <div class="col-md-3 d-none d-md-block ">
                                    <a href="{{ route('hotel', ['hotel' => $hotel->code, 'checkin' => Booking::getCheckin(), 'checkout' => Booking::getCheckout(), 'adults' => Booking::getAdults()] ) }}" target="_blank"><img src="/media/hotel/blank.png" class="img-fluid rounded-start " style="width: 239.9px; height: 167.75px; object-fit: cover; object-position: 50% 50%;" alt="..."></a>
                                </div>
                                <!-- details -->
                                <div class="col-md-6 ">
                                    <a href="{{ route('hotel', ['hotel' => $hotel->code, 'checkin' => Booking::getCheckin(), 'checkout' => Booking::getCheckout(), 'adults' => Booking::getAdults()] ) }}" target="_blank">
                                        <div class="card-body pb-0">
                                            <h3 class="card-title">{{ $hotel->name }}</h3>
                                            <p class="card-text text-muted ">{{ $hotel->phone }}</p>
                                            <p class="card-text text-muted ">{{ $hotel->address }}</p>
                                        </div>
                                    </a>
                                </div>
                                <!-- price -->
                                <div class="col-md-3">

                                    <div class="card-body row align-items-center text-center border border-secondary border-top-0 border-bottom-0 border-right-0 d-none d-md-block">
                                        <div class="mb-4">
                                            <span>
                                                <strong class="h1 text-primary">{{ $rooms->where('hotel_id', $hotel->id)->min('price') * Booking::getLength() }}</strong>
                                                <small class="text-muted">ريال</small>
                                            </span>
                                        </div>

                                        <a href="{{ route('hotel', ['hotel' => $hotel->code, 'checkin' => Booking::getCheckin(), 'checkout' => Booking::getCheckout(), 'adults' => Booking::getAdults()] ) }}" target="_blank" class="btn btn-primary ">مشاهده اتاق ها و رزرو</a>

                                        <div class="mt-4">
                                            <span>
                                                <small class="text-muted">قیمت برای</small>
                                                <small class="text-muted">{{ Booking::getLength() }}</small>
                                                <small class="text-muted">شب</small>
                                            </span>
                                        </div>
                                    </div>

                                    <a href="{{ route('hotel', ['hotel' => $hotel->code, 'checkin' => Booking::getCheckin(), 'checkout' => Booking::getCheckout(), 'adults' => Booking::getAdults()] ) }}" target="_blank">
                                        <div class="card-body row align-items-end text-end d-block d-md-none pb-0" >
                                            <div class="mb-4">
                                                <div class="separator my-3 "></div>
                                                <span>
                                                    <small class="text-muted">{{ Booking::getLength() }}</small>
                                                    <small class="text-muted me-2">شب</small>
                                                    <strong class="h1 text-primary">{{ $rooms->where('hotel_id', $hotel->id)->min('price') * Booking::getLength() }}   </strong>
                                                    <small class="text-muted">ريال</small>
                                                </span>
                                            </div>
                                        </div>
                                    </a>

                                </div>  
                            </div>
                        </div>
                    @endforeach

                    @if($hotels->isEmpty())
                        {{ 'نتیجه ای یافت نشد' }}
                    @endif
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
            var passengers = +adults;
                $('#passengers').val(passengers);
            });
        });
    </script>

@endpush