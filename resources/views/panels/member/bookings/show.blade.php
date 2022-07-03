@extends('panels.member.master')

@section('page_title', 'جزئیات رزرو')

@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="لیست رزروها" route="member.bookings.index"/>
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