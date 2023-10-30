@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Dashboard</h1>
        <a href="{{route('admin.coupon.create')}}"
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
                                    <th>Code</th>
                                    <th>Discount %</th>
                                    <th>Actions</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($coupons as $coupon)
                                    <tr>
                                        <td>{{$coupon->id}}</td>
                                        <td>
                                            <a href="{{ route('admin.coupon.show', ['coupon' => $coupon->id]) }}">{{$coupon->code}}</a>
                                        </td>
                                        <td>
                                            <p>{{$coupon->discount_percent}}</p>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.coupon.edit', ['coupon' => $coupon->id])}}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt">Edit</i>
                                            </a>

                                            <form
                                                action="{{ route('admin.coupon.destroy', ['coupon' => $coupon->id]) }}"
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
    <script src="/assets/js/admin/footerSettings.js"></script>
@stop
