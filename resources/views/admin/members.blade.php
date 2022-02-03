<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Members</title>
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

    <a href="{{ route('admin.members.create') }}">Add New Member</a>

    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Personnel Code</th>
            <th>Status</th>
            <th>Manager</th>
            <th></th>
        </tr>

        @foreach ( $members as $member )
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $member->name }}</td>
            <td>{{ $member->personnel_code }}</td>
            <td>
                @if ( ! $member->is_blocked )
                      <h4 style="color: green;">Active</h4>
                @else
                      <h4 style="color: red;">Deactive</h4>
                @endif
            </td>
            <td>{{ $member->manager->name . " (" . $member->manager->username . ") " }}</td>
            <td><a href="{{ route('admin.members.edit', $member->id) }}">edit</a></td>
        </tr>
        @endforeach
    </table>


</body>
</html>