@extends('panels.member.master')

@section('page_title', 'افزودن اتاق جدید')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="لیست اتاق ها" route="member.hotel.rooms.index"/>
        <x-panels.header.breadcrumb.item name="افزودن" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<form class="form row justify-content-center" action="{{ route('member.hotel.rooms.store') }}" method="post">
    @csrf

    <div class="col-xxl-10">
        <!--begin::Card body-->
        <div class="card-body">
            <x-error/>
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.rooms.info />
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.rooms.conditions />
            </div>
            <!--end::Row-->
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.hotels.rooms.properties />
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center py-6">
                <a href="{{ route('member.hotel.rooms.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
                <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->

    </div>

</form>
<!--end:Form-->

@endsection

@push('scripts')
    <script>
        var input = document.querySelector("#tagify");
        new Tagify(input);
    </script>
@endpush