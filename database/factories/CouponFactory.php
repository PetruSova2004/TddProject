<?php

namespace Database\Factories;

use App\Models\Coupon;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $code = function () {
            $x = strtoupper(Str::random(5));
            $exist = Coupon::query()->where('code', $x)->exists();
            if ($exist) {
                do {
                    $x = strtoupper(Str::random(5));
                } while (!Coupon::query()->where('code', $x)->exists());
            }
            return $x;
        };

        return [
            'code' => $code,
            'discount_percent' => fake()->randomNumber(2), // Генерирует случайное число с двумя знаками после десятичной точки
        ];
    }
}
