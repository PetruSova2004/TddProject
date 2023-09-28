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
                        <div class="card-body table-responsive p-0 usersTable">
                            <table class="table table-hover text-nowrap">
                                <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Title</th>
                                    <th>Price</th>
                                    <th>Views</th>
                                    <th>Category</th>
                                    <th>Count</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($products as $product)
                                    <tr>
                                        <td>{{$product->id}}</td>
                                        <td>
                                            <a href="{{ route('admin.product.show', ['product' => $product->id]) }}">{{$product->title}}</a>
                                        </td>
                                        <td>
                                            <p>{{$product->price}}</p>
                                        </td>
                                        <td>
                                            <p>{{$product->views}}</p>
                                        </td>
                                        <td>
                                            <p>{{$product->category->title}}</p>
                                        </td>
                                        <td>
                                            <p>{{$product->count}}</p>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.product.edit', ['product' => $product->id])}}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt">Edit</i>
                                            </a>

                                            <form
                                                action="{{ route('admin.product.destroy', ['product' => $product->id]) }}"
                                                method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Подтвердите удаление')">
                                                    <i
                                                        class="fas fa-trash-alt">Delete</i>
                                                </button>
                                            </form>
                                        </td>

                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        <!-- /.card-body -->
                    </div>


                </div>
                <!-- /.card -->
            </div>
        </div>
    </section>
@stop

@section('js')
@stop
