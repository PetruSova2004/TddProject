<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Tag::query()->create([
            'title' => 'Pets',
        ]);
        Tag::query()->create([
            'title' => 'Animals',
        ]);
        Tag::query()->create([
            'title' => 'Dogs',
        ]);
        Tag::query()->create([
            'title' => 'Cats',
        ]);
        Tag::query()->create([
            'title' => 'Birds',
        ]);
        Tag::query()->create([
            'title' => 'Small Pets',
        ]);
        Tag::query()->create([
            'title' => 'Fish',
        ]);
        Tag::query()->create([
            'title' => 'Reptiles',
        ]);
        Tag::query()->create([
            'title' => 'Dry Food',
        ]);
        Tag::query()->create([
            'title' => 'Wet Food',
        ]);
        Tag::query()->create([
            'title' => 'Natural Products',
        ]);
        Tag::query()->create([
            'title' => 'Toys',
        ]);
        Tag::query()->create([
            'title' => 'Clothing',
        ]);
        Tag::query()->create([
            'title' => 'Budget-friendly',
        ]);
        Tag::query()->create([
            'title' => 'Premium',
        ]);
        Tag::query()->create([
            'title' => 'Clearance',
        ]);
        Tag::query()->create([
            'title' => 'New Arrivals',
        ]);
        Tag::query()->create([
            'title' => 'Seasonal Deals',
        ]);
    }
}
