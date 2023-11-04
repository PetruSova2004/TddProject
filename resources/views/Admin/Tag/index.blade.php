@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Dashboard</h1>
        <a href="{{route('admin.tag.create')}}"
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
                                    <th>Occurrences</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($tags as $tag)
                                    <tr>
                                        <td>{{$tag->id}}</td>
                                        <td>
                                            <a href="{{ route('admin.tag.show', ['tag' => $tag->id]) }}">{{$tag->title}}</a>
                                        </td>
                                        <td>
                                            <p>{{$tag->occurrences}}</p>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.tag.edit', ['tag' => $tag->id])}}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt">Edit</i>
                                            </a>

                                            <form
                                                action="{{ route('admin.tag.destroy', ['tag' => $tag->id]) }}"
                                                method="post" class="float-left">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Confirm Delete')">
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
