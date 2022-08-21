@extends('layouts.app.master')

@section('title', )


@push('styles')

    <link href="/plugins/global/leaflet/leaflet.css" rel="stylesheet">


@endpush


@section('content')
    <div class="content d-flex flex-column flex-column-fluid" id="kt_content">
        <!--begin::Post-->
        <div class="post d-flex flex-column-fluid" id="kt_post">
            <!--begin::Container-->
            <div class="container">
                <!--begin::Row-->
                <div class="row w-100 gy-10 mb-md-20">

                    <div id="map" style="height: 1600px;
			width: 1000px;
			max-width: 100%;
			max-height: 100%;"></div>

                </div>
                <!--end::Row-->
            </div>
            <!--end::Container-->
        </div>
        <!--end::Post-->
    </div>
@endsection

@push('scripts')
    <script src="/plugins/global/leaflet/leaflet.js"></script>

    <script>
        var map = L.map('map').setView([38.0792, 46.2887], 12);

        var tiles = L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            maxZoom: 19,
            attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
        }).addTo(map);

        

    </script>
@endpush