@extends('panels.admin.master')

@section('page_title', 'افزودن مدیر جدید')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="افزودن مدیر جدید" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')
<form class="form row justify-content-center" action="{{ route('admin.managers.store') }}" method="post">

    @csrf

    <div class="card col-xxl-9">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.managers.add.personal-information />
            </div>
            <!--end::Row-->

            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.managers.add.account />
            </div>
            <!--end::Row-->
            
            <!--begin::Row-->
            <div class="row">
                <x-panels.admin.managers.add.contract />
            </div>
            <!--end::Row-->
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-end py-6">
                <a href="{{ route('admin.managers.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
                <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->

    </div>

</form>
<!--end:Form-->

@endsection