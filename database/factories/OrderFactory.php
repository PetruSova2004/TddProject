<?php

namespace Database\Factories;

use App\Models\Country;
use App\Models\Order;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\Artisan;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Order::class;

    public function definition(): array
    {
        $userIds = User::query()->pluck('id')->toArray();
        $zips = Country::query()->pluck('zip')->toArray();

        return [
            'user_id' => fake()->randomElement($userIds),
            'firstname' => fake()->firstName,
            'lastname' => fake()->lastName,
            'email' => fake()->email,
            'phone' => fake()->phoneNumber,
            'price' => fake()->randomNumber(),
            'company' => fake()->company,
            'country' => fake()->country,
            'address' => fake()->address,
            'city' => fake()->city,
            'zip' => fake()->randomElement($zips),
            'ordered_products' => json_encode([
                [
                    'product_name' => 'Product A',
                    'quantity' => 2,
                    'price' => 10.99,
                ],
                [
                    'product_name' => 'Product B',
                    'quantity' => 7,
                    'price' => 150.99,
                ],
            ]),
        ];
    }
}
