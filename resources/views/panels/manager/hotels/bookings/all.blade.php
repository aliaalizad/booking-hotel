@extends('panels.manager.master')

@section('page_title', 'لیست رزروها')

@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراكز اقامتی" route="manager.hotels.index"/>
        <x-panels.header.breadcrumb.item name="{{ $hotel->name }}" muted/>
        <x-panels.header.breadcrumb.item name="لیست رزروها" muted/>
    </x-panels.header.breadcrumb.menu>
@endsection

@push('styles')
    <link href="/plugins/custom/fullcalendar/fullcalendar.bundle.css" rel="stylesheet" type="text/css" />
@endpush

@section('content')

<div class="card card-bordered">

    <div class="card-body">
        <div id="calendar"></div>
    </div>  

</div>
@endsection


@push('scripts')

    <script src="/plugins/custom/fullcalendar/fullcalendar.bundle.js"></script>

    <script>

        var todayDate = moment().startOf("day");
        var YM = todayDate.format("YYYY-MM");
        var YESTERDAY = todayDate.clone().subtract(1, "day").format("YYYY-MM-DD");
        var TODAY = todayDate.format("YYYY-MM-DD");
        var TOMORROW = todayDate.clone().add(1, "day").format("YYYY-MM-DD");

        var calendarEl = document.getElementById("calendar");

        var calendar = new FullCalendar.Calendar(calendarEl, {
            locale: 'fa',
            headerToolbar: {
                left: "prev,next today",
                center: "title",
                right: "dayGridMonth,dayGridWeek,listDay"
            },

            // titleFormat: { year: 'numeric', month: 'long' },
            height: 500,
            contentHeight: 780,
            aspectRatio: 3,  // see: https://fullcalendar.io/docs/aspectRatio

            nowIndicator: true,
            now: TODAY + "T09:25:00", // just for demo

            views: {
                dayGridMonth: { buttonText: "ماه" },
                dayGridWeek: { buttonText: "هفته" },
                listDay: { buttonText: "روز" }
            },
            allDayText: '',
            
            initialView: "dayGridMonth",
            initialDate: TODAY,

            editable: false,
            dayMaxEvents: true, // allow "more" link when too many events
            navLinks: true,
            
            selectable: false,

            events: [
                @foreach($bookings as $booking)
                    {
                    title: "{{ $booking->passengers->first()->detail['teacher']['name'] }} - {{ $booking->voucher }} ",
                    start: '{{ $booking->checkin }}',
                    url: '{{ route("manager.hotels.bookings.show", [$hotel->id, $booking->id]) }}',
                    display: 'list-item',
                    backgroundColor: "@if($booking->status == 'received' ) {{ 'green' }} @endif",
                    },
                @endforeach
            ],


        });

        calendar.render();
    </script>

@endpush