@extends('panels.manager.master')

@section('page_title', 'افزودن کارمند جدید')


@section('breadcrumb')
<x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراکز اقامتی" muted />
        <x-panels.header.breadcrumb.item name="کارمندان" route="manager.members.index" />
        <x-panels.header.breadcrumb.item name="افزودن" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')
<form class="form row justify-content-center" action="{{ route('manager.members.store') }}" method="post">

    @csrf

    <div class="col-xxl-10">
        <!--begin::Card body-->
        <div class="card-body">

            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.members.personal-information />
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.members.account />
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.members.hotel :hotels="$hotels"/>
            </div>
            <!--end::Row-->

            <div class="row">
                <x-panels.admin.members.permissions />
            </div>

        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center py-6">
                <a href="{{ route('manager.members.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
                <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->

    </div>

</form>
<!--end:Form-->

@endsection