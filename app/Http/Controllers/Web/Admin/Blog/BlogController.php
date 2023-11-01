<?php

namespace App\Http\Controllers\Web\Admin\Blog;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\StoreRequest;
use App\Http\Requests\Admin\Blog\UpdateRequest;
use App\Models\Blog;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;
use Illuminate\View\View;

class BlogController extends Controller
{
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
        try {
            $request->validated();
            $user = User::query()->where('email', Cookie::get('esem'))->first();
            $blog = Blog::query()->create([
                'title' => $request->input('title'),
                'description' => $request->input('description'),
                'category_id' => $request->input('category_id'),
                'user_id' => $user->id,
            ]);
            foreach ($request->input('tag_id') as $tag) {
                $blog->tags()->attach($tag);
            }
            return redirect()->route('admin.blog.index')->with('success', 'Blog has been successfully created');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
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
        try {
            $data = $request->validated();
            $blog = Blog::query()->where('id', $id)->first();
            $blog->tags()->detach();
            foreach ($request->input('tag_id') as $tag) {
                $blog->tags()->attach($tag);
            }
            $blog->update($data);
            return redirect()->route('admin.blog.index')->with('success', 'Blog has been successfully updated');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Blog::destroy($id);
        return redirect()->back()->with('success', 'Blog has been successfully deleted');
    }
}
