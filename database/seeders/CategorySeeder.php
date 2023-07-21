<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::query()->create([
            'title' => 'Cats',
            'image_path' => '/assets/img/shop/category/1.webp'
        ]);

        Category::query()->create([
            'title' => 'Fishes',
            'image_path' => '/assets/img/shop/category/2.webp'
        ]);

        Category::query()->create([
            'title' => 'Parrots',
            'image_path' => '/assets/img/shop/category/Iasha.webp'
        ]);

        Category::query()->create([
            'title' => 'Dogs',
            'image_path' => '/assets/img/shop/category/Oscar.webp'
        ]);

        Category::query()->create([
            'title' => 'Rabbits',
            'image_path' => '/assets/img/shop/category/5.webp'
        ]);
    }
}
