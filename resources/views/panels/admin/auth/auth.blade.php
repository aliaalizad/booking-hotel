@extends('panels.admin.auth.auth-master')

@section('content')



<form action="{{ route('admin.auth.postAuth') }}" method="post">
    @csrf
    
    <input class="form-control" type="text" name="username" autocomplete="off" placeholder="نام کاربری" required>
    <input class="form-control" type="password" name="password" placeholder="رمز عبور" required>
    <div class="form-button">

    @if ($errors->has('login'))
        @error('login')
            <p class="bg-white text-primary">{{ $message }}</p>
        @enderror
    @endif

        <button id="submit" type="submit" class="ibtn">ورود</button>
    </div>
</form>



@endsection