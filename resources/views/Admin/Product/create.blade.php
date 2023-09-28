@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Product-Create</h1>

    </div>
@stop

@section('content')
    <section class="content">
        @include('Pub.layouts.alerts')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Product</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post"
                              action={{route('admin.product.store')}} enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Title">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input name="price"
                                           class="form-control @error('price') is-invalid @enderror" id="price"
                                           placeholder="Price">
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Description</label>
                                    <input type="text" name="description"
                                           class="form-control @error('description') is-invalid @enderror" id="description"
                                           placeholder="Description">
                                </div>
                            </div>
                            <div style="padding: 2%" class="form-group">
                                <label for="category_id">Category</label>
                                <select class="form-control" id="category_id" name="category_id">
                                    <option disabled selected>Choose a category</option>
                                @foreach($categories as $category)
                                        <option value="{{$category->id}}">{{$category->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Count</label>
                                    <input type="number" name="count"
                                           class="form-control @error('count') is-invalid @enderror" id="count"
                                           placeholder="Count">
                                </div>
                            </div>
                            <div style="padding: 2%" class="form-group">
                                <label for="file">Choose Image</label>
                                <input type="file" name="image_file"
                                       class="form-control-file @error('image_file') is-invalid @enderror" id="image_file">
                                @error('image_file')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Сохранить</button>
                            </div>
                        </form>

                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@stop

@section('js')
@stop
