@extends('panels.admin.master')

@section('page_title', 'افزودن دسترسی جدید')


@section('breadcrumb')
    <x-panels.header.breadcrumb.menu>
        <x-panels.header.breadcrumb.item name="افزودن دسترسی جدید" muted />
    </x-panels.header.breadcrumb.menu>
@endsection

@section('content')

<form class="form" action="{{ route('admin.permissions.store') }}" method="post">
    @csrf
    <!--begin::Card body-->
    <div class="card-body">
        <!--begin::Row-->
        <div class="row">
            <!--begin::Card-->
            <div class="card card-bordered my-5">

                <!--begin::Card header-->
                <div class="card-header">
                    <div class="card-title fs-3 fw-bolder">
                        <a id="informaion_link" class="btn btn-link" data-bs-toggle="collapse" href="#informaion" aria-expanded="true">مشخصات</a>
                    </div>
                </div>
                <!--end::Card header-->

                <!--begin::Card body-->
                <div class="card-body collapse show" id="informaion">
                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-4">
                            <label for="name" class="form-label d-flex align-items-center">
                                <span class="fs-6 fw-bold mt-2 mb-3  required">نام:</span>
                            </label>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8">
                            <input type="text" id="name" name="name" class="form-control form-control-solid" placeholder="نام دسترسی را وارد کنید"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-4 ">
                            <label for="label" class="form-label d-flex align-items-center">
                                <span class="fs-6 fw-bold mt-2 mb-3  required">توضیحات:</span>
                            </label>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8">
                            <input type="text" id="label" name="label" class="form-control form-control-solid" placeholder="توضیح مختصری راجع به دسترسی وارد کنید"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                    <!--begin::Row-->
                    <div class="row mb-8">
                        <!--begin::Col-->
                        <div class="col-xl-4 ">
                            <label for="guard" class="form-label d-flex align-items-center">
                                <span class="fs-6 fw-bold mt-2 mb-3  required">گارد:</span>
                            </label>
                        </div>
                        <!--end::Col-->
                        <!--begin::Col-->
                        <div class="col-xl-8">
                            <input type="text" id="guard" name="guard" class="form-control form-control-solid" placeholder="گارد را وارد کنید"/>
                        </div>
                        <!--end::Col-->
                    </div>
                    <!--end::Row-->

                </div>
                <!--end::Card body-->
            </div>
            <!--end::Card-->

            <!--begin::Card footer-->
            <div class="card-footer border border-secondary d-flex justify-content-center py-6">
                <button type="submit" class="btn btn-primary">ثبت</button>
            </div>
            <!--end::Card footer-->
        </div>
        <!--end::Row-->
    </div>
    <!--end::Card body-->
</form>
<!--end:Form-->

@endsection