<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;


class MovieController extends Controller
{

    public function create()
    {
        return view('movies.create');
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable|string',
            'production_year' => 'nullable|integer|min:1888|max:' . date('Y'),
            'duration' => 'nullable|integer|min:1',
            'genre' => 'nullable|string|max:255',
            'synopsis' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $data = $request->all();

        if ($request->hasFile('thumbnail')) {
            $thumbnail = $request->file('thumbnail');
            $name = time() . '-' . $thumbnail->getClientOriginalName();
            $thumbnail->storeAs('movies', $name, 'public');
            $data['thumbnail'] = $name;
        }
        Movie::create($data);

        return redirect()->route('admin.index')->with('success', 'Movie created successfully!');
    }

    public function index(Request $request)
    {
        $query = Movie::query();

        $searchTitle = $request->input('search_title');

        $query->where('title', 'LIKE', "%{$searchTitle}%")->orWhere('description', 'LIKE', "%{$searchTitle}%");

        $movies = $query->orderBy('created_at', 'desc')->paginate(200);

        return view('movies.index', [
            'movies' => $movies,
            'search_title' => $searchTitle,
        ]);
    }

    public function adminIndex(Request $request)
    {
        $query = Movie::query();

        $searchTitle = $request->input('search_title');

        $query->where('title', 'LIKE', "%{$searchTitle}%")->orWhere('description', 'LIKE', "%{$searchTitle}%");

        $movies = $query->orderBy('created_at', 'desc')->paginate(200);

        return view('admin.index', [
            'movies' => $movies,
            'search_title' => $searchTitle,
        ]);
    }

    public function show(Movie $movie)
    {
        $reviews = $movie->reviews()->with('user')->latest()->get();
        return view('movies.show', compact('movie', 'reviews'));
    }

    public function adminshow(Movie $movie)
    {
        $reviews = $movie->reviews()->with('user')->latest()->get();
        return view('admin.show', compact('movie', 'reviews'));
    }

    public function edit(Movie $movie)
    {
        return view('admin.edit', compact('movie'));
    }

    public function update(Request $request, Movie $movie)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'thumbnail' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg',
            'description' => 'nullable|string',
            'production_year' => 'nullable|integer|min:1888|max:' . date('Y'),
            'duration' => 'nullable|integer|min:1',
            'genre' => 'nullable|string|max:255',
            'synopsis' => 'nullable|string',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $data = $request->except(['_token', '_method']);

        if ($request->hasFile('thumbnail')) {
            if ($movie->thumbnail && Storage::exists('public/movies/' . $movie->thumbnail)) {
                Storage::delete('public/movies/' . $movie->thumbnail);
            }

            $thumbnail = $request->file('thumbnail');
            $name = time() . '-' . $thumbnail->getClientOriginalName();
            $thumbnail->storeAs('movies', $name, 'public');
            $data['thumbnail'] = $name;
        }

        $movie->update($data);

        return redirect()->route('admin.index')->with('success', 'Movie updated successfully!');
    }

    public function destroy(Movie $movie)
    {
        $movie->delete();
        return redirect()->route('admin.index')->with('success', 'Movie deleted successfully!');
    }
}
