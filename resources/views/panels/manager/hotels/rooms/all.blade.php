@extends('panels.manager.master')

@section('page_title', 'لیست اتاق ها')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراكز اقامتی" route="manager.hotels.index" />
        <x-panels.header.breadcrumb.item name="{{ $hotel->name }}" muted />
        <x-panels.header.breadcrumb.item name="لیست اتاق ها" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')



<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">اتاق ها</h3>
        <div class="card-toolbar ">
            <a href="{{ route('manager.rooms.create', $hotel->id) }}" class="btn btn-primary btn-sm">افزودن اتاق جدید</a>
        </div>
    </div>
    <div class="card-body">
            @if((count($rooms) !== 0 ))
                <table class="table table-hover table-rounded border gy-7 gs-7">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>ردیف</th>
                            <th>نام</th>
                            <th>ظرفیت</th>
                            <th>اتاق ها</th>
                            <th>قیمت</th>
                            <th>اقدامات</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php
                            // $i = $rooms->firstItem();
                            $i = 1;
                        @endphp

                        @foreach ($rooms as $room)
                            <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">
                                <td>{{ $i++ }}</td>
                            
                                <td>{{ $room->name }}</td>
                                <td>{{ $room->capacity }}</td>
                                <td>{{ implode(' - ' ,$room->numbers) }}</td>
                                <td>{{ $room->price }}</td>
                                <td>
                                    <a href="{{ route('manager.rooms.edit',[$hotel->id, $room->id]) }}" class="btn btn-secondary btn-sm">ویرایش</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                    <span>اتاقی ثبت نشده است</span>
                </div>
            @endif
    </div>

</div>
@endsection