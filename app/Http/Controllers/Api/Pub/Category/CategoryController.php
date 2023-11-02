<?php

namespace App\Http\Controllers\Api\Pub\Category;

use App\Http\Controllers\Api\Pub\Category\Services\CategoryService;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    private CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

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

    public function popularCategories(): JsonResponse
    {
        $categories = $this->categoryService->getPopularCategories();
        if ($categories->count() > 0) {
            return ResponseService::sendJsonResponse(true, 200, [], [
                'categories' => $categories,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 404, [
                'Error' => 'There are no categories',
            ]);
        }
    }

}
