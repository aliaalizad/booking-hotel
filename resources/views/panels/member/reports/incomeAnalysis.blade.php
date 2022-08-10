@extends('panels.member.master')


@section('page_title', 'تحلیل درآمد')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="گزارشات" muted />
        <x-panels.header.breadcrumb.item name="درآمد" muted />
        <x-panels.header.breadcrumb.item name="تحلیل" muted />
    </x-panels.header.breadcrumb.menu>
@endsection


@section('content')


<x-panels.admin.reports.income-analysis :data="$data" />



@endsection


@push('scripts')


@endpush