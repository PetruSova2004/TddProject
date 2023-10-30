@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Dashboard</h1>
        <a href="{{route('admin.product.create')}}"
           class="btn btn-info btn-sm float-left mr-1">
            <i class="fas">Create</i>
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
                                <form role="form" method="post" action="{{route('admin.product.update', ['product' => $product->id])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group"><label>Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                           value="{{$product->title}}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group"><label>Description</label>
                                                    <input type="text" class="form-control" name="description"
                                                           value="{{$product->description}}">
                                                </div>
                                            </div>

                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group"><label>Price</label>
                                                    <input class="form-control" name="price"
                                                           value="{{$product->price}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="category_id">Category</label>
                                                <select class="form-control" id="category_id" name="category_id">
                                                    @foreach($categories as $category)
                                                        <option value="{{$category->id}}" @if($category->title === $product->category->title) selected @endif>{{$category->title}}</option>
                                                    @endforeach
                                                </select>
                                            </div>


                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group"><label>Count</label>
                                                    <input type="number" class="form-control" name="count"
                                                           value="{{$product->count}}">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="file">Choose Image</label>
                                                <input type="file" name="image_file"
                                                       class="form-control-file @error('image_file') is-invalid @enderror" id="image_file">
                                                @error('image_file')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
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
    <script src="/assets/js/admin/footerSettings.js"></script>
@stop
