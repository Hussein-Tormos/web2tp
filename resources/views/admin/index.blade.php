<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Available Movies</title>
    <style>
        .movie-list {
            list-style: none;
            padding: 0;
            margin: 20px;
        }

        .movie-item {
            display: flex;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 15px;
            padding: 15px;
            align-items: center;
            transition: transform 0.3s ease;
            justify-content: space-between;
            /* Distribute space between elements */
        }

        .movie-item:hover {
            transform: scale(1.01);
        }

        .movie-thumbnail-link {
            /* To contain image and title/description */
            display: flex;
            align-items: center;
            text-decoration: none;
            color: inherit;
            flex-grow: 1;
            /* Allow it to take up more space */
        }

        .movie-thumbnail {
            width: 100px;
            /* Adjusted size */
            height: auto;
            border-radius: 4px;
            margin-right: 15px;
            display: block;
        }

        .movie-info {
            flex-grow: 1;
        }

        .movie-title {
            font-size: 1.2em;
            margin-bottom: 5px;
        }

        .movie-description {
            font-size: 0.9em;
            color: #555;
        }

        .movie-actions {
            display: flex;
            gap: 10px;
            /* Space between buttons */
        }

        .edit-button,
        .delete-button {
            padding: 8px 12px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 0.9em;
        }

        .edit-button {
            background-color: #007bff;
            color: white;
        }

        .delete-button {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>

<body>
    <h1>Admin Movies</h1>

    <div class="search-box">
        <form action="{{ route('admin.index') }}" method="GET">
            <label for="search_title">Title:</label>
            <input type="text" id="search_title" name="search_title" value="{{ $search_title ?? '' }}"
                placeholder="Search">

            <button type="submit">Search</button>
            <a href="{{ route('admin.index') }}" style="margin-left: 10px;">Clear</a>
        </form>
    </div>

    <ul class="movie-list">
        @forelse ($movies as $movie)
            <li class="movie-item">
                <div class="movie-thumbnail-link">
                    <a href="{{ route('admin.show', $movie->id) }}">
                        <img src="{{ asset('storage/movies/' . $movie->thumbnail) }}"
                            alt="{{ $movie->title }} Thumbnail" class="movie-thumbnail">
                    </a>
                    <div class="movie-info">
                        <a href="{{ route('admin.show', $movie->id) }}" style="text-decoration: none; color: inherit;">
                            <h2 class="movie-title">{{ $movie->title }}</h2>
                            <p class="movie-description">{{ Str::limit($movie->description, 150) }}</p>
                        </a>
                    </div>
                </div>
                <div class="movie-actions">
                    <a href="{{ route('movies.update', $movie->id) }}" class="edit-button">Edit</a>
                    <form action="{{ route('movies.destroy', $movie->id) }}" method="POST" style="display: inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="delete-button"
                            onclick="return confirm('Are you sure you want to delete this movie?')">Delete</button>
                    </form>
                </div>
            </li>
        @empty
            <p>No movies available.</p>
        @endforelse
    </ul>
    <div>
        <a href="{{ route('movies.create') }}" class="add-movie-button">Add Movie</a>
    </div>

</body>

</html>
