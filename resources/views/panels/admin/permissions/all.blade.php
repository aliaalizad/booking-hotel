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
        <table class="table table-hover table-rounded border gy-7 gs-7">
            <thead class="table-light">
                <tr class="text-center">
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>شرح</th>
                    <th>پنل</th>
                    <th>اقدامات</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = $permissions->firstItem();
                @endphp

                @foreach ($permissions as $permission)
                    <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $permission->name }}</td>
                        <td>{{ $permission->label }}</td>
                        <td>
                            @if( $permission->guard == 'admin')
                                <span class="badge badge-primary">مدیریت وبسایت</span>
                            @elseif( $permission->guard == 'manager')
                                <span class="badge badge-danger">مدیریت مراکز</span>
                            @elseif( $permission->guard == 'member')
                                <span class="badge badge-success">مسئول پذیرش</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.permissions.edit', $permission->id) }}" class="btn btn-secondary btn-sm">ویرایش</a>
                        </td>
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