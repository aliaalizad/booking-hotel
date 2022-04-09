<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotels</title>
</head>

<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

tr:nth-child(even) {
  background-color: #dddddd;
}
</style>

<body>

    <a href="{{ route('manager.hotels.create') }}">Add New Hotel</a>

    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Phone</th>
            <th>City</th>
            <th>Address</th>
            <th></th>
        </tr>

        @foreach ( $hotels as $hotel )
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $hotel->name }}</td>
            <td>{{ $hotel->phone }}</td>
            <td>{{ $hotel->city_id }}</td>
            <td>{{ $hotel->address }}</td>
            <td><a href="{{ route('manager.hotels.edit', $hotel->id) }}">edit</a></td>
        </tr>
        @endforeach
        
    </table>


</body>
</html>