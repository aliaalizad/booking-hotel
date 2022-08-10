@extends('panels.manager.master')

@section('page_title', 'ویرایش مرکز')


@section('breadcrumb')
<x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراکز اقامتی" route="manager.hotels.index" />
        <x-panels.header.breadcrumb.item name="{{ $hotel->name }}" muted />
        <x-panels.header.breadcrumb.item name="ویرایش" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<form class="form row justify-content-center" action="{{ route('manager.hotels.update', $hotel->id) }}" method="post">
    @csrf
    @method("PUT")


    <div class="col-xxl-10">
        
        <!--begin::Card body-->
        <div class="card-body">
            <x-error/>

            <div class="row">
                <x-panels.admin.hotels.info :hotel="$hotel" />
            </div>

            <div class="row">
                <x-panels.admin.hotels.config :hotel="$hotel" />
            </div>
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center py-6">
            <a href="{{ route('manager.hotels.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->
    </div>

</form>
<!--end:Form-->

@endsection