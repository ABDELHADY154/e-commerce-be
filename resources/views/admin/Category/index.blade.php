@extends('layouts.app')

@section('css')

<link href="/admin/vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">

@endsection

@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Category</h1>
    <a href="{{ route('category.create') }}" class="btn btn-primary">Create category</a>
</div>



<div class="card shadow mb-4">

    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>#ID</th>
                        <th>Category</th>
                        <th>Brand</th>
                        <th>Gender</th>
                        <th>Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach ($categories as $category)

                    <tr>
                        <td>{{$category->id}}</td>

                        <td>{{$category->category}}</td>
                        <td>{{$category->brand->brand}}</td>
                        <td>{{$category->brand->gender->gender_name}}</td>

                        <td class="text-center">
                            {{-- <a href="" class="btn btn-success">Show</a> --}}
                            {{-- <a href="{{ route('category.edit',$category) }}" class="btn btn-warning">Edit</a> --}}

                            <form action="{{ route('category.destroy',$category) }}" method="POST" class="d-inline-block">
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
