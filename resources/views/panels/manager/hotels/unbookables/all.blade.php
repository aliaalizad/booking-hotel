@extends('panels.manager.master')

@section('page_title', 'محدودیت رزرو')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="مراكز اقامتی" route="manager.hotels.index" />
        <x-panels.header.breadcrumb.item name="{{ $hotel->name }}" muted />
        <x-panels.header.breadcrumb.item name="محدودیت رزرو" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')


<x-error/>

<form class="form row justify-content-center" id="fromTo" action="{{ route('manager.hotels.unbookables.store', $hotel->id) }}" method="post">
    @csrf

    <x-panels.admin.hotels.unbookables.fromTo :hotel="$hotel"/>

</form>

<form class="form row justify-content-center" id="reception" action="{{ route('manager.hotels.unbookables.store', $hotel->id) }}" method="post">
    @csrf

    <x-panels.admin.hotels.unbookables.reception :hotel="$hotel"/>

</form>



<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">محدودیت رزرو</h3>
    </div>
    
    <div class="card-body">
            @if((count($unbookables) !== 0 ))
                <table class="table table-hover table-rounded border gy-7 gs-7">
                    <thead class="table-light">
                        <tr class="text-center">
                            <th>شماره اتاق</th>
                            <th>از تاریخ</th>
                            <th>تا تاریخ</th>
                            <th>اقدامات</th>
                        </tr>
                    </thead>
                    <tbody>
                        
                        @php
                            // $i = $unbookables->firstItem();
                            $i = 1;
                        @endphp

                        @foreach ($unbookables as $unbookable)
                            <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">
                            
                                <td>{{ $unbookable->room_number }}</td>
                                <td>{{ verta($unbookable->start_date)->format('Y-m-d') }}</td>
                                <td>{{ verta($unbookable->end_date)->format('Y-m-d') }}</td>
                                <td>
                                    <form id="delete-unbookable-{{$unbookable->id}}" action="{{ route('manager.hotels.unbookables.delete', ['hotel' => $hotel->id, 'unbookable' => $unbookable->id]) }}" method="post">
                                        @csrf
                                        @method('DELETE') 
                                    </form>
                                    <a href="#" onclick="document.getElementById('delete-unbookable-{{$unbookable->id}}').submit();" class="btn btn-danger btn-sm">حذف</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                    <span>موردی ثبت نشده است</span>
                </div>
            @endif
    </div>

</div>

@endsection

