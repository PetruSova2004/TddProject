<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Product::class;

    public function definition(): array
    {
        $categoryIds = Category::query()->pluck('id')->toArray();

        return [
            'title' => fake()->name,
            'price' => fake()->randomFloat(2, 0, 9999.99),
            'image_path' => "/assets/img/shop/1.webp",
            'description' => fake()->text,
            'views' => fake()->numberBetween(1, 100),
            'count' => fake()->numberBetween(1, 250),
            'category_id' => fake()->randomElement($categoryIds),
        ];
    }
}
