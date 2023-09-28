<?php

namespace App\Http\Controllers\Web\Admin\Category\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;

class CategoryService extends Controller
{

    public function storeCategory(StoreRequest $request): RedirectResponse
    {
        $request->validated();
        $image_file = $request->file('image_file');
        $path = $image_file->store('shop/category', ['disk' => 'image']);

        Category::query()->create([
            'title' => $request->input('title'),
            'image_path' => "/assets/img/" . $path,
        ]);

        return redirect()->route('admin.category.index')->with('success', 'Zbs');
    }
    public function updateCategory(UpdateRequest $request, string $id): RedirectResponse
    {
        $request->validated();
        $category = Category::query()->where('id', $id)->first();
        $path = public_path($category->image_path);
        if (File::exists($path)) {
            $updatedPath = $request->file('image_file')->store('shop/category', ['disk' => 'image']);
            File::delete($path);
            $category->update([
                'title' => $request->input('title'),
                'image_path' => "/assets/img/" . $updatedPath,
            ]);
            return redirect()->route('admin.category.index')->with('success', 'Category has been successfully updated');
        } else {
            return redirect()->back()->with('error', 'Something goes wrong');
        }
    }

    public function deleteCategory(string $id): RedirectResponse
    {
        $category = Category::query()->where('id', $id)->first();
        $path = public_path($category->image_path);
        if (File::exists($path)) {
            File::delete($path);
        }
        $category->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category has been successfully deleted');
    }

}
