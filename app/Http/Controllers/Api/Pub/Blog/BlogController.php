<?php

namespace App\Http\Controllers\Api\Pub\Blog;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\User;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function getBlogs(): JsonResponse
    {
        $blogs = Blog::query()->select([
            'title',
            'created_at',
            'user_id',
        ])->get();

        foreach ($blogs as $blog) {
            $user = User::query()->where('id', $blog->user_id)->first();
            $blog->user_name = '';
        }

        if ($blogs->count() > 0) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'blogs' => $blogs,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Empty' => 'There are no blogs in your request',
            ]);
        }
    }

    public function getBlogDetails(Request $request): JsonResponse
    {
        $blog = Blog::query()
            ->where('id', $request->input('id'))
            ->first();
        if ($blog) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'Blog' => $blog,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Error' => 'Something goes wrong',
            ]);
        }
    }

}
