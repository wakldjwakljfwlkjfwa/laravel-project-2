<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'email' => 'test1@example.com',
        ]);
        User::factory()->create([
            'email' => 'test2@example.com',
        ]);
        User::factory()->create([
            'email' => 'test3@example.com',
        ]);
    }
}
