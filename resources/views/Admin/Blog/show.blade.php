@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Dashboard</h1>
        <a href="{{route('admin.blog.create')}}"
           class="btn btn-info btn-sm float-left mr-1">
            <i class="fas">Create</i>
        </a>
    </div>
@stop

@section('content')
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header d-flex p-3">
                            <div class="mr-3">
                                <a href="{{route('admin.blog.edit', $blog->id)}}" class="btn btn-primary">Update</a>
                            </div>
                            <form action="{{route('admin.blog.destroy', ['blog' => $blog->id])}}" method="post">
                                @csrf
                                @method('delete')
                                <input type="submit" class="btn btn-danger" value="Delete">
                            </form>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body">
                            <div class="card-body table-responsive p-0">
                                <table class="table table-hover text-nowrap">
                                    <tbody>
                                    <tr>
                                        <td>Title</td>
                                        <td>{{$blog->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Description</td>
                                        <td>{{$blog->description}}</td>
                                    </tr>
                                    <tr>
                                        <td>Category</td>
                                        <td>{{$blog->category->title}}</td>
                                    </tr>
                                    <tr>
                                        <td>Author</td>
                                        <td>{{$blog->user->name}}</td>
                                    </tr>
                                    <tr>
                                        <td>Tags</td>
                                        <td>
                                            @foreach($blog->tags as $tag)
                                                {{$tag->title}},
                                            @endforeach
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>


                    </div>
                    <!-- /.card -->
                </div>
            </div>
        </div>
    </section>
@stop

@section('js')
    <script src="/assets/js/admin/footerSettings.js"></script>
@stop
