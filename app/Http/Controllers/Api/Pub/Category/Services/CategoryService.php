<?php

namespace App\Http\Controllers\Api\Pub\Category\Services;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class CategoryService extends Controller
{
    public function getPopularCategories(): Collection
    {
        return Category::query()->select('categories.id', 'categories.title', DB::raw('COUNT(products.id) as product_count'))
            ->leftJoin('products', 'categories.id', '=', 'products.category_id')
            ->groupBy('categories.id', 'categories.title')
            ->orderByDesc('product_count')
            ->take(5)
            ->get();
    }
}
