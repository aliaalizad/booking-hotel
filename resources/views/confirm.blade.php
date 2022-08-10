<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Confirm</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/simple-line-icons/2.4.1/css/simple-line-icons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>

    <div class="registration-form">

        <form action="{{ route( get_prefix() . '.confirm') }}" method="post" autocomplete="off">
            @csrf

            <div class="form-group">
                <input type="text" class="form-control item" name="code" id="code" placeholder="Code" }}">
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-block create-account">Confirm</button>
            </div>

        </form>
        
    </div>


    <script type="text/javascript" src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.15/jquery.mask.min.js"></script>
    <script src="/js/script.js"></script>
</body>
</html>
