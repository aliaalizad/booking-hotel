@extends('layouts.panels.master')


@section('page_title_prefix', 'پنل مدیریت مراکز')


@section('aside_logo', 'مدیریت مراکز')


@section('mobile_logo', 'مدیریت مراکز')


@section('aside-menu-items')

	<x-panels.aside.menu-item name="داشبورد" route="manager.dashboard" icon="bi bi-grid-1x2-fill"/>

	<x-panels.aside.menu-section name=""/>

		<x-panels.aside.menu-item name="مراکز اقامتی" route="manager.hotels.index" icon="bi bi-house-fill"/>

		<x-panels.aside.menu-item name="کارمندان" route="manager.members.index" icon="bi bi-person-lines-fill"/>

		<x-panels.aside.menu-item name="لیست رزروها" route="manager.bookings" icon="bi bi-card-list"/>
	
	<x-panels.aside.menu-section name=""/>

		<x-panels.aside.menu-accordion name="گزارشات" icon="bi bi-bar-chart-line-fill">

			<x-panels.aside.menu-accordion name="درآمد" icon="bi bi-dot">

				<x-panels.aside.menu-sub name="تحلیل" route="manager.reports.income.analysis" />

				<x-panels.aside.menu-accordion name="لیست" icon="bi bi-dot">

					<x-panels.aside.menu-sub name="روزانه" route="manager." />

					<x-panels.aside.menu-sub name="ماهانه" route="manager.reports.income.monthlyList" />

				</x-panels.aside.menu-accordion>



			</x-panels.aside.menu-accordion>

		</x-panels.aside.menu-accordion>

@endsection


@section('header_toolbar_name', Auth('manager')->user()->name)


@section('header_toolbar_items')
	<x-panels.header.toolbar.menu-item name="منو 1" route="manager.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.header.toolbar.menu-item name="منو 2" route="manager.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.header.toolbar.menu-item name="منو 3" route="manager.dashboard" icon="bi bi-grid-1x2-fill"/>
@endsection