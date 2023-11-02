<?php

namespace Database\Seeders;

use App\Models\Category;
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
        $catCategory = Category::query()->where('title', 'Cats')->first();
        $fishCategory = Category::query()->where('title', 'Fishes')->first();
        $parrotCategory = Category::query()->where('title', 'Parrots')->first();
        $dogCategory = Category::query()->where('title', 'Dogs')->first();
        $rabbitCategory = Category::query()->where('title', 'Rabbits')->first();

        // Cats
        Product::query()->create([
            'title' => 'Senior',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $catCategory->id,
            'image_path' => 'storage/shop/images/products/cat1.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Brit Care',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $catCategory->id,
            'image_path' => 'storage/shop/images/products/cat2.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Whiskas',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $catCategory->id,
            'image_path' => 'storage/shop/images/products/cat3.webp',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Miratort',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $catCategory->id,
            'image_path' => 'storage/shop/images/products/cat4.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Kitekat',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $catCategory->id,
            'image_path' => 'storage/shop/images/products/cat5.jpeg',
            'count' => 140,
        ]);



        // Dogs

        Product::query()->create([
            'title' => 'Chappi',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog1.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Meat',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog2.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Domus',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog3.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Chappi',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog4.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Royal Canin',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog5.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Brit',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog6.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Friskies',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog7.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Club 4 Paws',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog8.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Pro Plan',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog10.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Probalance',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $dogCategory->id,
            'image_path' => 'storage/shop/images/products/dog11.jpeg',
            'count' => 140,
        ]);



        // Fishes

        Product::query()->create([
            'title' => 'Goldfish',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $fishCategory->id,
            'image_path' => 'storage/shop/images/products/fish1.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'TetraRubin',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $fishCategory->id,
            'image_path' => 'storage/shop/images/products/fish2.jpg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'ZooWorld',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $fishCategory->id,
            'image_path' => 'storage/shop/images/products/fish3.jpeg',
            'count' => 140,
        ]);



        // Parrots

        Product::query()->create([
            'title' => 'Karmeo',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $parrotCategory->id,
            'image_path' => 'storage/shop/images/products/parrot1.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Rio',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $parrotCategory->id,
            'image_path' => 'storage/shop/images/products/parrot2.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Menu',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $parrotCategory->id,
            'image_path' => 'storage/shop/images/products/parrot4.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'RioLite',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $parrotCategory->id,
            'image_path' => 'storage/shop/images/products/parrot3.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Papa Galla',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $parrotCategory->id,
            'image_path' => 'storage/shop/images/products/parrot6.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Vitakraft',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $parrotCategory->id,
            'image_path' => 'storage/shop/images/products/parrot7.jpeg',
            'count' => 140,
        ]);



        // Rabbits

        Product::query()->create([
            'title' => 'Little OMF',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $rabbitCategory->id,
            'image_path' => 'storage/shop/images/products/rabbit1.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Vitakraft',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $rabbitCategory->id,
            'image_path' => 'storage/shop/images/products/rabbit2.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'GrandMix',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $rabbitCategory->id,
            'image_path' => 'storage/shop/images/products/rabbit3.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Happy Jungle',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $rabbitCategory->id,
            'image_path' => 'storage/shop/images/products/rabbit4.jpeg',
            'count' => 140,
        ]);
        Product::query()->create([
            'title' => 'Crisper',
            'price' => 15,
            'description' => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book",
            'views' => 0,
            'category_id' => $rabbitCategory->id,
            'image_path' => 'storage/shop/images/products/rabbit5.jpeg',
            'count' => 140,
        ]);
    }
}
