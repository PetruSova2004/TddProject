<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ZIPSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    function generateRandomNumber($digits): int
    {
        $min = pow(10, $digits - 1); // Минимальное значение для заданного количества цифр
        $max = pow(10, $digits) - 1; // Максимальное значение для заданного количества цифр
        return mt_rand($min, $max); // Генерация случайного числа в заданном диапазоне
    }

    public function run(): void
    {
        $countries = DB::table('country')->get();
        $numberOfDigits = 5;

        foreach ($countries as $country) {
            $randomNumber = $this->generateRandomNumber($numberOfDigits);

            DB::table('country')
                ->where('id', $country->id)
                ->update([
                'ZIP' => $randomNumber,
            ]);
        }
    }
}
