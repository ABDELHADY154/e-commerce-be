@extends('layouts.auth')
@section('title', '404')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="">
            <div class="card">
                <div class="card-header text-center">
                    <i class="fas fa-exclamation-circle text-danger"></i>
                </div>
                <div class="card-body text-center">
                    <h6>
                        {{$error}}
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
