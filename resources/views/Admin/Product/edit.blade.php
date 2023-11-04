@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="d-flex justify-content-between">
        <h1>Dashboard</h1>
        <a href="{{ route('admin.product.create') }}" class="btn btn-info btn-sm">
            <i class="fas fa-plus"></i> Create
        </a>
    </div>
@stop

@section('content')
    <section class="content">
        @include('Pub.layouts.alerts')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <form role="form" method="post" action="{{ route('admin.product.update', ['product' => $product->id]) }}" enctype="multipart/form-data">
                                @csrf
                                @method('PUT')
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="title">Title</label>
                                            <input type="text" class="form-control" name="title" value="{{ $product->title }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Description</label>
                                            <input type="text" class="form-control" name="description" value="{{ $product->description }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Price</label>
                                            <input class="form-control" name="price" value="{{ $product->price }}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="category_id">Category</label>
                                            <select class="form-control" id="category_id" name="category_id">
                                                @foreach($categories as $category)
                                                    <option value="{{ $category->id }}" @if($category->title === $product->category->title) selected @endif>{{ $category->title }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="count">Count</label>
                                            <input type="number" class="form-control" name="count" value="{{ $product->count }}">
                                        </div>

                                        <div class="form-group">
                                            <label>Tags</label><br>
                                            @foreach($tags as $tag)
                                                <div class="form-check d-inline-block mr-2 mb-2">
                                                    <input class="form-check-input" type="checkbox"
                                                           name="tag_id[]"
                                                           value="{{ $tag->id }}" id="tag{{ $tag->id }}"
                                                        {{ $product->tags->contains($tag->id) ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="tag{{ $tag->id }}">
                                                        {{ $tag->title }}
                                                    </label>
                                                </div>
                                            @endforeach
                                        </div>

                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="image_file">Choose Image</label>
                                            <input type="file" name="image_file" class="form-control-file @error('image_file') is-invalid @enderror" id="image_file">
                                            @error('image_file')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary">Save</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script src="/assets/js/admin/footerSettings.js"></script>
@stop
