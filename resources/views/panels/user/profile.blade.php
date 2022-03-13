<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile</title>
</head>
<body>
    <div>Name: {{ Auth::guard('web')->user()->name }}</div>
    <div>Phone: {{ Auth::guard('web')->user()->phone }}</div>
    <form action="{{ route('user.logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>