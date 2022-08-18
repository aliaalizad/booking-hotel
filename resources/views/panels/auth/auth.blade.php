@extends('panels.auth.master')


@section('content')
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/media/illustrations/dashboard-pana.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <div class="website-logo-inside">
                        <a href="index.html">
                            <div class="logo">
                                <img class="logo-size" src="/media/images/logo-dark.svg" alt="">
                            </div>
                        </a>
                    </div>

                    <form action="{{ route('panel.postAuth') }}" method="post">
                        @csrf

                        <select class="form-control mb-3" name="role" id="role" dir="rtl">
                            <option selected disabled>نوع کاربری را انتخاب کنید ...</option>
                            <option value="member">مسئول پذیرش</option>
                            <option value="manager">مدیر</option>
                        </select>
                        @if ($errors->has('role'))
                            @error('role')
                                <p class="text-white">{{ $message }}</p>
                            @enderror
                        @endif

                        <input class="form-control" type="text" name="username" placeholder="نام کاربری" required>
                        @if ($errors->has('username'))
                            @error('username')
                                <p class="text-white">{{ $message }}</p>
                            @enderror
                        @endif

                        <input class="form-control" type="password" name="password" placeholder="رمز عبور" required>
                        @if ($errors->has('password'))
                            @error('password')
                                <p class="text-white">{{ $message }}</p>
                            @enderror
                        @endif

                        @if ($errors->has('login'))
                            @error('login')
                                <p class="text-white">{{ $message }}</p>
                            @enderror
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">ورود</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection