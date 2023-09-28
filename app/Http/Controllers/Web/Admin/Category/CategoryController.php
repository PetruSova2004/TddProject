<?php

namespace App\Http\Controllers\Web\Admin\Category;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Category\Services\CategoryService;
use App\Http\Requests\Admin\Category\StoreRequest;
use App\Http\Requests\Admin\Category\UpdateRequest;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\File;
use Illuminate\View\View;

class CategoryController extends Controller
{
    private CategoryService $service;

    public function __construct(CategoryService $service)
    {
        $this->service = $service;
    }

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
        return $this->service->storeCategory($request);
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
        return $this->service->updateCategory($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
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
