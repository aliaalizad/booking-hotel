<!--begin::Form-->
<form>
    <!--begin::Card-->
    <div class="card mb-7">
        <!--begin::Card body-->
        <div class="card-body">
            <!--begin::Compact form-->
            <div class="d-flex align-items-center">
                <!--begin::Input group-->
                <div class="position-relative w-md-400px me-md-2">
                    <!--begin::Svg Icon | path: icons/duotone/General/Search.svg-->
                    <span class="svg-icon svg-icon-3 svg-icon-gray-500 position-absolute top-50 translate-middle ms-6">
                        <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="24px" height="24px" viewBox="0 0 24 24" version="1.1">
                            <g stroke="none" stroke-width="1" fill="none" fill-rule="evenodd">
                                <rect x="0" y="0" width="24" height="24" />
                                <path d="M14.2928932,16.7071068 C13.9023689,16.3165825 13.9023689,15.6834175 14.2928932,15.2928932 C14.6834175,14.9023689 15.3165825,14.9023689 15.7071068,15.2928932 L19.7071068,19.2928932 C20.0976311,19.6834175 20.0976311,20.3165825 19.7071068,20.7071068 C19.3165825,21.0976311 18.6834175,21.0976311 18.2928932,20.7071068 L14.2928932,16.7071068 Z" fill="#000000" fill-rule="nonzero" opacity="0.3" />
                                <path d="M11,16 C13.7614237,16 16,13.7614237 16,11 C16,8.23857625 13.7614237,6 11,6 C8.23857625,6 6,8.23857625 6,11 C6,13.7614237 8.23857625,16 11,16 Z M11,18 C7.13400675,18 4,14.8659932 4,11 C4,7.13400675 7.13400675,4 11,4 C14.8659932,4 18,7.13400675 18,11 C18,14.8659932 14.8659932,18 11,18 Z" fill="#000000" fill-rule="nonzero" />
                            </g>
                        </svg>
                    </span>
                    <!--end::Svg Icon-->
                    <input type="text" class="form-control form-control-solid ps-10" name="voucher" value="{{ request('voucher') }}" placeholder="جستجو بر اساس شماره رزرو ..." />
                </div>
                <!--end::Input group-->
                <!--begin:Action-->
                <div class="d-flex align-items-center">
                    <button type="submit" class="btn btn-primary me-5">جستجو</button>
                    <a id="search_advanced_link" class="btn btn-link" data-bs-toggle="collapse" href="#search_advanced">جستجوی پیشرفته</a>
                </div>
                <!--end:Action-->
            </div>
            <!--end::Compact form-->
            <!--begin::Advance form-->
            <div class=@if( ! is_null(request('book-from')) or ! is_null(request('book-to')) or ! is_null(request('checkin-from')) or ! is_null(request('checkin-to')) or ! is_null(request('hotels')) or ! is_null(request('amount-from')) or ! is_null(request('amount-to'))  ) {{ "" }} @else {{ 'collapse' }} @endif  id="search_advanced">
                <!--begin::Separator-->
                <div class="separator separator-dashed mt-9 mb-6"></div>
                <!--end::Separator-->

                <!--begin::Row-->
                <div class="row g-8 mb-8">
                    <!--begin::Col-->
                    <div class="col-xxl-5">
                        <label class="fs-6 form-label text-dark">تاریخ ثبت رزرو</label>
                        <div class="row d-flex">
                            <div class="col">
                                <input type="text" class="form-control form-control-solid ps-10 book-date-from" name="book-date-from" readonly value="{{ request('book-date-from') }}" placeholder="از تاریخ ..." />
                                <input type="hidden" name="book-from" value="{{ request('book-from') }}" class="book-date-from-date"/>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-solid ps-10 book-date-to" name="book-date-to" readonly value="{{ request('book-date-to') }}" placeholder="تا تاریخ ..." />
                                <input type="hidden" name="book-to" value="{{ request('book-to') }}" class="book-date-to-date"/>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                    <div class="col-xxl-1"></div>

                    <!--begin::Col-->
                    <div class="col-xxl-5">
                        <label class="fs-6 form-label text-dark">تاریخ پذیرش</label>
                        <div class="row d-flex">
                            <div class="col">
                                <input type="text" class="form-control form-control-solid ps-10 checkin-date-from" name="checkin-date-from" readonly value="{{ request('checkin-date-from') }}" placeholder="از تاریخ ..." />
                                <input type="hidden" name="checkin-from" value="{{ request('checkin-from') }}" class="checkin-date-from-date"/>
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-solid ps-10 checkin-date-to" name="checkin-date-to" readonly value="{{ request('checkin-date-to') }}" placeholder="تا تاریخ ..." />
                                <input type="hidden" name="checkin-to" value="{{ request('checkin-to') }}" class="checkin-date-to-date"/>
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                </div>
                <!--end::Row-->

                <!--begin::Row-->
                <div class="row g-8 mb-8">
                    @if(guard(['admin', 'manager']))
                    <!--begin::Col-->
                    <div class="col-xxl-5">
                        <label class="fs-6 form-label text-dark ">مرکز پذیرش</label>
                        <select name="hotels" class="form-select form-select-solid" data-allow-clear="true" data-control="select2" data-placeholder="مرکز پذیرش  را انتخاب کنید">
                            <option></option>
                            @if(guard('admin'))
                                @foreach (App\Models\Hotel::all() as $hotel)
                                    <option value="{{ $hotel->id }}" @selected(request('hotels') == $hotel->id)>{{ $hotel->name . ' - ' . $hotel->city->name }}</option>
                                @endforeach
                            @endif
                            @if(guard('manager'))
                                @foreach (App\Models\Hotel::where('manager_id', user('manager')->id)->get() as $hotel)
                                    <option value="{{ $hotel->id }}" @selected(request('hotels') == $hotel->id)>{{ $hotel->name . ' - ' . $hotel->city->name }}</option>
                                @endforeach
                            @endif
                        </select>
                    </div>
                    <!--end::Col-->

                    <div class="col-xxl-1"></div>
                    @endif

                    <!--begin::Col-->
                    <div class="col-xxl-5">
                        <label class="fs-6 form-label text-dark">مبلغ رزرو (ریال)</label>
                        <div class="row d-flex">
                            <div class="col">
                                <input type="text" class="form-control form-control-solid ps-10" name="amount-from" value="{{ request('amount-from') }}" placeholder="از ..." />
                            </div>
                            <div class="col">
                                <input type="text" class="form-control form-control-solid ps-10" name="amount-to" value="{{ request('amount-to') }}" placeholder="تا ..." />
                            </div>
                        </div>
                    </div>
                    <!--end::Col-->

                </div>
                <!--end::Row-->

                <div class="row g-8 mt-8 text-center">
                    <div class="col">
                        @if(guard('admin'))
                            <a class="btn btn-secondary" href="{{ route('admin.bookings') }}">بازنشانی</a>
                        @endif
                        @if(guard('manager'))
                            <a class="btn btn-secondary" href="{{ route('manager.bookings') }}">بازنشانی</a>
                        @endif
                        @if(guard('member'))
                            <a class="btn btn-secondary" href="{{ route('member.bookings') }}">بازنشانی</a>
                        @endif
                    </div>
                </div>
                
            </div>
            <!--end::Advance form-->
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
</form>
<!--end::Form-->