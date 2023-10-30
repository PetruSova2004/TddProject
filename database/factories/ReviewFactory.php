<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Review;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Review>
 */
class ReviewFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Review::class;

    public function definition(): array
    {
        $user = User::query()->inRandomOrder()->first();
        $productIds = Product::query()->pluck('id')->toArray();

        return [
            'user_id' => $user->id,
            'product_id' => fake()->randomElement($productIds),
            'email' => $user->email,
            'comment' => fake()->text,
        ];
    }
}
