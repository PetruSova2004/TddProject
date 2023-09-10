<?php

namespace App\Http\Controllers\Api\Pub\Product;

use App\Http\Controllers\Api\Pub\Product\Services\ProductService;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Services\Response\ResponseService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    public function getProducts(Request $request): JsonResponse
    {
        $products = $this->service->getProducts($request);

        if ($products->count() > 0) {
            foreach ($products as $product) {
                $product['category_title'] = $product->category->title;
                $product->makeHidden('category', 'created_at', 'updated_at', 'category_id');
            }

            return ResponseService::sendJsonResponse(true, 200, [], [
                'products' => $products,
            ]);

        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'Products Issue' => 'Oops, something is bad with your products',
            ]);
        }
    }

    public function getProduct(Request $request): JsonResponse
    {
        $id = $request->input('id');
        $product = Product::query()->where('id', $id)->first();

        if ($product) {
            $product->views += 1;
            $product->save();
            $product['category_title'] = $product->category->title;
            $product->makeHidden('created_at', 'updated_at', 'category');
            return ResponseService::sendJsonResponse(true, 200, [], [
                'product' => $product,
            ]);
        } else {
            return ResponseService::sendJsonResponse(false, 400, [
                'error' => 'Something is wrong with your requested product',
            ]);
        }
    }

}
