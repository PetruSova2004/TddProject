<?php

namespace App\Http\Controllers\Api\Pub\Product\Services;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;

class ProductService extends Controller
{
    public function getProducts(Request $request): Collection
    {
        // Collection является базовым типом для коллекций моделей Eloquent.
        $categoryIds = $request->input('category_id');
        $limit = $request->input('limit');
        $price = $request->input('price');
        $search = $request->input('search');
        $tag = $request->input('tag');
        $query = Product::query();

        if ($categoryIds) {
            $categoryIds = explode(',', $categoryIds); // Преобразуем строку в массив
            $query->whereIn('category_id', $categoryIds);
        }
        if ($price) {
            $query->where('price', '<', $price);
        }
        if ($search) {
            $query->where('title', 'LIKE', $search . '%');
        }
        if ($limit) {
            $query->take($limit);
        }
        if ($tag) {
            $query->whereHas('tags', function ($query) use ($tag) {
                $query->where('title', $tag);
            });
        }

        return $query->get();
    }
}
