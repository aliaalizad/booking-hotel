<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/auth/style.css">
    <link rel="stylesheet" href="/css/auth/user.css">

    @stack('styles')

    <title>JaReserve | جارزرو</title>
</head>

<body>
    <div class="form-body" class="container-fluid">
        <div class="website-logo">
            <a href="{{ route('home') }}">
                <div class="logo">
                    <img class="logo-size" src="/media/auth/images/logo.svg" alt="">
                </div>
            </a>
        </div>

        @yield('content')

    </div>

    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/js/auth/popper.js"></script>

    @stack('scripts')
</body>
</html>
