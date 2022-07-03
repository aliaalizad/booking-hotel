@extends('panels.manager.master')

@section('page_title', 'جزئیات رزرو')

@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراكز اقامتی" route="manager.hotels.index"/>
        <x-panels.header.breadcrumb.item name="{{ $hotel->name }}" muted/>
        <x-panels.header.breadcrumb.item name="لیست رزروها" route="manager.hotels.bookings.index" params="{{$hotel->id}}"/>
        <x-panels.header.breadcrumb.item name="#{{ $booking->voucher }}" muted/>
        <x-panels.header.breadcrumb.item name="جزئیات" muted/>
    </x-panels.header.breadcrumb.menu>
@endsection

@push('styles')
@endpush

@section('content')

    <x-panels.admin.booking.show :booking="$booking" :payments="$payments" :passengers="$passengers"/>

@endsection


@push('scripts')

@endpush