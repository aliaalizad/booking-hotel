@extends('panels.admin.master')

@section('page_title', 'دسترسی ها')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="دسترسی ها" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')



<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">دسترسی ها</h3>
        <div class="card-toolbar ">
            <a href="{{ route('admin.permissions.create') }}" class="btn btn-primary btn-sm">افزودن دسترسی جدید</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>توضیح</th>
                    <th>گارد</th>
                    <th>اقدامات</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = $permissions->firstItem();
                @endphp

                @foreach ($permissions as $permission)
                    <tr>
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->label }}</td>
                        <td>{{ $permission->guard }}</td>

                        <td><a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-secondary btn-sm">ویرایش</a></td>
                    </tr>
                @endforeach
            </tbody>


        </table>
        
        @if (count($permissions) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif

    </div>

    @if($permissions->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center ">
                <div class="pagination pagination-outline">
                {{ $permissions->withQueryString()->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection