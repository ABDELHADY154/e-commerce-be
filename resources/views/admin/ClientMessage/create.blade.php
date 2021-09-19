@extends('layouts.app')



@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Client Address</h1>
</div>

<div class="card p-3">
    <form class="user" method="POST" action="{{route('clientAddress.store')}}">
        @csrf
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="name" class="form-control " id="exampleFirstName" placeholder="Name">
                @error('name')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="col-sm-6">
                <select class="custom-select" name="city">
                    <option value="" selected>Choose City</option>
                    <option value="Alexandria">Alexandria</option>
                    <option value="Cairo">Cairo</option>
                </select>
                @error('city')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror

            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="number" name="building_no" class="form-control " placeholder="Building Number">
                @error('building_no')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="col-sm-6">
                <input type="number" name="floor" class="form-control " placeholder="Floor">
                @error('floor')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="number" name="appartment_no" class="form-control " placeholder="Appartment Number">
                @error('appartment_no')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="col-sm-6">
                <input type="text" name="region" class="form-control " placeholder="Region">
                @error('region')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <input type="text" name="street_name" class="form-control " placeholder="Street Name">
                @error('street_name')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror
            </div>
            <div class="col-sm-6">
                <select class="custom-select" name="client_id">
                    <option value="" selected>Choose Client</option>
                    @foreach ($clients as $client)
                    <option value="{{$client->id}}">{{$client->id}} | {{$client->name}}</option>
                    @endforeach
                </select>
                @error('client_id')
                <p class="text-danger text-center mt-1">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="form-group">
            <div class="col">
                <div class="custom-control custom-checkbox mb-3">
                    <input value="{{true}}" type="checkbox" class="custom-control-input" id="customControlValidation1" name="default">
                    <label class="custom-control-label" for="customControlValidation1">Default Address</label>
                </div>

                {{-- <input type="checkbox" value="0" class="custom-control custom-checkbox mb-3" id="customCheck1" name="default"> --}}
                {{-- <label class="custom-control-label" for="customCheck1">Default Address</label> --}}
                @error('default')
                <p class="text-danger  mt-1">{{$message}}</p>
                @enderror
            </div>

        </div>

        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>


@endsection
