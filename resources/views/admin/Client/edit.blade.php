@extends('layouts.app')



@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Client</h1>
</div>

<div class="container">
    <div class="card p-3">
        <form class="user" method="POST" action="{{route('client.update',$client)}}">
            @csrf
            @method('PUT')
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="name" value="{{$client->name}}" class="form-control form-control-user" id="exampleFirstName" placeholder="Name">
                    @error('name')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="text" name="email" value="{{$client->email}}" class="form-control form-control-user" id="exampleLastName" placeholder="Email">
                    @error('email')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="number" name="phone_number" value="{{$client->phone_number}}" class="form-control form-control-user" id="exampleFirstName" placeholder="phone_number">
                    @error('phone_number')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="password" name="password" value="{{$client->password}}" class="form-control form-control-user" id="exampleLastName" placeholder="password">
                    @error('password')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
</div>


@endsection
