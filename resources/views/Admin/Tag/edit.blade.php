@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Dashboard</h1>
        <a href="{{route('admin.tag.create')}}"
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
                                      action="{{route('admin.tag.update', ['tag' => $tag->id])}}"
                                      enctype="multipart/form-data">
                                    @csrf
                                    @method('PUT')
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-12 col-md-4 col-lg-4">
                                                <div class="form-group"><label>Title</label>
                                                    <input type="text" class="form-control" name="title"
                                                           value="{{$tag->title}}">
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="title">Occurrences</label>
                                                <input type="number" name="occurrences"
                                                       class="form-control @error('occurrences') is-invalid @enderror"
                                                       id="occurrences"
                                                       placeholder="Occurrences"
                                                        value="{{$tag->occurrences}}">
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
