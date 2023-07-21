<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
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
            'title' => fake()->title,
            'price' => fake()->randomFloat(2, 0, 9999.99),
            'image_path' => fake()->filePath(),
            'description' => fake()->text,
            'views' => fake()->numberBetween(1, 100),
            'category_id' => fake()->randomElement($categoryIds),
        ];
    }
}
