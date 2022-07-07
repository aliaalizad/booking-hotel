<!--begin::Card-->
<div class="card card-bordered my-5">

<!--begin::Card header-->
<div class="card-header">
    <div class="card-title fs-3 fw-bolder">
        <a id="permission_link" class="btn btn-link" data-bs-toggle="collapse" href="#permission" aria-expanded="true">نقش ها و دسترسی ها</a>
    </div>
</div>
<!--end::Card header-->

<!--begin::Card body-->
<div class="card-body collapse show" id="permission">
    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-4">
            <label for="roles" class="form-label d-flex align-items-center">
                <span class="fs-6 fw-bold mt-2 mb-3">نقش ها:</span>
            </label>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-8">
            <select name="roles[]" id="roles" class="form-select" data-control="select2" multiple="multiple" data-placeholder="نقش ها را انتخاب کنید" >
                <option></option>
                @foreach ( App\Models\Role::whereGuard("manager")->get() as $role )
                    <option value="{{ $role->id }}" @if(isset($manager)) @selected($manager->roles->contains($role)) @endif > {{ $role->label }} </option>
                @endforeach
            </select>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

    <!--begin::Row-->
    <div class="row mb-8">
        <!--begin::Col-->
        <div class="col-xl-4">
            <label for="permissions" class="form-label d-flex align-items-center">
                <span class="fs-6 fw-bold mt-2 mb-3">دسترسی ها:</span>
            </label>
        </div>
        <!--end::Col-->

        <!--begin::Col-->
        <div class="col-xl-8">
            <select name="permissions[]" id="permissions" class="form-select" data-control="select2" multiple="multiple" data-placeholder="دسترسی ها را انتخاب کنید" >
                <option></option>
                @foreach ( App\Models\Permission::whereGuard("manager")->get() as $permission )
                    <option value="{{ $permission->id }}" @if(isset($manager)) @selected($manager->permissions->contains($permission)) @endif > {{ $permission->label }} </option>
                @endforeach
            </select>
        </div>
        <!--end::Col-->
    </div>
    <!--end::Row-->

</div>
<!--end::Card body-->



</div>
<!--end::Card-->
