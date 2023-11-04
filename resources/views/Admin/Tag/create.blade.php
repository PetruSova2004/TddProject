@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Tag-Create</h1>
@stop

@section('content')
    <section class="content">
        @include('Pub.layouts.alerts')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">New Tag</h3>
                        </div>
                        <!-- /.card-header -->

                        <form role="form" method="post"
                              action={{route('admin.tag.store')}} enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="title">Title</label>
                                    <input type="text" name="title"
                                           class="form-control @error('title') is-invalid @enderror" id="title"
                                           placeholder="Title">
                                </div>
                                <div class="form-group">
                                    <label for="occurrences">Occurrences</label>
                                    <input type="number" name="occurrences"
                                           class="form-control @error('occurrences') is-invalid @enderror"
                                           id="occurrences"
                                           placeholder="Occurrences">
                                </div>
                            </div>

                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Create</button>
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
    <script src="/assets/js/admin/footerSettings.js"></script>
@stop
