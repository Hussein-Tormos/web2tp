<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User: {{ $user->first_name }} {{ $user->last_name }}</title>
    <style>
        body {
            font-family: sans-serif;
            margin: 20px;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: inline-block;
            width: 150px;
            text-align: right;
            margin-right: 10px;
            vertical-align: top;
        }

        .form-group input[type="text"],
        .form-group input[type="email"] {
            padding: 8px;
            width: 250px;
        }

        .form-group .radio-group label {
            width: auto;
            text-align: left;
            margin-right: 5px;
        }

        .form-group .radio-group input[type="radio"] {
            margin-right: 15px;
            vertical-align: middle;
        }

        button {
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 10px;
        }

        .back-link {
            display: block;
            margin-top: 15px;
        }

        .alert-danger {
            color: #721c24;
            background-color: #f8d7da;
            border-color: #f5c6cb;
            padding: 10px;
            border-radius: 4px;
            margin-bottom: 15px;
        }

        .alert-danger ul {
            margin: 0;
            padding-left: 20px;
        }

        .update-btn {
            margin-left: 165px;
        }
    </style>
</head>

<body>

    <h2>Edit User: {{ $user->first_name }} {{ $user->last_name }}</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops! Something went wrong.</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('users.update', $user) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name', $user->first_name) }}"
                required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name', $user->last_name) }}"
                required>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email', $user->email) }}" required>
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <span class="radio-group">
                {{-- Ensure old value is checked first, then fallback to current user gender --}}
                <input type="radio" id="male" name="gender" value="male"
                    {{ old('gender', $user->gender) == 'male' ? 'checked' : '' }} required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female"
                    {{ old('gender', $user->gender) == 'female' ? 'checked' : '' }}>
                <label for="female">Female</label>
            </span>
        </div>

        <div class="form-group">
            <button type="submit" class="update-btn">Update Info</button>
        </div>

    </form>

    <a href="{{ route('users.index') }}" class="back-link">&laquo; Back to User List</a>

</body>

</html>
