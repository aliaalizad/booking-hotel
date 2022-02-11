@extends('layouts.panels.master')


@section('page_title_prefix', 'پنل مدیریت وبسایت')


@section('aside_logo', 'مدیریت وبسایت')


@section('mobile_logo', 'مدیریت وبسایت')


@section('aside-menu-items')
	<x-panels.aside.menu-section name="امور مالی"/>
	<x-panels.aside.menu-item name="منو" route="admin.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.aside.menu-section name="امور فنی"/>
	<x-panels.aside.menu-item name="منو" route="admin.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.aside.menu-section name="امور اداری"/>
	<x-panels.aside.menu-accordion name="منوی آبشاری" icon="bi bi-grid-1x2-fill">
		<x-panels.aside.menu-sub name="زیرمنو 1" route="admin.dashboard" />
		<x-panels.aside.menu-sub name="زیرمنو 2" route="admin.dashboard" />
		<x-panels.aside.menu-sub name="زیرمنو 3" route="admin.dashboard" />
	</x-panels.aside.menu-accordion>
@endsection


@section('header_toolbar_name', Auth('admin')->user()->name)


@section('header_toolbar_items')
	<x-panels.header.toolbar.menu-item name="منو 1" route="admin.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.header.toolbar.menu-item name="منو 2" route="admin.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.header.toolbar.menu-item name="منو 3" route="admin.dashboard" icon="bi bi-grid-1x2-fill"/>
@endsection