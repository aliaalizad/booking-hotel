@extends('user.auth-master')

@section('content')

    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/media/illustrations/forgot-password-rafiki.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>فراموشی رمز عبور</h3>
                    <p style="color: #929292;">برای ایجاد رمز عبور جدید، شماره موبایل خود را وارد کنید</p>

                    <form action="{{ route('user.postForgotPassword') }}" method="post">
                        @csrf

                        <input @class(['form-control' , 'is-invalid' => $errors->has('mobile')]) type="text" name="mobile" required style="text-align: left; font-family: 'Lato', sans-serif;" value="{{ old('mobile', session()->get('user_mobile')) }}">
                        @if ($errors->has('mobile'))
                            @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">تایید</button>
                            <!-- <a class="btn btn-secondary" href="{{ route('user.getAuth') }}">بازگشت</a> -->
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection