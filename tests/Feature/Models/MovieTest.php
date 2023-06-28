<?php

namespace Tests\Feature\Models;

use App\Models\Movie;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class MovieTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_create_movie_model(): void
    {
        $user = User::factory()->create();

        Movie::create([
            'title' => 'title 1',
            'description' => 'description 1',
            'release_date' => fake()->dateTime(),
            'user_id' => $user->id,
        ]);

        $this->assertDatabaseCount('movies', 1);
    }

    public function test_can_create_movie_model_using_factory(): void
    {
        Movie::factory()->create();

        $this->assertDatabaseCount('movies', 1);
    }
}
