<?php

namespace App\Http\Controllers\Api\Pub\Blog;

use App\Http\Controllers\Api\Pub\Blog\Services\BlogService;
use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogController extends Controller
{

    private BlogService $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    public function getBlogs(): JsonResponse
    {
        $blogs = $this->service->blogs();
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
        $blogs = $this->service->recentBlogs();
        if ($blogs) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'blogs' => $blogs,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 404, [
                'Error' => 'Invalid blogs receiving'
            ]);
        }
    }

}
