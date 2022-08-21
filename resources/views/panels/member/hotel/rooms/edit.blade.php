@extends('panels.member.master')

@section('page_title', 'ویرایش اتاق')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="لیست اتاق ها" route="member.hotel.rooms.index" params="{{$hotel->id}}"/>
        <x-panels.header.breadcrumb.item name="{{ $room->name }}" muted />
        <x-panels.header.breadcrumb.item name="ویرایش" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<form class="form row justify-content-center" action="{{ route('member.hotel.rooms.update', [$room->id]) }}" method="post">
    @csrf
    @method("PUT")


    <div class="col-xxl-10">
        
        <!--begin::Card body-->
        <div class="card-body">
            <x-error/>

            <div class="row">
                <x-panels.admin.hotels.rooms.info :room="$room"/>
            </div>

            <div class="row">
                <x-panels.admin.hotels.rooms.conditions :room="$room"/>
            </div>

            <div class="row">
                <x-panels.admin.hotels.rooms.properties :room="$room"/>
            </div>

        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center py-6">
            <a href="{{ route('member.hotel.rooms.index', $hotel->id) }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
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