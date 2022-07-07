@extends('layouts.panels.master')


@section('page_title_prefix', 'پنل مسئول پذیرش')


@section('aside_logo', 'مسئول پذیرش')


@section('mobile_logo', 'مسئول پذیرش')


@section('aside-menu-items')
	<x-panels.aside.menu-section name="بخش"/>
	<x-panels.aside.menu-accordion name="منوی آبشاری" icon="bi bi-grid-1x2-fill">
		<x-panels.aside.menu-sub name="زیرمنو 1" route="member.dashboard" />
	</x-panels.aside.menu-accordion>
	<x-panels.aside.menu-item name="منو" route="member.dashboard" icon="bi bi-grid-1x2-fill"/>
@endsection


@section('header_toolbar_name', Auth('member')->user()->name)


@section('header_toolbar_items')
	<x-panels.header.toolbar.menu-item name="منو 1" route="member.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.header.toolbar.menu-item name="منو 2" route="member.dashboard" icon="bi bi-grid-1x2-fill"/>
	<x-panels.header.toolbar.menu-item name="منو 3" route="member.dashboard" icon="bi bi-grid-1x2-fill"/>
@endsection
