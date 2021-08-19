@extends('layouts.app')

@section('css')

<link href="/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Size</h1>
    <a href="{{ route('productSize.create') }}" class="btn btn-primary">Create Size</a>
</div>



<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Product</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($productSizes as $size)

                    <tr>
                        <td>{{$size->id}}</td>
                        <td>{{$size->size}}</td>
                        <td>{{ $size->quantity }}</td>
                        <td>{{$size->product ? $size->product->name :''}}</td>
                        <td class="text-center">
                            {{-- <a href="" class="btn btn-success">Show</a> --}}
                            <a href="{{ route('productSize.edit',$size) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('productSize.destroy',$size) }}" method="POST" class="d-inline-block">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger">delete</button>
                            </form>
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
