<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registered Users</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }

        tr:hover {
            background-color: #f5f5f5;
            cursor: pointer;
        }

        .actions form {
            display: inline-block;
            margin: 0 2px;
        }

        .actions button {
            padding: 3px 6px;
            cursor: pointer;
        }

        .actions .edit-btn {
            background-color: #ffc107;
            border: none;
            color: black;
            border-radius: 3px;
        }

        .actions .edit-link {
            padding: 3px 6px;
            background-color: #ffc107;
            border: none;
            color: black;
            border-radius: 3px;
            text-decoration: none;
            display: inline-block;
            vertical-align: middle;
            font-size: 14px;
            line-height: normal;
        }

        .actions .delete-btn {
            background-color: #dc3545;
            border: none;
            color: white;
            border-radius: 3px;
        }

        .pagination {
            margin-top: 20px;
        }

        .search-box {
            border: 1px solid #ccc;
            padding: 15px;
            margin-bottom: 20px;
            background-color: #f9f9f9;
        }

        .search-box label {
            margin-right: 5px;
        }

        .search-box input[type="text"] {
            padding: 5px;
            margin-right: 10px;
        }

        .search-box button {
            padding: 5px 10px;
        }

        .alert {
            padding: 15px;
            margin-bottom: 20px;
            border: 1px solid transparent;
            border-radius: 4px;
        }

        .alert-success {
            color: #155724;
            background-color: #d4edda;
            border-color: #c3e6cb;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
        }
    </style>
</head>

<body>

    <h2>Registered Users</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    @if (session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="search-box">
        <form action="{{ route('users.index') }}" method="GET">
            <label for="search_name">Name:</label>
            <input type="text" id="search_name" name="search_name" value="{{ $search_name ?? '' }}"
                placeholder="First or Last Name">

            <label for="search_email">Email:</label>
            <input type="text" id="search_email" name="search_email" value="{{ $search_email ?? '' }}"
                placeholder="Email Address">

            <button type="submit">Search</button>
            <a href="{{ route('users.index') }}" style="margin-left: 10px;">Clear</a>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                {{-- Make row clickable, pointing to the user details page --}}
                <tr onclick="window.location='{{ route('users.show', $user) }}';">
                    <td>{{ $user->first_name }}</td>
                    <td>{{ $user->last_name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ ucfirst($user->gender) }}</td> {{-- ucfirst to capitalize gender --}}
                    <td class="actions" onclick="event.stopPropagation();"> {{-- Stop propagation prevents row click --}}

                        <a href="{{ route('users.edit', $user) }}" class="edit-link">Edit</a>

                        <form action="{{ route('users.destroy', $user) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="delete-btn"
                                onclick="return confirm('Are you sure you want to delete {{ $user->first_name }} {{ $user->last_name }}?');">Delete</button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td colspan="5">No users found.</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    <div class="pagination">
        {{ $users->appends(request()->query())->links() }} {{-- appends() keeps search query parameters in pagination links --}}
    </div>

</body>

</html>
