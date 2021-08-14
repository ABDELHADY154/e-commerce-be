@extends('layouts.app')


@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Category</h1>
</div>

{{-- <div class="container"> --}}
<div class="card p-3">
    <form class="" method="POST" action="{{route('category.store')}}">
        @csrf

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Category</label>
                <input type="text" name="category" class="form-control form-control-user" id="exampleFirstName" placeholder="EX: Shirt">
                @error('category')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>

        </div>


        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Brand </label>

                <select class="custom-select" name="brand_id">
                    <option selected>Choose Gender</option>
                    @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}">{{ $brand->brand }} | {{$brand->gender->gender_name}}</option>
                    @endforeach
                </select>
                @error('brand_id')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>
        </div>


        <button type="submit" class="btn btn-primary">Add</button>
    </form>
</div>
{{-- </div> --}}


@endsection
