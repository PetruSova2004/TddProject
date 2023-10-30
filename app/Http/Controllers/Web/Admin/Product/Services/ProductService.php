<?php

namespace App\Http\Controllers\Web\Admin\Product\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\StoreRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Product;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class ProductService extends Controller
{
    public function storeProduct(StoreRequest $request): RedirectResponse
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

    public function updateProduct(UpdateRequest $request, string $id): RedirectResponse
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

    public function deleteProduct(string $id): RedirectResponse
    {
        Product::query()->where('id', $id)->first()->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product has been successfully deleted');
    }

}
