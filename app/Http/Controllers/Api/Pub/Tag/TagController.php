<?php

namespace App\Http\Controllers\Api\Pub\Tag;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;

class TagController extends Controller
{
    public function getMostPopularTags(): JsonResponse
    {
        $tags = Tag::query()->orderBy('occurrences', 'desc')->take(6)->get();
        return ResponseService::sendJsonResponse(true, 200, [], [
            'tags' => $tags,
        ]);
    }
}
