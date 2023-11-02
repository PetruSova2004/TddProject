<?php

namespace App\Http\Controllers\Web\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Web\Admin\Blog\Services\BlogService;
use App\Http\Requests\Admin\Blog\StoreRequest;
use App\Http\Requests\Admin\Blog\UpdateRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BlogController extends Controller
{

    private BlogService $service;

    public function __construct(BlogService $service)
    {
        $this->service = $service;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $blogs = Blog::all();
        return view('Admin.Blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        $tags = Tag::all();
        return view('Admin.Blog.create', compact('categories', 'tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        return $this->service->storeBlog($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $blog = Blog::query()->where('id', $id)->first();
        return view('Admin.Blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $blog = Blog::query()->where('id', $id)->first();
        $categories = Category::all();
        $users = User::all();
        $tags = Tag::all();
        return view('Admin.Blog.edit', compact('blog', 'categories', 'users', 'tags'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        return $this->service->updateBlog($request, $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        Blog::destroy($id);
        return redirect()->route('admin.blog.index')->with('success', 'Blog has been successfully deleted');
    }
}
