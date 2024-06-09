<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

//        User::factory()->create([
//            "name" => "John Doe",
//            "email" => "john@example.com",
//            "password" => "password",
//            "password_confirmation" => "password"
//        ]);
        Post::factory(10)->create();
        Product::factory(10)->create();
    }
}
