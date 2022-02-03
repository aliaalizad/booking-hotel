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

    <a href="{{ route('admin.contracts.create') }}">Add New Contract</a>

    <table>
        <tr>
            <th>#</th>
            <th>Name</th>
            <th>Fee (%)</th>
            <th></th>
        </tr>

        @foreach ( $contracts as $contract )
        <tr>
            <th>{{ $loop->iteration }}</th>
            <td>{{ $contract->name }}</td>
            <td>{{ $contract->fee }}</td>
            <td><a href="{{ route('admin.contracts.edit', $contract->id) }}">edit</a></td>
        </tr>
        @endforeach
    </table>


</body>
</html>