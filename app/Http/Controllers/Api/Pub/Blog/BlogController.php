<?php

namespace App\Http\Controllers\Api\Pub\Blog;

use App\Http\Controllers\Api\Pub\Blog\Services\BlogService;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class BlogController extends Controller
{

    private BlogService $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    public function getBlogs(): JsonResponse
    {
        $blogs = $this->service->getBlogs();
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

    public function getRecentBlogs(): JsonResponse
    {
        $blogs = Blog::query()->latest()->take(3)->select([
            'created_at',
            'title',
        ]);
        return ResponseService::sendJsonResponse(true, 200, [], [
            'blogs' => $blogs,
        ]);
    }

}
