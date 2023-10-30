<?php

namespace App\Http\Controllers\Api\Pub\Review;

use App\Http\Controllers\Api\Pub\Review\Services\ReviewService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Review\ReviewRequest;
use App\Models\Product;
use App\Services\Response\ResponseService;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
        } catch (Exception $exception) {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => $exception->getMessage(),
            ]);
        }
    }

    public function getProductReviews(Request $request): JsonResponse
    {
        $product = Product::query()
            ->where('id', $request->input('product_id'))
            ->first();
        if ($product->reviews->count() > 0) {
            $reviews = $product->reviews->map(function ($review) {
                $time = Carbon::parse($review->created_at)->toDateString();
                $review->setHidden(['updated_at', 'created_at','user_id', 'product_id', 'id',]);
                $review['uploaded_time'] = $time;
                return $review;
            });
            return ResponseService::sendJsonResponse(true, 200, [], [
                'reviews' => $reviews,
                'count' => $reviews->count(),
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 200, [
                'Not Found' => 'There are no reviews for this product',
            ]);
        }
    }

}
