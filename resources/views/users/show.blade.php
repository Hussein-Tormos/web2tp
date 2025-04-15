<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Details: {{ $user->first_name }} {{ $user->last_name }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        .detail-item {
            margin-bottom: 10px;
        }

        .detail-item strong {
            display: inline-block;
            width: 100px;
        }

        a {
            color: #007bff;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }
    </style>
</head>

<body>

    <h2>User Details</h2>

    <div class="detail-item">
        <strong>First Name:</strong> {{ $user->first_name }}
    </div>
    <div class="detail-item">
        <strong>Last Name:</strong> {{ $user->last_name }}
    </div>
    <div class="detail-item">
        <strong>Email:</strong> {{ $user->email }}
    </div>
    <div class="detail-item">
        <strong>Gender:</strong> {{ ucfirst($user->gender) }}
    </div>
    <div class="detail-item">
        <strong>Registered:</strong> {{ $user->created_at->format('Y-m-d H:i') }}
    </div>

    <br>
    <a href="{{ route('users.index') }}">&laquo; Back to User List</a>
    |
    <a href="{{ route('users.edit', $user) }}">Edit This User</a>


</body>

</html>
