<?php

namespace Database\Factories;

use App\Models\Blog;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Blog>
 */
class BlogFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Blog::class;
    public function definition(): array
    {
        $categories = Category::query()->pluck('id')->toArray();
        $users = User::query()->pluck('id')->toArray();
        return [
            'title' => fake()->title,
            'description' => fake()->text,
            'category_id' => fake()->randomElement($categories),
            'user_id' => fake()->randomElement($users),
        ];
    }
}
