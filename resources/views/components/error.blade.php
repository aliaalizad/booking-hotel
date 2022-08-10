@if ( $errors->any() )
    <div class="row">
        <!--begin::Alert-->
        <div class="alert alert-dismissible bg-danger d-flex flex-column flex-sm-row p-5 mb-10">
            <!--begin::Wrapper-->
            <div class="d-flex flex-column text-white pe-0 pe-sm-10">
                @foreach ($errors->all() as $error)
                    <span>{{ $loop->iteration . '. ' . $error }}</span>
                @endforeach
            </div>
            <!--end::Wrapper-->
            <!--begin::Close-->
            <button type="button" class="position-absolute position-sm-relative m-2 m-sm-0 top-0 end-0 btn ms-sm-auto" data-bs-dismiss="alert">
                <i class="bi bi-x-lg text-white"></i>
            </button>
            <!--end::Close-->
        </div>
        <!--end::Alert-->
    </div>
@endif
