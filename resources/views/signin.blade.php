<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign In</title>
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

    <form method="POST" action="{{ route('dosignin') }}">
        @csrf

        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="{{ old('email') }}" required>
            @error('email')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>
            @error('password')
                <div class="alert alert-danger mt-1">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group">
            <button type="submit" class="btn btn-success">Sign in</button>
        </div>
    </form>

    <div class="button-group">
        <p style="display: inline;">Don't have an account?</p>
        <a href="{{ route('signup.form') }}" style="display: inline;">Sign Up</a>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

</body>

</html>
