<?php

namespace App\Http\Controllers\Web\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $categories = Category::all();
        return view('Admin.Category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('Admin.Category.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
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

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $category = Category::query()->where('id', $id)->first();
        return view('Admin.Category.show', compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $category = Category::query()->where('id', $id)->first();
        return view('Admin.Category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Category::query()->where('id', $id)->delete();
        return redirect()->route('admin.category.index')->with('success', 'Category has been successfully deleted');
    }
}
