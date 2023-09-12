<?php

namespace App\Http\Controllers\Api\Pub\Review\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Pub\Review\ReviewRequest;
use App\Models\Review;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class ReviewService extends Controller
{
    public function createReview(ReviewRequest $request): void
    {
        $user = User::query()->where('id', Auth::user()->getAuthIdentifier())->first();
        Review::query()->insert([
            'user_id' => $user->id,
            'product_id' => $request->input('product_id'),
            'rating' => $request->input('rating'),
            'email' => $request->input('email'),
            'comment' => $request->input('comment'),
        ]);
    }


}
