@extends('layouts.app.master')

@section('title', config('app.title') . ' | ' . 'اطلاعات مسافران')


@push('styles')
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
        font-size: 1.2rem;
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
        font-size: 1.2rem;
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
        font-size: 1.2rem;
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

@endpush


@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container">
                <form action="{{ route('reserve.confirm', ['room' => $room->code, 'checkin' => Booking::getCheckin(), 'checkout' => Booking::getCheckout(), 'adults' => Booking::getAdults()]) }}" id="reserve.passengers" method="post" autocomplete="off" class="form min-w-lg-1000px">
                    @csrf
                    <div class="card mb-10">
                        <div class="card-header">
                            <div class="card-title">مشخصات اقامتگاه</div>
                            <div class="card-toolbar">
                                <a href="{{ route('hotel', ['hotel' => $room->hotel->code, 'checkin' => Booking::getCheckin(), 'checkout' => Booking::getCheckout(), 'adults' => Booking::getAdults() ]) }}" class="btn btn-sm btn-primary">تغییر اتاق</a>
                            </div>
                        </div>
                        <!--begin::Row-->
                        <div class="row card-body">
                            <!--begin::Col-->
                            <div class="col-md-8 mb-10 mb-md-0 border border-secondary border-top-0 border-bottom-0 border-right-0">
                                <p> <span class="h3">{{ $room->hotel->name }}</span>&nbsp;|&nbsp;<span class="text-gray-800" style="font-size: 1.3rem;">{{ $room->name }}</span></p>
                                <p class="text-gray-600" style="font-size: 1.3rem;">{{ $room->hotel->address }}</p> 
                            </div>
                            <!--end::Col-->

                            <!--begin::Col-->
                            <div class="col-md-4 d-flex ps-0">
                                <div class="col-6 ps-2 border border-secondary border-top-0 border-bottom-0 border-right-0">
                                    <p class="text-gray-600" style="font-size: 1.3rem;">تاریخ ورود</p>
                                    <span class="h3 d-flex mb-0">
                                        <p>{{ Booking::getCheckinJalali() }}</p>
                                        <p>&nbsp;-&nbsp;ساعت&nbsp;</p>
                                        <p>12:00</p>
                                    </span>
                                </div>
                                <div class="col-6 ps-2 border border-secondary border-top-0 border-bottom-0 border-right-0">
                                    <p class="text-gray-600" style="font-size: 1.3rem;">تاریخ خروج</p>
                                    <span class="h3 d-flex mb-0">
                                        <p>{{ Booking::getCheckoutJalali() }}</p>
                                        <p>&nbsp;-&nbsp;ساعت&nbsp;</p>
                                        <p>14:00</p>
                                    </span>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>

                    <div class="card mb-10">
                        <div class="card-header">
                            <h3 class="card-title">مشخصات فرهنگی</h3>
                        </div>
                        <!--begin::Row-->
                        <div class="row card-body">
                            <!--begin::Col-->
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="d-flex form-group">
                                    <div class="input-control">
                                        <input type="text" name="teacher[first_name]" class="input-field" placeholder="نام" value="@php echo session()->has('edit-teacher') ? old('teacher.first_name', session()->get('edit-teacher')['first_name']) : old('teacher.first_name') @endphp">
                                        <label class="input-label">نام</label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="d-flex form-group">
                                    <div class="input-control">
                                        <input type="text" name="teacher[last_name]" class="input-field" placeholder="نام خانوادگی" value="@php echo session()->has('edit-teacher') ? old('teacher.last_name', session()->get('edit-teacher')['last_name']) : old('teacher.last_name') @endphp">
                                        <label class="input-label">نام خانوادگی</label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-3 mb-4 mb-md-0">
                                <div class="d-flex form-group">
                                    <div class="input-control">
                                        <input type="text" name="teacher[national_code]" class="input-field" dir="ltr" placeholder="کد ملی" value="@php echo session()->has('edit-teacher') ? old('teacher.national_code', session()->get('edit-teacher')['national_code']) : old('teacher.national_code') @endphp">
                                        <label class="input-label">کد ملی</label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                            <!--begin::Col-->
                            <div class="col-md-3">
                                <div class="d-flex form-group">
                                    <div class="input-control">
                                        <input type="text" name="teacher[personnel_code]" class="input-field" dir="ltr" placeholder="کد پرسنلی / دفتر کل" value="@php echo session()->has('edit-teacher') ? old('teacher.personnel_code', session()->get('edit-teacher')['personnel_code']) : old('teacher.personnel_code') @endphp">
                                        <label class="input-label">کد پرسنلی / دفتر کل</label>
                                    </div>
                                </div>
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>

                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">مشخصات مسافران</h3>
                        </div>
                        @foreach(range(1, Booking::getAdults()) as $item)
                            @if ($item == 1)
                            <div class="row mb-0 pb-0">
                                <div class="col pt-10 ps-10 ">
                                    <span class="badge badge-secondary mb-5" style="font-size: 1.1rem;">سرپرست</span>
                                </div>
                            </div>
                            @endif

                            <!--begin::Row-->
                            <div class="row card-body">

                                <!--begin::Col-->
                                <div class="col-md-3 mb-4 mb-md-0">
                                    <div class="d-flex form-group">
                                        <div class="input-control">
                                            <input type="text" name="passengers[{{ $item }}][first_name]" class="input-field" placeholder="نام" value="@php echo session()->has('edit-passengers') ? old('passengers.' . $item . '.first_name', session()->get('edit-passengers')[$item]['first_name']) : old('passengers.' . $item . '.first_name') @endphp">
                                            <label class="input-label">نام</label>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3 mb-4 mb-md-0">
                                    <div class="d-flex form-group">
                                        <div class="input-control">
                                            <input type="text" name="passengers[{{ $item }}][last_name]" class="input-field" placeholder="نام خانوادگی" value="@php echo session()->has('edit-passengers') ? old('passengers.' . $item . '.last_name', session()->get('edit-passengers')[$item]['last_name']) : old('passengers.' . $item . '.last_name') @endphp">
                                            <label class="input-label">نام خانوادگی</label>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                <!--begin::Col-->
                                <div class="col-md-3 mb-4 mb-md-0">
                                    <div class="d-flex form-group">
                                        <div class="input-control">
                                            <input type="text" name="passengers[{{ $item }}][national_code]" class="input-field" dir="ltr" placeholder="کد ملی" value="@php echo session()->has('edit-passengers') ? old('passengers.' . $item . '.national_code', session()->get('edit-passengers')[$item]['national_code']) : old('passengers.' . $item . '.national_code') @endphp">
                                            <label class="input-label">کد ملی</label>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                @if ($item == 1)
                                <!--begin::Col-->
                                <div class="col-md-3 mb-4 mb-md-0">
                                    <div class="d-flex form-group">
                                        <div class="input-control">
                                            <input type="text" name="passengers[{{ $item }}][phone]" class="input-field" dir="ltr" placeholder="کد ملی" value="@php echo session()->has('edit-passengers') ? old('passengers.' . $item . '.phone', session()->get('edit-passengers')[$item]['phone']) : old('passengers.' . $item . '.phone') @endphp">
                                            <label class="input-label">تلفن همراه</label>
                                        </div>
                                    </div>
                                </div>
                                <!--end::Col-->
                                @endif
                            </div>
                            <!--end::Row-->
                            <div class="separator"></div>
                        @endforeach
                    </div>
                    
                    <a onclick="document.getElementById('reserve.passengers').submit()" class="btn btn-primary">تایید و ادامه خرید</a>
                </form>

            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

@endsection



@push('scripts')

<script src="/plugins/global/persian-datepicker.js"></script>


@endpush
