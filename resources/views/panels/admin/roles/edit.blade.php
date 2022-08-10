@extends('panels.admin.master')

@section('page_title', 'ویرایش نقش')


@section('breadcrumb')
<x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="نقش ها" route="admin.roles.index" />
        <x-panels.header.breadcrumb.item name="{{ $role->name }}" muted />
        <x-panels.header.breadcrumb.item name="ویرایش" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<form class="form row justify-content-center" action="{{ route('admin.roles.update', $role->id) }}" method="post">
    @csrf
    @method("PUT")


    <div class="col-xxl-10">
        
        <!--begin::Card body-->
        <div class="card-body">
            <x-error/>

            <div class="row">
                <x-panels.admin.roles.info :role="$role" />
            </div>

            <div class="row">
                <x-panels.admin.roles.permissions :role="$role" />
            </div>
        </div>
        <!--end::Card body-->

        <!--begin::Card footer-->
        <div class="card-footer d-flex justify-content-center py-6">
            <a href="{{ route('admin.roles.index') }}" class="btn btn-light btn-active-light-primary me-2">لغو</a>
            <button type="submit" class="btn btn-primary">ثبت</button>
        </div>
        <!--end::Card footer-->
    </div>

</form>
<!--end:Form-->

@endsection

@push('scripts')
<script>
    $("#guard").change(function() {

        if (this.value === 'admin') {
            $('#permissions').empty().removeAttr('disabled')

            @foreach( App\Models\Permission::whereGuard('admin')->get() as $permission )
                $('#permissions').append('<option value={{$permission->id}}>{{$permission->label}}</option>');
            @endforeach
        }

        if (this.value === 'manager') {
            $('#permissions').empty().removeAttr('disabled')

            @foreach( App\Models\Permission::whereGuard('manager')->get() as $permission )
                $('#permissions').append('<option value={{$permission->id}}>{{$permission->label}}</option>');
            @endforeach
        }

        if (this.value === 'member') {
            $('#permissions').empty().removeAttr('disabled')

            @foreach( App\Models\Permission::whereGuard('member')->get() as $permission )
                $('#permissions').append('<option value={{$permission->id}}>{{$permission->label}}</option>');
            @endforeach
        }
    });
</script>

@endpush