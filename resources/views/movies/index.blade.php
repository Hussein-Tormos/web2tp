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
        }

        .movie-item:hover {
            transform: scale(1.01);
        }

        .movie-thumbnail {
            width: 150px;
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
    </style>
</head>

<body>
    <h1>Movies</h1>

    <div class="search-box">
        <form action="{{ route('movies.index') }}" method="GET">
            <label for="search_title">Title:</label>
            <input type="text" id="search_title" name="search_title" value="{{ $search_title ?? '' }}"
                placeholder="Search">

            <button type="submit">Search</button>
            <a href="{{ route('movies.index') }}" style="margin-left: 10px;">Clear</a>
        </form>
    </div>

    <ul class="movie-list">
        @forelse ($movies as $movie)
            <li class="movie-item">
                <a href="{{ route('movies.show', $movie->id) }}"
                    style="display: flex; align-items: center; text-decoration: none; color: inherit;">
                    <img src="{{ asset('storage/movies/' . $movie->thumbnail) }}" alt="{{ $movie->title }} Thumbnail"
                        class="movie-thumbnail">
                    <div class="movie-info">
                        <h2 class="movie-title">{{ $movie->title }}</h2>
                        <p class="movie-description">{{ Str::limit($movie->description, 150) }}</p>
                    </div>
                </a>
            </li>
        @empty
            <p>No movies available.</p>
        @endforelse
    </ul>

</body>

</html>
