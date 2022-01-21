<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Dashboard</title>
</head>
<body>
    <div>Name: {{ Auth::guard('member')->user()->name }}</div>
    <div>Personnel Code: {{ Auth::guard('member')->user()->personnel_code }}</div>
    <div>Hotel ID: {{ Auth::guard('member')->user()->hotel_id }}</div>
    <form action="{{ route('member.logout') }}" method="post">
        @csrf
        <button type="submit">Logout</button>
    </form>
</body>
</html>