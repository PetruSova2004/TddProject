<?php

namespace App\Http\Controllers\Api\Pub\Blog\Services;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Collection;

class BlogService extends Controller
{
    public function getBlogs(): Collection
    {
        $blogs = Blog::query()
            ->select([
                'blogs.id',
                'blogs.title',
                'blogs.created_at',
                'users.name as user_name',
            ])
            ->join('users', 'blogs.user_id', '=', 'users.id')
            ->get();

        foreach ($blogs as $blog) {
            $blog->date = Carbon::parse($blog->created_at)->format('M d, Y');
            $blog->makeHidden(['created_at']);
        }
        return $blogs;
    }



}
