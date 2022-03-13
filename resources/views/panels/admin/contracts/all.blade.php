@extends('panels.admin.master')

@section('page_title', 'قراردادها')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="قراردادها" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')



<div class="card card-bordered">
    <div class="card-header">
        <h3 class="card-title">قراردادها</h3>
        <div class="card-toolbar ">
            <a href="{{ route('admin.contracts.create') }}" class="btn btn-primary btn-sm">افزودن قرارداد جدید</a>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-hover table-rounded table-striped border gy-7 gs-7">
            <thead>
                <tr>
                    <th>ردیف</th>
                    <th>نام</th>
                    <th>کارمزد</th>
                    <th>اقدامات</th>
                </tr>
            </thead>
            <tbody>
                
                @php
                    $i = $contracts->firstItem();
                @endphp

                @foreach ($contracts as $contract)
                    <tr>
                        <td>{{ $i++ }}</td>
                    
                        <td>{{ $contract->name }}</td>
                        <td>{{ $contract->fee }}</td>

                        <td><a href="{{ route('admin.contracts.edit', $contract->id) }}" class="btn btn-secondary btn-sm">ویرایش</a></td>
                    </tr>
                @endforeach
            </tbody>


        </table>
        
        @if (count($contracts) == 0 )
            <div class="d-flex justify-content-center fs-6 form-label fw-bolder text-dark">
                <span>نتیجه ای پیدا نشد</span>
            </div>
        @endif

    </div>

    @if($contracts->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-center ">
                <div class="pagination pagination-outline">
                {{ $contracts->withQueryString()->onEachSide(1)->links() }}
                </div>
            </div>
        </div>
    @endif

</div>
@endsection