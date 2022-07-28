@extends('user.master')

@section('title', $booking->voucher)

@section('content')

    <x-panels.admin.booking.show :booking="$booking" :payments="$payments" :passengers="$passengers"/>

@endsection


