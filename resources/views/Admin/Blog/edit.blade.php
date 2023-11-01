@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Dashboard</h1>
        <a href="{{route('admin.blog.create')}}"
           class="btn btn-info btn-sm float-left mr-1">
            <i class="fas">Update</i>
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
                            <div class="card-body table-responsive p-0 usersTable">
                                <form role="form" method="post"
                                      action="{{route('admin.blog.update', ['blog' => $blog->id])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group"><label>Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                           value="{{$blog->title}}">
                                                </div>
                                            </div>
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group"><label>Description</label>
                                                    <input type="text" class="form-control" name="description"
                                                           value="{{$blog->description}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select class="form-control" id="category_id" name="category_id">
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}"
                                                                @if($category->title === $blog->category->title) selected @endif>{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <label for="category_id">Author</label>
                                                <select class="form-control" id="author" name="author">
                                                    @foreach($users as $user)
                                                        <option value="{{$user->id}}"
                                                                @if($blog->user_id === $user->id) selected @endif>{{$user->name}}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-check-group" style="margin-bottom: 15px;">
                                                <label for="category_id">Tags</label>
                                                @foreach($tags as $tag)
                                                    <div class="form-check" style="margin-bottom: 10px;">
                                                        <input class="form-check-input" type="checkbox" name="tag_id[]"
                                                               value="{{$tag->id}}" id="tag{{$tag->id}}">
                                                        <label class="form-check-label" for="tag{{$tag->id}}">
                                                            {{$tag->title}}
                                                        </label>
                                                    </div>
                                                @endforeach
                                            </div>


                                        </div>
                                        <button type="submit" class="btn btn-primary mr-1">Save</button>
                                    </div>
                                </form>
                            </div>
                            <!-- /.card-body -->
                        </div>


                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
@stop
