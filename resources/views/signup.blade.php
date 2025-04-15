<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up</title>
    <style>
        body {
            font-family: sans-serif;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: inline-block;
            width: 150px;
            text-align: right;
            margin-right: 10px;
            vertical-align: middle;
        }

        .form-group input[type="text"],
        .form-group input[type="email"],
        .form-group input[type="password"] {
            padding: 8px;
            width: 250px;
            vertical-align: middle;
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

        button {
            padding: 10px 20px;
            margin-left: 165px;
            cursor: pointer;
        }

        .button-group {
            margin-top: 20px;

        }

        .button-group button {
            margin: 0 10px;
        }

        ul {
            list-style-type: none;
            padding-left: 165px;
            color: red;
        }
    </style>
</head>

<body>

    <h2>Welcome to our site</h2>

    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

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

    <form method="POST" action="{{ route('signup.store') }}">
        @csrf

        <div class="form-group">
            <label for="first_name">First Name:</label>
            <input type="text" id="first_name" name="first_name" value="{{ old('first_name') }}" required>
        </div>

        <div class="form-group">
            <label for="last_name">Last Name:</label>
            <input type="text" id="last_name" name="last_name" value="{{ old('last_name') }}" required>
        </div>

        <div class="form-group">
            <label>Gender:</label>
            <span class="radio-group">
                <input type="radio" id="male" name="gender" value="male"
                    {{ old('gender') == 'male' ? 'checked' : '' }} required>
                <label for="male">Male</label>
                <input type="radio" id="female" name="gender" value="female"
                    {{ old('gender') == 'female' ? 'checked' : '' }}>
                <label for="female">Female</label>
            </span>
        </div>

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
            <label for="password_confirmation">Confirm Password:</label>
            <input type="password" id="password_confirmation" name="password_confirmation" required>
        </div>

        <div class="form-group">
            <button type="submit">Register</button>
        </div>
    </form>
    <div class="button-group">
        <button type="button" onclick="window.location='{{ route('users.index') }}'">View Users</button>
    </div>

</body>

</html>
