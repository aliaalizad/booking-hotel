@extends('user.auth-master')

@section('content')

    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/media/illustrations/reset-password-bro.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>بازنشانی رمز عبور</h3>
                    <p style="color: #929292;">رمز عبور جدید را وارد کنید</p>

                    <form action="{{ route('user.postResetPassword') }}" method="post">
                        @csrf

                        <input @class(['form-control' , 'is-invalid' => $errors->has('password')]) type="password" name="password" required placeholder="رمز عبور">
                        @if ($errors->has('password'))
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        <input class="form-control" type="password" name="password_confirmation" required placeholder="تکرار رمز عبور">
                        <div class="form-button text-center">
                            <button id="submit" type="submit" class="ibtn">تایید</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection