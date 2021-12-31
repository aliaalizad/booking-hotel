<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Add Member</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <div class="registration-form">
        <form action="{{ route('admin.member.store') }}" method="post" autocomplete="off">
            @csrf

            <div class="form-icon">
                <span><i class="icon icon-user"></i></span>
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="name" id="name" placeholder="Name" value="{{ old('name') }}">

                @if ($errors->has('name'))
                    @error('name')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="text" class="form-control item" name="username" id="username" placeholder="Username" value="{{ old('username') }}">
                @if ($errors->has('username'))
                    @error('username')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="password" id="password" placeholder="Password" ">
                @if ($errors->has('password'))
                    @error('password')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>
            <div class="form-group">
                <input type="password" class="form-control item" name="cpassword" id="cpassword" placeholder="Confirm Password" ">
                @if ($errors->has('cpassword'))
                    @error('cpassword')
                        <div style="color: red;">{{ $message }}</div>
                    @enderror
                @endif
            </div>


            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Add</button>
            </div>
        </form>

    </div>
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>
