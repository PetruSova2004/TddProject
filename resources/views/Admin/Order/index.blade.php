@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div style="display: flex; justify-content: space-between;">
        <h1>Dashboard</h1>
        <a href="{{route('admin.order.create')}}"
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
                                    <th>Email</th>
                                    <th>Firstname</th>
                                    <th>Lastname</th>
                                    <th>Phone</th>
                                    <th>Price</th>
                                    <th>Discount</th>
                                    <th>Status</th>
                                    <th>Company</th>
                                    <th>Country</th>
                                    <th>Address</th>
                                    <th>City</th>
                                    <th>Zip</th>
                                </tr>
                                </thead>
                                <tbody>
                                @foreach($orders as $order)
                                    <tr>
                                        <td>{{$order->email}}</td>
                                        <td>{{$order->firstname}}</td>
                                        <td>{{$order->lastname}}</td>
                                        <td>{{$order->phone}}</td>
                                        <td>${{$order->price}}</td>
                                        <td>{{$order->discount}}</td>
                                        <td>{{$order->status}}</td>
                                        <td>{{$order->company}}</td>
                                        <td>{{$order->country}}</td>
                                        <td>{{$order->address}}</td>
                                        <td>{{$order->city}}</td>
                                        <td>{{$order->zip}}</td>

                                        <td>
                                            <a href="{{ route('admin.order.show', ['order' => $order->id]) }}">{{$order->title}}</a>
                                        </td>
                                        <td>
                                            <a href="{{route('admin.order.edit', ['order' => $order->id])}}"
                                               class="btn btn-info btn-sm float-left mr-1">
                                                <i class="fas fa-pencil-alt">Edit</i>
                                            </a>

                                            <form
                                                action="{{ route('admin.order.destroy', ['order' => $order->id]) }}"
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
