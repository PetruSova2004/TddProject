<?php

namespace App\Http\Controllers\Web\Admin\Tag;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tag\StoreRequest;
use App\Http\Requests\Admin\Tag\UpdateRequest;
use App\Models\Tag;
use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $tags = Tag::all();
        return view('Admin.Tag.index', compact('tags'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        return view('Admin.Tag.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): RedirectResponse
    {
        try {
            $request->validated();
            Tag::query()->create([
                'title' => $request->input('title'),
                'occurrences' => $request->input('occurrences'),
            ]);
            return redirect()->route('admin.tag.index')->with('success', 'Tag has been successfully added');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): View
    {
        $tag = Tag::find($id);
        return view('Admin.Tag.show', compact('tag'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        $tag = Tag::find($id);
        return view('Admin.Tag.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): RedirectResponse
    {
        try {
            $data = $request->validated();
            $tag = Tag::find($id);
            $tag->update($data);
            return redirect()->route('admin.tag.index')->with('success', 'Tag has been successfully updated');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): RedirectResponse
    {
        try {
            Tag::query()->where('id', $id)->delete();
            return redirect()->route('admin.tag.index')->with('success', 'Tag has been successfully deleted');
        } catch (Exception $exception) {
            return redirect()->back()->with('error', $exception->getMessage());
        }
    }
}
