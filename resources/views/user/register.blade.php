@extends('user.auth-master')

@section('content')

    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="/media/illustrations/mobile-login-pana.svg" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>ثبت نام</h3>
                    <p style="color: #929292;">لطفا اطلاعات زیر را به دقت تکمیل فرمایید</p>
                    <form action="{{ route('user.postRegister') }}" method="post">
                        @csrf

                        <input @class(['form-control' , 'is-invalid' => $errors->has('name')]) type="text" name="name" dir="rtl" required placeholder="نام و نام خانوادگی" value="{{ old('name') }}">
                        @if ($errors->has('name'))
                            @error('name')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        <select name="state" id="state" @class(['form-control', 'mb-3' , 'is-invalid' => $errors->has('state')]) dir="rtl">
                            <option disabled selected>استان</option>
                            @foreach(App\Models\State::all() as $state)
                                <option value="{{ $state->id }}" @selected($state->id == old('state'))>{{ $state->name }}</option>
                            @endforeach
                        </select>
                        @if ($errors->has('state'))
                            @error('state')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif
                        <input @class(['form-control' , 'is-invalid' => $errors->has('password')]) type="password" name="password" required placeholder="رمز عبور">
                        @if ($errors->has('password'))
                            @error('password')
                                <p class="text-danger">{{ $message }}</p>
                            @enderror
                        @endif                        <input class="form-control" type="password" name="password_confirmation" required placeholder="تکرار رمز عبور">
                        <div class="form-button text-center">
                            <button id="submit" type="submit" class="ibtn">تکمیل ثبت نام</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>

@endsection