<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
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
}
