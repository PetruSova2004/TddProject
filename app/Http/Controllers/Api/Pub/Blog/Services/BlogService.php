<?php

namespace App\Http\Controllers\Api\Pub\Blog\Services;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class BlogService extends Controller
{
    public function blogs(): Collection
    {
        $blogs = Blog::query()
            ->select([
                'blogs.id',
                'blogs.title',
                'blogs.created_at',
                'blogs.image_path',
                'users.name as author',
            ])
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->get();

        foreach ($blogs as $blog) {
            $blog->date = Carbon::parse($blog->created_at)->format('M d, Y');
            $blog->makeHidden(['created_at']);
        }
        return $blogs;
    }

    public function recentBlogs(): Collection
    {
        $blogs = Blog::query()->latest()->take(3)->select([
            'created_at',
            'title',
            'description',
        ])->get();

        foreach ($blogs as $blog) {
            $blog->date = Carbon::parse($blog->created_at)->format('M d, Y');
            $blog->makeHidden(['created_at']);

            $words = str_word_count($blog->description, 1);

            $firstSevenWords = implode(' ', array_slice($words, 0, 7));
            $blog->description = $firstSevenWords . "...";
        }
        return $blogs;
    }



}
