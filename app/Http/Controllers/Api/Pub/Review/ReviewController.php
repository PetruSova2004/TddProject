<?php

namespace App\Http\Controllers\Api\Pub\Review;

use App\Http\Controllers\Api\Pub\Review\Services\ReviewService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Review\ReviewRequest;
use App\Services\Response\ResponseService;
use Exception;
use Illuminate\Http\JsonResponse;

class ReviewController extends Controller
{
    private ReviewService $service;

    public function __construct(ReviewService $service)
    {
        $this->service = $service;
    }

    public function apply(ReviewRequest $request): JsonResponse
    {
        $request->validated();
        try {
            $this->service->createReview($request);
            return ResponseService::sendJsonResponse(true, 200, [], [
                'success' => 'Your review has been added successfully',
            ]);
        }catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => $exception->getMessage(),
            ]);
        }
    }
}
