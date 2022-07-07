@extends('panels.admin.master')

@section('page_title', 'نقش ها')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="نقش ها" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">نقش ها</h3>
        <div class="card-toolbar ">
            <a href="{{ route('admin.roles.create') }}" class="btn btn-primary btn-sm">افزودن نقش جدید</a>
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
                    $i = $roles->firstItem();
                @endphp

                @foreach ($roles as $role)
                    <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $role->name }}</td>
                        <td>{{ $role->label }}</td>
                        <td>
                            @if( $role->guard == 'admin')
                                <span class="badge badge-primary">مدیریت وبسایت</span>
                            @elseif( $role->guard == 'manager')
                                <span class="badge badge-danger">مدیریت مراکز</span>
                            @elseif( $role->guard == 'member')
                                <span class="badge badge-success">مسئول پذیرش</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn btn-secondary btn-sm">ویرایش</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>


        </table>
        
        @if (count($roles) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif

    </div>

    @if($roles->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center ">
                <div class="pagination pagination-outline">
                {{ $roles->withQueryString()->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection