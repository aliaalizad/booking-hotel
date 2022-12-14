@extends('layouts.app.master')

@section('title', config('app.title') . ' | ' . 'تایید اطلاعات')


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

@php
    session()->flash('edit-passengers', $booking->get('passengers'));
    session()->flash('edit-teacher', $booking->get('teacher'));
@endphp

@section('content')

    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container">
                <div class="card mb-10">
                    <div class="card-header">
                        <div class="card-title">مشخصات اقامتگاه</div>
                    </div>
                    <!--begin::Row-->
                    <div class="row card-body">
                        <!--begin::Col-->
                        <div class="col-md-8 mb-10 mb-md-0 border border-secondary border-top-0 border-bottom-0 border-right-0">
                            <p> <span class="h3">{{ $booking->get('room')->hotel->name }}</span>&nbsp;|&nbsp;<span class="text-gray-800" style="font-size: 1.3rem;">{{ $booking->get('room')->name }}</span></p>
                            <p class="text-gray-600" style="font-size: 1.3rem;">{{ $booking->get('room')->hotel->address }}</p> 
                        </div>
                        <!--end::Col-->

                        <!--begin::Col-->
                        <div class="col-md-4 d-flex ps-0">
                            <div class="col-6 ps-2 border border-secondary border-top-0 border-bottom-0 border-right-0">
                                <p class="text-gray-600" style="font-size: 1.3rem;">تاریخ ورود</p>
                                <span class="h3 d-flex mb-0">
                                    <p>{{ $booking->get('checkinJalali') }}</p>
                                    <p>&nbsp;-&nbsp;ساعت&nbsp;</p>
                                    <p>14:00</p>
                                </span>
                            </div>
                            <div class="col-6 ps-2 border border-secondary border-top-0 border-bottom-0 border-right-0">
                                <p class="text-gray-600" style="font-size: 1.3rem;">تاریخ خروج</p>
                                <span class="h3 d-flex mb-0">
                                    <p>{{ $booking->get('checkoutJalali') }}</p>
                                    <p>&nbsp;-&nbsp;ساعت&nbsp;</p>
                                    <p>12:00</p>
                                </span>
                            </div>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->
                </div>

                @if ($booking->get('room')->hotel->rules)
                    <div class="card mb-10">
                        <div class="card-header">
                            <div class="card-title">قوانین اقامتگاه</div>
                        </div>
                        <!--begin::Row-->
                        <div class="row card-body">
                            <!--begin::Col-->
                            <div class="col mb-10 mb-md-0">
                                <ul style="font-size: 1.3rem;">
                                    @foreach($booking->get('room')->hotel->rules as $rule)
                                        <li class="text-danger mb-3">{{ $rule }}</li>
                                    @endforeach
                                </ul> 
                            </div>
                            <!--end::Col-->
                        </div>
                        <!--end::Row-->
                    </div>
                @endif

                <div class="card mb-10 ">
                    <div class="card-header">
                        <div class="card-title">اطلاعات رزرو</div>
                    </div>
                    <!--begin::Row-->
                    <div class="row card-body pb-0">
                        <!--begin::Col-->
                        <div class="col-md-8 mb-10 mb-md-0">
                            
                            <span class="badge badge-secondary mb-5" style="font-size: 1.1rem;">اطاعات فرهنگی</span>

                            <p style="font-size: 1.3rem;">
                                <span class="text-gray-600">نام:</span>&nbsp;<span >{{ $booking->get('teacher')['first_name'] . ' ' . $booking->get('teacher')['last_name'] }}</span>
                                <br class="d-block d-sm-none">
                                <span class="text-gray-600">کد ملی:</span>&nbsp;<span>{{ $booking->get('teacher')['national_code'] }}</span>
                                <br class="d-block d-sm-none">
                                <span class="text-gray-600">شماره پرسنلی:</span>&nbsp;<span>{{ $booking->get('teacher')['personnel_code'] }}</span>
                            </p>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-2 mb-10 mb-md-0 ">
                        <span class="badge badge-secondary mb-5" style="font-size: 1.1rem;">سرپرست</span>
                            <p style="font-size: 1.3rem;">{{ $booking->get('passengers')[1]['first_name'] . ' ' . $booking->get('passengers')[1]['last_name']}}</p>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-md-2 mb-10 mb-md-0 ">
                        <span class="badge badge-secondary mb-5" style="font-size: 1.1rem;">تلفن تماس</span>
                            <p style="font-size: 1.3rem;">{{ $booking->get('passengers')[1]['phone'] }}</p>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Row-->
                    <div class="card-body">
                    <span class="badge badge-secondary mb-5" style="font-size: 1.1rem;">مسافران</span>

                        <div class="table-responsive px-md-20" style="font-size: 1.2rem;">
                            <table class="table table-hover border gx-7">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th style="width: 5%">#</th>
                                        <th style="width: 52.5%">نام مسافر</th>
                                        <th style="width: 52.5%">کد ملی</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach(range(1, $booking->get('adults')) as $item)
                                        <tr class="text-center fw-bold fs-6 text-gray-800 border-bottom border-gray-200">
                                            <td>{{ $item }}</td>
                                            <td>{{ $booking->get('passengers')[$item]['first_name'] . ' ' . $booking->get('passengers')[$item]['last_name'] }}</td>
                                            <td>{{ $booking->get('passengers')[$item]['national_code'] }}</td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                    </div>
                    <!--end::Row-->

                </div>
                @php
                    $room = App\Models\Room::find($booking->get('room')->id);
                    $price = Booking::calculateAmount($booking);
                    $fee = $price * ($room->hotel->manager->commission / 100);
                    $amount = $price + $fee;
                @endphp
                <div class="card mb-10 align-items-center">
                    <div class="card-body w-md-50 text-center">
                        <div class="row " style="font-size: 1.25rem;">
                            <div class="col">
                                <p>هزینه اتاق ({{ $booking->get('length') }} شب)</p>
                            </div>
                            <div class="col">
                                <p>{{ number_format($price) . ' ریال '}}</p>
                            </div>
                        </div>
                        @if ($fee > 0)
                        <div class="row" style="font-size: 1.25rem;">
                            <div class="col">
                                <p>هزینه رزرو اینترنتی (%{{ ($fee / $price) * 100 }})</p>
                            </div>
                            <div class="col">
                                <p>{{ number_format($fee) . ' ریال ' }}</p>
                            </div>
                        </div>
                        @endif
                        <div class="separator my-4"></div>
                        <div class="row" style="font-size: 1.25rem;">
                            <div class="col">
                                <p>جمع کل مبلغ پرداختی</p>
                            </div>
                            <div class="col">
                                    <p>{{ number_format($amount) . ' ریال ' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="card-footer">
                        <div class="row text-center">
                            <div class="col">
                                <a href="{{ route('reserve.passengers', ['room' => $booking->get('room')->code, 'checkin' => $booking->get('checkin'), 'checkout' => $booking->get('checkout'), 'adults' => $booking->get('adults') ]) }}" class="btn btn-secondary">بازگشت</a>

                                <button type="button" class="btn btn-primary me-10" id="kt_button_1">
                                    <span class="indicator-label">
                                        تایید اطلاعات و پرداخت آنلاین
                                    </span>
                                    <span class="indicator-progress">
                                        چند لحظه صبر کنید ...<span class="spinner-border spinner-border-sm align-middle ms-2"></span>
                                    </span>
                                </button>

                            </div>
                        </div> 
                    </div>
                </div>
                <form action="{{ route('reserve.payment') }}" id="reserve.payment" method="post">
                    @csrf
                    <input type="hidden" name="booking" value="{{ $booking->get('id') }}">
                </form>
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>

@endsection



@push('scripts')

<script src="/plugins/global/persian-datepicker.js"></script>

<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var button = document.querySelector("#kt_button_1");

    var booking = $("input[name=booking]").val();

    button.addEventListener("click", function() {

        button.setAttribute("data-kt-indicator", "on");

        $.ajax({
                type:'POST',
                url:"{{ route('reserve.lastConfirmation') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "booking": booking,
                },
                success:function(data){
                    button.removeAttribute("data-kt-indicator");

                    if (data) {
                        document.getElementById('reserve.payment').submit();
                    } else {
                        alert('اتاق غیرقابل رزرو است');
                    }
                }
        });
    });

</script>

@endpush