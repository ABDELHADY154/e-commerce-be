@extends('layouts.app')

@section('css')

<link href="/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Client Address</h1>
    <a href="{{ route('clientAddress.create') }}" class="btn btn-primary">Create Client Address</a>
</div>



<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>City</th>
                        <th>Region</th>
                        <th>Street Name</th>
                        <th>Building #</th>
                        <th>Floor</th>
                        <th>Appartment #</th>
                        <th>Client Name</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($adresses as $address)

                    <tr>
                        <td>{{$address->id}}</td>
                        <td>{{$address->name}}</td>
                        <td>{{$address->city}}</td>
                        <td>{{$address->region}}</td>
                        <td>{{$address->street_name}}</td>
                        <td>{{$address->building_no}}</td>
                        <td>{{$address->floor}}</td>
                        <td>{{$address->appartment_no}}</td>
                        <td>{{$address->client->name}}</td>

                        <td class="text-center">
                            {{-- <a href="" class="btn btn-success">Show</a> --}}
                            <a href="{{ route('clientAddress.edit',$address) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('clientAddress.destroy',$address) }}" method="POST" class="d-inline-block">
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
