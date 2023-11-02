<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::factory()->count(10)->create();
        $blogs = Blog::all();
        $tags = Tag::query()->inRandomOrder()->limit(3)->pluck('id')->toArray();

        foreach ($blogs as $blog) {
            $blog->tags()->attach($tags);
        }
    }
}
