<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manager Dashboard</title>
</head>
<body>
    <div>Name: {{ Auth::guard('manager')->user()->name }}</div>
    <div>Email: {{ Auth::guard('manager')->user()->email }}</div>
    <form action="{{ route('manager.logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>

    <a href="{{ route('manager.members.index') }}">Members</a>
</body>
</html>