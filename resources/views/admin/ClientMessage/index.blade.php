@extends('layouts.app')

@section('css')

<link href="/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Client Messages</h1>
    {{-- <a href="{{ route('clientMessage.create') }}" class="btn btn-primary">Create Client </a> --}}
</div>



<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Message</th>

                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($messages as $message)

                    <tr>
                        <td>{{$message->id}}</td>
                        <td>{{$message->client->name}}</td>
                        <td>{{$message->client->email}}</td>
                        <td>{{$message->message}}</td>
                        <td class="text-center">
                            {{-- <a href="{{ route('clientMessage.edit',$message) }}" class="btn btn-warning">Edit</a> --}}
                            <form action="{{ route('clientMessage.destroy',$message) }}" method="POST" class="d-inline-block">
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
