<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>

    <div>Name: {{ Auth::guard('admin')->user()->name }}</div>
    <div>Phone: {{ Auth::guard('admin')->user()->phone }}</div>
    <form action="{{ route('admin.logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
    <a href="{{ route('admin.contracts.index') }}">Contracts</a>
    <a href="{{ route('admin.managers.index') }}">Managers</a>
    <a href="{{ route('admin.members.index') }}">Members</a>

</body>
</html>