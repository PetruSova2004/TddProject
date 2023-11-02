<?php

namespace App\Http\Controllers\Web\Admin\Blog\Services;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Blog\StoreRequest;
use App\Http\Requests\Admin\Blog\UpdateRequest;
use App\Models\Blog;
use App\Models\User;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Cookie;

class BlogService extends Controller
{
    public function storeBlog(StoreRequest $request): RedirectResponse
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

    public function updateBlog(UpdateRequest $request, string $id): RedirectResponse
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

}
