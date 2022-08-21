@extends('panels.manager.master')

@section('page_title', 'رزروها')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="رزروها" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<x-panels.admin.booking.filter />


<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">لیست رزروها</h3>
        <div class="card-toolbar ">
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-rounded border gy-7 gs-7">
            <thead class="table-light">
                <tr class="text-center">
                    <th>ردیف</th>
                    <th>تاریخ ثبت رزرو</th>
                    <th>شماره رزرو</th>
                    <th>مبلغ رزرو</th>
                    <th>تاریخ پذیرش</th>
                    <th>مرکز پذیرش</th>
                    <th>اقدامات</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = $bookings->firstItem();
                @endphp

                @foreach ($bookings as $booking)
                    <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ verta($booking->created_at)->format('H:i:s Y-m-d ') }}</td>
                        <td>{{ $booking->voucher }}</td>
                        <td>{{ number_format($booking->payments->last()->booking_amount) . ' ریال '}}</td>
                        <td>{{ verta($booking->checkin)->format('Y/m/d') }}</td>
                        <td>{{ $booking->room->hotel->name . " - " . $booking->room->hotel->city->name }}</td>
                        <td><a href="{{ route('manager.hotels.bookings.show', ['hotel' => $booking->room->hotel->id, 'booking' => $booking->id]) }}" target="_blank" class="btn btn-secondary btn-sm">مشاهده</a></td>
                    </tr>
                @endforeach
            </tbody>


        </table>
        
        @if (count($bookings) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif

    </div>

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
@endsection