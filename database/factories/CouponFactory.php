<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */

    protected $model = Coupon::class;

    public function definition(): array
    {
        return [
            'code' => fake()->text(5),
            'discount_percent' => fake()->randomNumber(2), // Генерирует случайное число с двумя знаками после десятичной точки
        ];
    }
}
