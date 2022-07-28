@extends('panels.manager.master')

@section('page_title', 'مراکز اقامتی')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراكز اقامتی" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')



<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">مراکز اقامتی</h3>
        <div class="card-toolbar ">
            <a href="{{ route('manager.hotels.create') }}" class="btn btn-primary btn-sm">افزودن مرکز جدید</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-rounded border gy-7 gs-7">
            <thead class="table-light">
                <tr class="text-center">
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>شماره تلفن</th>
                    <th>شهرستان</th>
                    <th>وضعیت رزرو</th>
                    <th>اقدامات</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = $hotels->firstItem();
                @endphp

                @foreach ($hotels as $hotel)
                    <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $hotel->name }}</td>
                        <td>{{ $hotel->phone }}</td>
                        <td>{{ $hotel->city->name }}</td>
                        <td>
                            @if($hotel->is_bookable)
                                <span class="badge badge-success">قابل رزرو</span>
                            @else
                                <span class="badge badge-danger">غیرقابل رزرو</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('manager.hotels.edit', $hotel->id) }}" class="btn btn-secondary btn-sm">ویرایش</a>
                            <a href="{{ route('manager.rooms.index', $hotel->id) }}" class="btn btn-primary btn-sm">اتاق ها</a>
                            <a href="{{ route('manager.hotels.bookings.index', $hotel->id) }}" class="btn btn-primary btn-sm">رزروها</a>
                            <a href="{{ route('manager.hotels.unbookables.index', $hotel->id) }}" class="btn btn-primary btn-sm">محدودیت رزرو</a>

                        </td>
                    </tr>
                @endforeach
            </tbody>


        </table>
        
        @if (count($hotels) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif

    </div>

    @if($hotels->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center ">
                <div class="pagination pagination-outline">
                {{ $hotels->withQueryString()->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection