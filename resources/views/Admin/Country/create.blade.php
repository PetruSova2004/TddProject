@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Country-Create</h1>

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
                            <h3 class="card-title">New Country</h3>
                        </div>

                        <form role="form" method="post"
                              action={{route('admin.country.store')}} enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" name="name"
                                           class="form-control @error('name') is-invalid @enderror" id="name"
                                           placeholder="Name">
                                </div>
                                <div class="form-group">
                                    <label for="code">Code</label>
                                    <input type="text" name="code"
                                           class="form-control @error('code') is-invalid @enderror" id="code"
                                           placeholder="Code">
                                </div>
                                <div class="form-group">
                                    <label for="zip">Zip</label>
                                    <input type="text" name="zip"
                                           class="form-control @error('zip') is-invalid @enderror" id="zip"
                                           placeholder="Zip">
                                </div>
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
    <script src="/assets/js/admin/footerSettings.js"></script>
@stop
