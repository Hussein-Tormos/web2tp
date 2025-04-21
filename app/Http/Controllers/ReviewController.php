<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ReviewController extends Controller
{
    public function create(Movie $movie)
    {
        return view('movies/reviews', compact('movie'));
    }

    public function store(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'rating' => 'required|integer|min:1|max:5',
            'content' => 'required|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $review = new Review([
            'title' => $request->input('title'),
            'rating' => $request->input('rating'),
            'content' => $request->input('content'),
            'user_id' => Auth::id(),
        ]);

        $movie->reviews()->save($review);

        return redirect()->route('movies.show', $movie->id)->with('success', 'Your review has been added!');
    }

    public function destroy(Review $review)
    {
        $movieId = $review->movie_id;
        $review->delete();
        return redirect()->route('admin.show', $movieId)->with('success', 'Review deleted successfully!');
    }
}
