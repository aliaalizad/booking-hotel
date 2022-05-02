@extends('panels.admin.master')

@section('page_title', 'ویرایش کارمند')


@section('breadcrumb')
<x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراکز اقامتی" muted />
        <x-panels.header.breadcrumb.item name="کارمندان" route="admin.members.index" />
        <x-panels.header.breadcrumb.item name="{{ $member->name }}" muted />
        <x-panels.header.breadcrumb.item name="ویرایش" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<form class="form row justify-content-center" action="{{ route('admin.members.update', $member->id) }}" method="post">
    @csrf
    @method("PUT")


    <div class="col-xxl-10">
        
        <!--begin::Card body-->
        <div class="card-body">
        
            <div class="row">
                <x-panels.admin.members.personal-information :member="$member" />
            </div>

            <div class="row">
                <x-panels.admin.members.account :member="$member" />
            </div>

            <div class="row">
                <x-panels.admin.members.manager :member="$member" />
            </div>

            <div class="row">
                <x-panels.admin.members.hotel :member="$member" />
            </div>

        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center py-6">
            <a href="{{ route('admin.members.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->
    </div>

</form>
<!--end:Form-->

@endsection