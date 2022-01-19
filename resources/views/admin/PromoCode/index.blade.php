@extends('layouts.app')

@section('css')

<link href="/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Promo Code</h1>
    <a href="{{ route('promocode.create') }}" class="btn btn-primary">Create Promo Code</a>
</div>



<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Code</th>
                        <th>Reward</th>
                        <th>Days</th>
                        <th>usage NO.</th>
                        <th>disposable</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($promocodes as $promocode)

                    <tr>
                        <td>{{$promocode->id}}</td>
                        <td>{{$promocode->code}}</td>
                        <td>{{$promocode->reward}}%</td>
                        <td>{{$promocode->expires_at}}</td>
                        <td>{{$promocode->quantity}}</td>
                        <td>{{$promocode->is_disposable == 1? "true" : "false"}}</td>
                        <td class="text-center">
                            {{-- <a href="" class="btn btn-success">Show</a> --}}
                            <a href="{{ route('promocode.edit',$promocode->id) }}" class="btn btn-warning">Edit</a>
                            <a href="{{ route('promocode.disable',$promocode->code) }}" class="btn btn-danger">Disable</a>
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
