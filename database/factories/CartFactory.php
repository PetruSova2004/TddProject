<?php

namespace Database\Factories;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cart>
 */
class CartFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Cart::class;


    public function definition(): array
    {
        $userIds = User::query()->pluck('id')->toArray();
        $productsIds = Product::query()->pluck('id')->toArray();

        return [
            'user_id' => fake()->randomElement($userIds),
            'product_id' => fake()->randomElement($productsIds),
            'quantity' => fake()->numberBetween(1, 100),
        ];
    }
}
