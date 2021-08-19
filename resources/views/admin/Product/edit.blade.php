@extends('layouts.app')



@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Product</h1>
</div>

<div class="container">
    <div class="card p-3">
        {{-- @livewire('product-edit-form', ['model' => $product]) --}}
        <livewire:product-edit-form :model="{{$product}}" />
    </div>
</div>


@endsection
