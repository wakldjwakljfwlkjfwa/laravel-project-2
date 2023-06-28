<?php

namespace App\Http\Controllers;

use App\Models\FavoriteMovie;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:3000',
            'release_date' => 'required|date_format:Y-m-d H:i:s',
        ]);

        $user = $request->user();

        $movie = Movie::create([
            'title' => $validated['title'],
            'description' => $validated['description'],
            'release_date' => $validated['release_date'],
            'user_id' => $user->id,
        ]);

        return $movie;
    }

    public function favorite(Request $request)
    {
        $validated = $request->validate([
            'movie_id' => 'required|exists:movies,id',
        ]);
        $user = $request->user();

        $favorite = FavoriteMovie::create([
            'user_id' => $user->id,
            'movie_id' => $validated['movie_id'],
        ]);

        return $favorite;
    }

    public function nonFavoritedMovies(Request $request, User $user)
    {
        $nonFavoritedMovies = Movie::whereDoesntHave('users', function ($query) use ($user) {
            $query->where('user_id', $user->id);
        })->paginate();

        return $nonFavoritedMovies;
    }
}
