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
        $price = $request->input('price');
        $search = $request->input('search');

        $query = Product::query();

        if ($categoryIds) {
            $categoryIds = explode(',', $categoryIds); // Преобразуем строку в массив
            $query->whereIn('category_id', $categoryIds);
        }
        if ($price) {
            $query->where('price', '<', $price);
        }
        if ($search) {
            $query->where('title', 'LIKE', $search . '%')->get();
        }

        $filteredProducts = $query->get();

        return $filteredProducts;
    }
}
