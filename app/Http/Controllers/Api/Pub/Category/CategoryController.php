<?php

namespace App\Http\Controllers\Api\Pub\Category;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function getCategories(): JsonResponse
    {
        $categories = Category::all();
        if ($categories->count() > 0) {
            foreach ($categories as $category) {
                $category['products_count'] = $category->products->count();
                $category->makeHidden('products', 'updated_at', 'created_at');
            }
            return ResponseService::sendJsonResponse(true, 200, [], [
                'categories' => $categories,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 200, [
                'No categories' => 'Sorry, but there categories are not available yet.'
            ]);
        }
    }
}
