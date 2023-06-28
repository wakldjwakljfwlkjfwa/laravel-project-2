<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\FavoriteMovie;
use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class MovieControllerTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        $user = User::factory()->create();
        $this->actingAs($user);
        $this->withoutExceptionHandling();
    }

    public function test_movie_store_creates_new_movie(): void
    {
        $response = $this->post(route('api.movies.store'), [
            'title' => 'title 1',
            'description' => 'description 1',
            'release_date' => '2010-04-22 08:51:27',
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseCount('movies', 1);
    }

    public function test_movie_favorite_favorites_a_movie_to_a_user(): void
    {
        $movie = Movie::factory()->create();
        $response = $this->post(route('api.movies.favorite'), [
            'movie_id' => $movie->id,
        ]);

        $response->assertStatus(201);
        $this->assertDatabaseCount('favorite_movies', 1);
    }

    public function test_movie_non_favorited_movies_returns_all_non_favorited_movies(): void
    {
        $user = User::factory()->create();

        FavoriteMovie::factory(2)->create([
            'user_id' => $user->id,
        ]);
        Movie::factory(3)->create();

        $response = $this->get(route('api.movies.non-favorited-movies', [
            'user' => $user->id,
        ]));

        $response->assertStatus(200);
        $response->assertJson(fn (AssertableJson $json) => $json
            ->has('data', 3)
            ->etc()
        );
    }
}
