@extends('layouts.manager.base')


<!-- page title -->
@section('page_title', 'کارمندان')


<!-- page breadcrumb -->
@section('breadcrumb')

	<ol class="breadcrumb text-muted fs-6 fw-bold">
		<li class="breadcrumb-item pe-3 test-muted">کارمندان</li>
	</ol>

@endsection

@section('content')

<div class="row gy-5 g-x-8">
	<div class="col-xxl">
		<div class="card card-bordered">

			<div class="card-header">
				<h3 class="card-title">لیست کارمندان</h3>
				<div class="card-toolbar">
					<a href="{{ route('manager.members.create') }}" class="btn btn-primary btn-sm" style="margin: 5px;"><i class="bi bi-person-plus-fill"></i>افزودن کارمند جدید</a>
				</div>
			</div>
			
			<div class="card-body">
				<table class="table table-hover table-rounded table-striped border gy-7 gs-7">
					<tr class="fw-bold fs-6 text-gray-800 border-bottom-2 border-gray-200">
						<th>#</th>
						<th>نام و نام خانوادگی</th>
						<th>کد پرسنلی</th>
						<th>وضعیت حساب کاربری</th>
						<th style="width: 18%;"></th>
					</tr>

					@foreach ( $members as $member )
					<tr>
						<th>{{ $loop->iteration }}</th>
						<td>{{ $member->name }}</td>
						<td>{{ $member->personnel_code }}</td>
						<td>
							@if ( ! $member->is_blocked )
								<h4 style="color: green;">فعال</h4>
							@else
								<h4 style="color: red;">غیرفعال</h4>
							@endif
						</td>
						<td><a href="{{ route('manager.members.edit', $member->id) }}" class="btn btn-secondary btn-sm" style="margin: 5px;"><i class="bi bi-pencil-square"></i>ویرایش</a></td>
					</tr>
					@endforeach
					
				</table>

			</div>

			<div class="card-footer">
			</div>

		</div>
	</div>
</div>

@endsection