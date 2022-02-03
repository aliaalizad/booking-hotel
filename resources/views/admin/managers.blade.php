<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Managers</title>
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

    <a href="{{ route('admin.managers.create') }}">Add New Manager</a>

    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Username</th>
            <th>Province</th>
            <th>Status</th>
            <th></th>
        </tr>

        @foreach ( $managers as $manager )
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $manager->name }}</td>
            <td>{{ $manager->username }}</td>
            <td>{{ $manager->province }}</td>
            <td>
                @if ( ! $manager->is_blocked )
                      <h4 style="color: green;">Active</h4>
                @else
                      <h4 style="color: red;">Deactive</h4>
                @endif
            </td>
            <td><a href="{{ route('admin.managers.edit', $manager->id) }}">edit</a></td>
        </tr>
        @endforeach
    </table>


</body>
</html>