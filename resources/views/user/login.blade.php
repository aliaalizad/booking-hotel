@extends('user.auth-master')

@section('content')

    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/media/illustrations/my-password-bro.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>رمز عبور خود را وارد کنید</h3>

                    <form action="{{ route('user.postLogin') }}" method="post">
                        @csrf

                        <input @class(['form-control' , 'is-invalid' => $errors->has('password')]) type="password" name="password" required style="text-align: left; font-family: 'Lato', sans-serif;">
                        @if ($errors->has('password'))
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">تایید</button>
                            <a class="btn btn-secondary" href="{{ route('user.getAuth') }}">بازگشت</a>
                        </div>
                    </form>
                    <div style="font-size: 12px">
                        <a href="#">فراموشی رمزعبور</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection