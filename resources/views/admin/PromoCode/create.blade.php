@extends('layouts.app')



@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Create Promo Code</h1>
</div>

<div class="container">
    <div class="card p-3">
        <form class="user" method="POST" action="{{route('promocode.store')}}">
            @csrf
            <div class="form-group row">
                <div class="col-sm-6 mb-3 mb-sm-0">
                    <input type="text" name="reward" class="form-control form-control-user" id="exampleFirstreward" placeholder="reward">
                    @error('reward')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="number" name="days" class="form-control form-control-user" id="exampleLastName" placeholder="days">
                    @error('days')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="number" name="usage_no" class="form-control form-control-user" id="exampleLastName" placeholder="usage no.">
                    @error('usage_no')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
                <div class="col-sm-6">
                    <input type="checkbox" name="is_disposable" value="{{true}}" class="form-control form-control-user" id="exampleLastName" placeholder="disposed">
                    @error('is_disposable')
                    <p class="text-danger text-center mt-2">{{$message}}</p>
                    @enderror
                </div>
            </div>


            <button type="submit" class="btn btn-primary">Add</button>
        </form>
    </div>
</div>


@endsection
