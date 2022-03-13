@extends('panels.admin.master')

@section('page_title', 'ویرایش قرارداد')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="ویرایش قرارداد" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<form class="form row justify-content-center" action="{{ route('admin.contracts.update', $contract->id) }}" method="post">
    @csrf
    @method("PUT")


    <div class="card col-xxl-9">
        
        <!--begin::Card body-->
        <div class="card-body">
        
            <div class="row">
                <x-panels.admin.contracts.edit.information :contract="$contract" />
            </div>

        </div>
        <!--end::Card body-->
    
        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-end py-6">
            <a href="{{ route('admin.contracts.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->
    </div>

</form>
<!--end:Form-->

@endsection