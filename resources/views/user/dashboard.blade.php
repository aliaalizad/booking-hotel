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
                    <!--begin::Card-->
                    <div class="card pt-4 mb-6 mb-xl-9">
                        <!--begin::Card header-->
                        <div class="card-header border-0">
                            <!--begin::Card title-->
                            <div class="card-title">
                                <h2>Logs</h2>
                            </div>
                            <!--end::Card title-->
                            <!--begin::Card toolbar-->
                            <div class="card-toolbar">
                                <!--begin::Button-->
                                <button type="button" class="btn btn-sm btn-light-primary">
                                <!--begin::Svg Icon | path: icons/duotune/files/fil021.svg-->
                                <span class="svg-icon svg-icon-3">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                        <path opacity="0.3" d="M19 15C20.7 15 22 13.7 22 12C22 10.3 20.7 9 19 9C18.9 9 18.9 9 18.8 9C18.9 8.7 19 8.3 19 8C19 6.3 17.7 5 16 5C15.4 5 14.8 5.2 14.3 5.5C13.4 4 11.8 3 10 3C7.2 3 5 5.2 5 8C5 8.3 5 8.7 5.1 9H5C3.3 9 2 10.3 2 12C2 13.7 3.3 15 5 15H19Z" fill="black"></path>
                                        <path d="M13 17.4V12C13 11.4 12.6 11 12 11C11.4 11 11 11.4 11 12V17.4H13Z" fill="black"></path>
                                        <path opacity="0.3" d="M8 17.4H16L12.7 20.7C12.3 21.1 11.7 21.1 11.3 20.7L8 17.4Z" fill="black"></path>
                                    </svg>
                                </span>
                                <!--end::Svg Icon-->Download Report</button>
                                <!--end::Button-->
                            </div>
                            <!--end::Card toolbar-->
                        </div>
                        <!--end::Card header-->
                        <!--begin::Card body-->
                        <div class="card-body py-0">
                            <!--begin::Table wrapper-->
                            <div class="table-responsive">
                                <!--begin::Table-->
                                <table class="table align-middle table-row-dashed fw-bold text-gray-600 fs-6 gy-5" id="kt_table_customers_logs">
                                    <!--begin::Table body-->
                                    <tbody>
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-danger">500 ERR</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoice/in_2968_9533/invalid</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">21 Feb 2022, 2:40 pm</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-success">200 OK</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoices/in_5516_8672/payment</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">10 Nov 2022, 11:05 am</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-success">200 OK</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoices/in_6472_9884/payment</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">19 Aug 2022, 8:43 pm</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-danger">500 ERR</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoice/in_2869_2279/invalid</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">25 Jul 2022, 11:05 am</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-success">200 OK</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoices/in_4644_2918/payment</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">21 Feb 2022, 5:20 pm</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-success">200 OK</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoices/in_6472_9884/payment</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">05 May 2022, 5:30 pm</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-success">200 OK</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoices/in_1818_1749/payment</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">19 Aug 2022, 5:20 pm</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-success">200 OK</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoices/in_5931_1390/payment</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">19 Aug 2022, 11:30 am</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-warning">404 WRN</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/customer/c_61de0bd353911/not_found</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">20 Jun 2022, 10:10 pm</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                        <!--begin::Table row-->
                                        <tr>
                                            <!--begin::Badge=-->
                                            <td class="min-w-70px">
                                                <div class="badge badge-light-success">200 OK</div>
                                            </td>
                                            <!--end::Badge=-->
                                            <!--begin::Status=-->
                                            <td>POST /v1/invoices/in_6472_9884/payment</td>
                                            <!--end::Status=-->
                                            <!--begin::Timestamp=-->
                                            <td class="pe-0 text-end min-w-200px">24 Jun 2022, 6:43 am</td>
                                            <!--end::Timestamp=-->
                                        </tr>
                                        <!--end::Table row-->
                                    </tbody>
                                    <!--end::Table body-->
                                </table>
                                <!--end::Table-->
                            </div>
                            <!--end::Table wrapper-->
                        </div>
                        <!--end::Card body-->
                    </div>
                    <!--end::Card-->
                </div>
                <!--end:::Tab pane-->
            </div>
            <!--end:::Tab content-->
        </div>
        <!--end::Content-->
    </div>
@endsection