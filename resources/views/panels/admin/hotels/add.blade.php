@extends('panels.admin.master')

@section('page_title', 'افزودن مرکز جدید')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراکز اقامتی" route="admin.hotels.index" />
        <x-panels.header.breadcrumb.item name="افزودن" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

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

