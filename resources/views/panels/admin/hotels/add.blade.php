@extends('panels.admin.master')

@section('page_title', 'افزودن مرکز جدید')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراکز اقامتی" route="admin.hotels.index" />
        <x-panels.header.breadcrumb.item name="افزودن" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@push('styles')
    <link href="/plugins/global/leaflet/leaflet.css" rel="stylesheet">
@endpush

@section('content')

<form class="form row justify-content-center" action="{{ route('admin.hotels.store') }}" method="post">
    @csrf

    <div class="col-xxl-10">
        <!--begin::Card body-->
        <div class="card-body">

            <x-error/>

            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.info />
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.map />
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.config />
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.rules />
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.manager />
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center py-6">
                <a href="{{ route('admin.hotels.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
                <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->

    </div>

</form>
<!--end:Form-->

@endsection

@push('scripts')
    <script src="/plugins/global/leaflet/leaflet.js"></script>

    <script>
        $("#city").change(function() {
            
            var city = this.value;
            $('#map').empty();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        $.ajax({
                type:'POST',
                url:"{{ route('ajax.hotel.coordinates') }}",
                data:{
                    "_token": "{{ csrf_token() }}",
                    "city": city,
                },
                success:function(coordinates){
                    var coordinates = JSON.parse(coordinates);
                    var longitude = coordinates.longitude ?? 0;
                    var latitude = coordinates.latitude ?? 0;

                    map_container = '<div id="map_container" style="height: 600px;"></div>';
                    $('#map').append(map_container);

                    map = L.map('map_container').setView([longitude, latitude], 12);

                    var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                        maxZoom: 19,
                    }).addTo(map);


                    var theMarker = {};
                    map.on('click',function(e){
                        lat = e.latlng.lat;
                        lon = e.latlng.lng;

                        //Clear existing marker, 
                        if (theMarker != undefined) {
                            map.removeLayer(theMarker);
                        };
                        //Add a marker to show where you clicked.
                        theMarker = L.marker([lat,lon]).addTo(map);
                        
                        $('#longitude').val(lon);
                        $('#latitude').val(lat);
                    });
                }
            });
            
        });

        

    </script>
@endpush