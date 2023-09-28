<?php

namespace App\Http\Controllers\Web\Admin\Product;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Category;
use App\Models\Product;
use Exception;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\RedirectResponse;

class ProductController extends Controller
{
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
        $request->validated();
        try {
            $image_file = $request->file('image_file');
            $path = $image_file->store('shop/products', ['disk' => 'image']);

            Product::query()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
                'count' => $request->input('count'),
                'image_path' => "/assets/img/" . $path,
            ]);

            return redirect()->route('admin.product.store')->with('success', 'Product has been successfully added');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
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
        $request->validated();
        try {
            $product = Product::query()->where('id', $id)->first();
            $path = public_path($product->image_path);
            $updatedPath = $request->file('image_file')->store('shop/products', ['disk' => 'image']);

            if (File::exists($path)) {
                File::delete($path);
            }
            $product->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
                'count' => $request->input('count'),
                'image_path' => "/assets/img/" . $updatedPath,
            ]);
            return redirect()
                ->route('admin.product.show', ['product' => $product->id])
                ->with('success', 'Product has been successfully updated');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Product::query()->where('id', $id)->first()->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product has been successfully deleted');
    }
}
