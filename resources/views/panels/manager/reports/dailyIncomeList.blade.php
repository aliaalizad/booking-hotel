@extends('panels.manager.master')

@section('page_title', 'لیست درآمد روزانه')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="لیست درآمد روزانه" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')



<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">لیست درآمد روزانه</h3>
        <div class="card-toolbar ">
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-rounded border gy-7 gs-7">
            <thead class="table-light">
                <tr class="text-center">
                    <th>ردیف</th>
                    <th>تاریخ</th>
                    <th>مبلغ</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = 1;
                @endphp

                @foreach ($incomes as $income)
                    <tr class="text-center fw-bold fs-6 border-bottom border-gray-200">
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $income['date'] }}</td>
                        <td>{{ number_format($income['amount']) . ' ریال ' }}</td>

                    </tr>
                @endforeach
            </tbody>


        </table>

        @if (count($incomes) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif


</div>
@endsection