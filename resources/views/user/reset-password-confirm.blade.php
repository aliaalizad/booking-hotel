@extends('user.auth-master')

@section('content')

    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/media/illustrations/enter-OTP-bro.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>کد تایید را وارد کنید</h3>
                    @php
                        $phone = session()->get('forgotten_user_mobile')
                    @endphp
                    <p style="color: #929292;">کد تایید برای بازنشانی رمز عبور حساب کاربری به شماره موبایل {{ $phone }} ارسال گردید</p>
                    <form action="{{ route('user.postResetPasswordConfirm') }}" method="post">
                        @csrf

                        <input @class(['form-control' , 'is-invalid' => $errors->has('code'), 'is-invalid' => $errors->has('invalidCode')]) type="text" name="code" required style="text-align: left; font-family: 'Lato', sans-serif;">
                        @if ($errors->has('code'))
                            @error('code')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        @if ($errors->has('invalidCode'))
                            @error('invalidCode')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">ادامه</button>
                            <a class="btn btn-secondary" href="{{ route('user.getForgotPassword') }}">بازگشت</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

