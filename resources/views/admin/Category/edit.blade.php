@extends('layouts.app')



@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Gender</h1>
</div>

<div class="container">
    <div class="card p-3">
        <form class="user" method="POST" action="{{route('gender.update',$gender)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="gender_name" value="{{$gender->gender_name}}" class="form-control form-control-user" id="exampleFirstName" placeholder="">
                    @error('gender_name')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>

            </div>


            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>


@endsection
