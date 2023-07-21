<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::query()->create([
            'title' => 'Endeavor Daytripsssa',
            'price' => 1000.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Impulse Duffle',
            'price' => 909.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Driven Backpack',
            'price' => 1758.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Savvy Shoulder Tote',
            'price' => 4584.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Voyage Yoga Bag',
            'price' => 2468.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Wayfarer Messenger Bag',
            'price' => 300.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Impulse Duffle',
            'price' => 1500.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Joust Duffle Bag',
            'price' => 1795.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Fusion Backpack',
            'price' => 1478.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Driven Backpack',
            'price' => 2365.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Voyage Yoga Bag',
            'price' => 9658.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Driven Backpack',
            'price' => 3214.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Arena Cobra Mirror',
            'price' => 2589.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Index Color',
            'price' => 1234.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Wayfarer Messenger Bag',
            'price' => 3214.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);

        Product::query()->create([
            'title' => 'Voyage Yoga Bag',
            'price' => 7412.00,
            'image_path' => '/assets/img/shop/2.webp',
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s",
            'views' => 0,
            'category_id' => mt_rand(6,10),
        ]);
    }
}
