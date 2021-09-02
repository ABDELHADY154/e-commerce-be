@extends('layouts.app')

@section('css')

<link href="/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Orders</h1>
    {{-- <a href="{{ route('order.create') }}" class="btn btn-primary">Create Order</a> --}}
</div>

<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Order Number</th>
                        <th>Client Name</th>
                        <th>Delivery</th>
                        <th>Price</th>
                        <th>Total Price</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                    <tr>
                        <td>{{$order->id}}</td>
                        <td>
                            {{$order->order_num}}
                        </td>
                        <td>{{$order->client->name}}</td>
                        <td>{{$order->delivery}} EGP</td>
                        <td>{{$order->price}} EGP</td>
                        <td>{{$order->total_price}} EGP</td>
                        <td>{{$order->status}}</td>
                        <td class="text-center">
                            @if($order->status == "ordered")
                            <a href="{{ route('process.order.index',$order->id) }}" class="btn btn-danger"> Processed</a>
                            @elseif ($order->status=="processing")
                            <a href="{{ route('way.order.index',$order->id) }}" class="btn btn-warning"> On The Way</a>
                            @elseif ($order->status=="on the way")
                            <a href="{{ route('deliver.order.index',$order->id) }}" class="btn btn-primary"> Delivered</a>
                            @endif
                            <a href="{{ route('order.show',$order) }}" class="btn btn-success">Show</a>
                        </td>
                    </tr>

                    @endforeach


                </tbody>
            </table>
        </div>
    </div>



</div>
@endsection

@section('js')
<!-- Page level plugins -->
<script src="/admin/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="/admin/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="/admin/js/demo/datatables-demo.js"></script>
@endsection
