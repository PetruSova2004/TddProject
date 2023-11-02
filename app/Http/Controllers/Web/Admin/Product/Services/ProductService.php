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
            $fileName = time() . '_' . $image_file->getClientOriginalName();
            $image_file->storeAs("public/shop/images/products/" . $fileName);

            Product::query()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
                'count' => $request->input('count'),
                'image_path' => productImagePath($fileName),
            ]);
            return redirect()->route('admin.product.store')->with('success', 'Product has been successfully added');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    public function updateProduct(UpdateRequest $request, string $id): RedirectResponse
    {
        try {
            $request->validated();
            $product = Product::query()->where('id', $id)->first();
            $path = storage_path($product->image_path);
            $correctedPath = str_replace('/var/www/storage/storage/', '/var/www/storage/app/public/', $path);

            if (File::exists($correctedPath)) {
                File::delete($correctedPath);
            }
            $image_file = $request->file('image_file');
            $fileName = time() . '_' . $image_file->getClientOriginalName();
            $image_file->storeAs("public/shop/images/products/" . $fileName);

            $product->update([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'price' => $request->input('price'),
                'category_id' => $request->input('category_id'),
                'count' => $request->input('count'),
                'image_path' => productImagePath($fileName),
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
        $product = Product::query()->where('id', $id)->first();
        $path = storage_path($product->image_path);
        $correctedPath = str_replace('/var/www/storage/storage/', '/var/www/storage/app/public/', $path);

        if (File::exists($correctedPath)) {
            File::delete($correctedPath);
        }
        $product->delete();
        return redirect()->route('admin.product.index')->with('success', 'Product has been successfully deleted');
    }

}
