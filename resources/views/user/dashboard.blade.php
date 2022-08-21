@extends('user.master')

@section('title', 'پروفایل')


@section('content')

    <div class="d-flex flex-column flex-xl-row">
        <!--begin::Content-->
        <div class="flex-lg-row-fluid ms-lg-15">
            <!--begin:::Tabs-->
            <ul class="nav nav-custom nav-tabs nav-line-tabs nav-line-tabs-2x border-0 fs-4 fw-bold mb-8">
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4 active" data-bs-toggle="tab" href="#bookings">رزروها</a>
                </li>
                <!--end:::Tab item-->
                <!--begin:::Tab item-->
                <li class="nav-item">
                    <a class="nav-link text-active-primary pb-4" data-bs-toggle="tab" href="#account">حساب کاربری</a>
                </li>
                <!--end:::Tab item-->
            </ul>
            <!--end:::Tabs-->
            <!--begin:::Tab content-->
            <div class="tab-content" id="myTabContent">
                <!--begin:::Tab pane-->
                <div class="tab-pane fade show active" id="bookings" role="tabpanel">
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">

                        <!--begin::Card body-->
                        <div class="card-body pt-0 pb-5">

                            <table class="table table-hover table-rounded border gy-7 gs-7">
                                <thead class="table-light">
                                    <tr class="text-center">
                                        <th>شماره رزرو</th>
                                        <th>تاریخ پذیرش</th>
                                        <th>مرکز پذیرش</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @php
                                        $i = $bookings->firstItem();
                                    @endphp

                                    @foreach ($bookings as $booking)
                                        <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">                                                 
                                            <td>{{ $booking->voucher }}</td>
                                            <td>{{ verta($booking->checkin)->format('%A %e %B %Y') }}</td>
                                            <td>{{ $booking->room->hotel->name . " - " . $booking->room->hotel->city->name }}</td>
                                            <td><a href="{{ route('user.showBooking', $booking->id) }}" target="_blank" class="btn btn-secondary btn-sm">مشاهده</a></td>
                                        </tr>
                                    @endforeach
                                </tbody>


                            </table>
                            
                            @if (count($bookings) == 0 )
                                <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                                    <span>شما رزروی ندارید</span>
                                </div>
                            @endif

                        </div>
                        <!--end::Card body-->
                        @if($bookings->hasPages())
                            <div class="card-footer">
                                <div class="d-flex justify-content-center ">
                                    <div class="pagination pagination-outline">
                                    {{ $bookings->withQueryString()->onEachSide(1)->links() }}
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
                <!--begin:::Tab pane-->
                <div class="tab-pane fade" id="account" role="tabpanel">

                    <div class="card mb-5 mb-xl-10" id="kt_profile_details_view">
                        <!--begin::Card header-->
                        <div class="card-header cursor-pointer">
                            <!--begin::Card title-->
                            <div class="card-title m-0">
                                <h3 class="fw-bolder m-0">اطلاعات حساب کاربری</h3>
                            </div>
                            <!--end::Card title-->
                        </div>
                        <!--begin::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body">
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-4 fw-bold text-muted">نام و نام خانوادگی</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ $user->name }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-4 fw-bold text-muted">شماره موبایل</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ $user->phone }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-4 fw-bold text-muted">کد ملی</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ $user->national_code }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->

                            
                            <!--begin::Row-->
                            <div class="row mb-7">
                                <!--begin::Label-->
                                <label class="col-4 fw-bold text-muted">استان</label>
                                <!--end::Label-->
                                <!--begin::Col-->
                                <div class="col-8">
                                    <span class="fw-bolder fs-6 text-gray-800">{{ $user->state->name }}</span>
                                </div>
                                <!--end::Col-->
                            </div>
                            <!--end::Row-->
                        </div>
                        <!--end::Card body-->
                    </div>

                </div>
                <!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>

@endsection

@push('scripts')
    <script>
        $(document).ready(function(){
            @if(session()->has('payment_status')) 
                @if(session('payment_status') == 1)
                    Swal.fire({
                        title: "پرداخت موفق",
                        text: "ثبت رزرو با موفقیت انجام شد",
                        icon: "success",
                        confirmButtonText: "بستن",
                        customClass: {
                            confirmButton: "btn btn-success"
                        },
                    });
                @elseif(session('payment_status') == 0)
                    Swal.fire({
                        title: "پرداخت ناموفق",
                        html: "فرایند ثبت رزرو با خطا مواجه شد </br></br> در صورتی که مبلغی از حساب بانکی شما کسر شده است  </br> حداکثر تا 72 ساعت به حساب شما باز خواهد گشت",
                        icon: "error",
                        confirmButtonText: "بستن",
                        customClass: {
                            confirmButton: "btn btn-danger"
                        },
                    });
                @endif
            @endif
        });
 
    </script>
@endpush