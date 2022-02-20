@extends('panels.admin.master')

@section('page_title', 'مدیران هتل')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مدیران هتل" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<x-panels.admin.managers.filter />


<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">مدیران هتل</h3>
        <div class="card-toolbar ">
            <a href="{{ route('admin.managers.create') }}" class="btn btn-primary btn-sm">افزودن مدیر جدید</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام و نام  خانوادگی</th>
                    <th>نام کاربری</th>
                    <th>وضعیت حساب کاربری</th>
                    <th>شماره تلفن</th>
                    <th>استان</th>
                    <th>قرارداد</th>
                    <th>اقدامات</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = $managers->firstItem();
                @endphp

                @foreach ($managers as $manager)
                    <tr>
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $manager->name }}</td>
                        <td>{{ $manager->username }}</td>
                        <td>
                            @if(! $manager->is_blocked)
                                <span class="badge badge-success">فعال</span>
                            @else
                                <span class="badge badge-danger">غیرفعال</span>
                            @endif
                        </td>
                        <td>{{ $manager->phone }}</td>
                        <td>{{ $manager->province }}</td>
                        <td><a href="#">{{ $manager->contract->name ?? '-' }}</a></td>
                        <td><a href="{{ route('admin.managers.edit', $manager->id) }}" class="btn btn-secondary btn-sm">ویرایش</a></td>
                    </tr>
                @endforeach
            </tbody>


        </table>
        
        @if (count($managers) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif

    </div>

    @if($managers->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center ">
                <div class="pagination pagination-outline">
                {{ $managers->withQueryString()->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection