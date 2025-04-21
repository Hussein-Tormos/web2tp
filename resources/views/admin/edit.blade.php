<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Edit Movie: {{ $movie->title }}</title>
    <style>
        .edit-movie-form {
            padding: 20px;
            max-width: 600px;
            margin: 0 auto;
        }

        .form-group {
            margin-bottom: 15px;
        }

        label {
            display: block;
            margin-bottom: 5px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="number"],
        textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
            min-height: 100px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }

        .error {
            color: red;
            font-size: 0.9em;
            margin-top: 5px;
        }

        .current-thumbnail {
            max-width: 150px;
            height: auto;
            border-radius: 4px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>
    <div class="edit-movie-form">
        <h1>Edit Movie: {{ $movie->title }}</h1>

        @if ($errors->any())
            <div style="color: red;">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form method="POST" action="{{ route('movies.edit', $movie->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="title">Title</label>
                <input type="text" id="title" name="title" value="{{ old('title', $movie->title) }}" required>
                @error('title')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="thumbnail">Current Thumbnail</label>
                @if ($movie->thumbnail)
                    <img src="{{ asset('storage/movies/' . $movie->thumbnail) }}" alt="Current Thumbnail"
                        class="current-thumbnail">
                @else
                    <p>No current thumbnail</p>
                @endif
            </div>

            <div class="form-group">
                <label for="thumbnail">Upload New Thumbnail (optional)</label>
                <input type="file" id="thumbnail" name="thumbnail"
                    accept="image/png, image/jpeg, image/jpg, image/gif, image/svg">
                @error('thumbnail')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="description">Small Description</label>
                <textarea id="description" name="description" rows="3">{{ old('description', $movie->description) }}</textarea>
                @error('description')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="production_year">Production Year</label>
                <input type="number" id="production_year" name="production_year"
                    value="{{ old('production_year', $movie->production_year) }}">
                @error('production_year')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="duration">Duration (in minutes)</label>
                <input type="number" id="duration" name="duration" value="{{ old('duration', $movie->duration) }}">
                @error('duration')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="genre">Genre</label>
                <input type="text" id="genre" name="genre" value="{{ old('genre', $movie->genre) }}">
                @error('genre')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group">
                <label for="synopsis">Synopsis</label>
                <textarea id="synopsis" name="synopsis" rows="5">{{ old('synopsis', $movie->synopsis) }}</textarea>
                @error('synopsis')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit">Update Movie</button>
        </form>
    </div>
</body>

</html>
