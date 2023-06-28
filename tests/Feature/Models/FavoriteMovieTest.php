<?php

namespace Tests\Feature\Models;

use App\Models\FavoriteMovie;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class FavoriteMovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_favorite_movie(): void
    {
        $user = User::factory()->create();
        $movie = Movie::factory()->create();
        $favorite = FavoriteMovie::create([
            'user_id' => $user->id,
            'movie_id' => $movie->id,
        ]);

        $this->assertDatabaseCount('favorite_movies', 1);
        $this->assertEquals($user->id, $favorite->user->id);
        $this->assertEquals($movie->id, $favorite->movie->id);
    }

    public function test_can_create_favorite_movie_using_factory(): void
    {
        FavoriteMovie::factory()->create();

        $this->assertDatabaseCount('favorite_movies', 1);
    }
}
