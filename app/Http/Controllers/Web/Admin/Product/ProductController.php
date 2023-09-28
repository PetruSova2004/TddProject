<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Product\Services\ProductService;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{

    private ProductService $service;

    public function __construct(ProductService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $products = Product::all();
        return view('Admin.Product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('Admin.Product.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return $this->service->storeProduct($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $product = Product::query()->where('id', $id)->first();
        return view('Admin.Product.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $product = Product::query()->where('id', $id)->first();
        $categories = Category::all();
        return view('Admin.Product.edit', compact('product', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        return $this->service->updateProduct($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        return $this->service->deleteProduct($id);
    }
}
