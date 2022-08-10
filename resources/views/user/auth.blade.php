@extends('user.auth-master')

@section('content')

    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/media/illustrations/mobile-login-bro.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>ورود | ثبت نام</h3>
                    <p style="color: #929292;">لطفا شماره موبایل خود را وارد کنید</p>
                    <form action="{{ route('user.postAuth') }}" method="post">
                        @csrf

                        <input @class(['form-control' , 'is-invalid' => $errors->has('mobile')]) type="text" name="mobile" required style="text-align: left; font-family: 'Lato', sans-serif;">
                        @if ($errors->has('mobile'))
                            @error('mobile')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">ورود</button>
                        </div>
                    </form>
                    <div style="font-size: 12px">
                        <span>ورود شما به معنای پذیرش <a href="#">شرایط جارزرو</a> و <a href="#">قوانین حریم خصوصی</a> است</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection