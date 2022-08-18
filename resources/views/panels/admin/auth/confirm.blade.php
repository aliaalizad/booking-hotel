@extends('panels.admin.auth.auth-master')

@section('content')


<p class="text-white">کد تایید ارسال شده به شماره موبایلتان را وارد کنید</p>
<form action="{{ route('admin.auth.postConfirm') }}" method="post">
    @csrf

    <input class="form-contoller" type="text" name="code" required style="text-align: left; font-family: 'Lato', sans-serif;">
    @if ($errors->has('code'))
        @error('code')
            <p class="bg-white text-primary">{{ $message }}</p>
        @enderror
    @endif
    <div class="form-button">
        <button id="submit" type="submit" class="ibtn">تایید</button>
        <a class="btn btn-secondary" href="{{ route('admin.auth.getAuth') }}">بازگشت</a>
    </div>
</form>

@endsection