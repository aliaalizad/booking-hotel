@extends('panels.admin.master')

@section('page_title', 'کارمندان')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="کارمندان" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<x-panels.admin.members.filter />


<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">کارمندان</h3>
        <div class="card-toolbar ">
            <a href="{{ route('admin.members.create') }}" class="btn btn-primary btn-sm">افزودن کارمند جدید</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام و نام  خانوادگی</th>
                    <th>کد پرسنلی</th>
                    <th>وضعیت حساب کاربری</th>
                    <th>مدیر</th>
                    <th>هتل</th>
                    <th>اقدامات</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = $members->firstItem();
                @endphp

                @foreach ($members as $member)
                    <tr>
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->personnel_code }}</td>
                        <td>
                            @if(! $member->is_blocked)
                                <span class="badge badge-success">فعال</span>
                            @else
                                <span class="badge badge-danger">غیرفعال</span>
                            @endif
                        </td>
                        <td><a href="#">{{ $member->manager->name ?? '-'}}</a></td>
                        <td><a href="#">{{ $member->hotel->name ?? '-' }}</a></td>
                        <td><a href="{{ route('admin.members.edit', $member->id) }}" class="btn btn-secondary btn-sm">ویرایش</a></td>
                    </tr>
                @endforeach
            </tbody>


        </table>
        
        @if (count($members) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif

    </div>

    @if($members->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center ">
                <div class="pagination pagination-outline">
                {{ $members->withQueryString()->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection