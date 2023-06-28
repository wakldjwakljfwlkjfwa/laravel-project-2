<?php

namespace App\Http\Controllers;

use App\Models\Movie;
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
}
