<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ $movie->title }} Details</title>
    <style>
        .movie-container {
            display: flex;
            gap: 20px;
            padding: 20px;
        }

        .movie-info {
            flex: 1;
            max-width: 350px;
            /* Adjust as needed */
        }

        .movie-thumbnail {
            max-width: 100%;
            height: auto;
            border-radius: 4px;
            margin-bottom: 20px;
        }

        .movie-details-text {
            margin-bottom: 10px;
        }

        .movie-synopsis-reviews {
            flex: 2;
        }

        .movie-synopsis {
            margin-bottom: 30px;
            padding: 15px;
            border: 1px solid #eee;
            border-radius: 8px;
        }

        .review-list {
            margin-top: 20px;
            border-top: 1px solid #eee;
            padding-top: 20px;
        }

        .review-card {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 15px;
            margin-bottom: 15px;
            position: relative;
            /* For positioning the delete button */
        }

        .review-title {
            font-size: 1.1em;
            margin-bottom: 5px;
        }

        .review-user-date {
            font-size: 0.9em;
            margin-bottom: 8px;
        }

        .add-review-button {
            display: inline-block;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            margin-top: 20px;
        }

        .delete-review-button {
            position: absolute;
            top: 10px;
            right: 10px;
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 0.8em;
            cursor: pointer;
        }

        .delete-review-button:hover {
            background-color: #c82333;
        }
    </style>
</head>

<body>
    <div class="movie-container">
        <div class="movie-info">
            <h1>{{ $movie->title }} ({{ $movie->production_year }})</h1>
            <img src="{{ asset('storage/movies/' . $movie->thumbnail) }}" alt="{{ $movie->title }} Thumbnail"
                class="movie-thumbnail">
            <p class="movie-details-text"><strong>Duration:</strong> {{ $movie->duration }} minutes</p>
            <p class="movie-details-text"><strong>Genre:</strong> {{ $movie->genre }}</p>
        </div>
        <div class="movie-synopsis-reviews">
            <div class="movie-synopsis">
                <h3>Synopsis</h3>
                <p>{{ $movie->synopsis }}</p>
            </div>

            <div class="review-list">
                <h2>Reviews</h2>
                @forelse ($reviews as $review)
                    <div class="review-card">
                        <p class="review-user-date">{{ $review->user->first_name }} {{ $review->user->last_name }} -
                            {{ $review->title }} ({{ $review->rating }})</p>
                        <p class="review-content">{{ $review->content }}</p>
                        <p>{{ $review->created_at->format('Y-m-d H:i') }}</p>
                        @auth
                            @if (Auth::user()->is_admin)
                                <form action="{{ route('reviews.destroy', $review->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="delete-review-button"
                                        onclick="return confirm('Are you sure you want to delete this review?')">Delete</button>
                                </form>
                            @endif
                        @endauth
                    </div>
                @empty
                    <p>No reviews yet.</p>
                @endforelse
            </div>
        </div>
    </div>
</body>

</html>
