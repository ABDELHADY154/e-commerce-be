@extends('layouts.app')



@section('content')
<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Edit Size</h1>
</div>

<div class="card p-3">
    <form class="user" method="POST" action="{{route('productSize.update',$productSize)}}">
        @csrf
        @method('PUT')
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Product </label>

                <select class="custom-select" name="product_id">
                    <option selected>Choose Product</option>
                    @foreach ($products as $product)
                    @if ($product->id == $productSize->product_id)
                    <option value="{{ $product->id }}" selected>{{ $product->category->brand->gender->gender_name  }} | {{ $product->category->brand->brand  }} | {{ $product->category->category }} | {{ $product->name }}</option>
                    @endif
                    <option value="{{ $product->id }}">{{ $product->category->brand->gender->gender_name  }} | {{ $product->category->brand->brand  }} | {{ $product->category->category }} | {{ $product->name }}</option>
                    @endforeach
                </select>
                @error('product_id')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>
        </div>
        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Size </label>
                <select class="custom-select" name="size">
                    <option value="" selected>Choose Size</option>
                    <option value="S" {{$productSize->size == "S" ? 'selected':''}}>S</option>
                    <option value="M" {{$productSize->size == "M" ? 'selected':''}}>M</option>
                    <option value="L" {{$productSize->size == "L" ? 'selected':''}}>L</option>
                    <option value="XL" {{$productSize->size == "XL" ? 'selected':''}}>XL</option>
                </select>
                @error('size')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>
        </div>

        <div class="form-group row">
            <div class="col-sm-6 mb-3 mb-sm-0">
                <label for="">Quanity</label>
                <input type="number" name="quantity" class="form-control form-control-user" id="exampleFirstName" value="{{$productSize->quantity}}">
                @error('quantity')
                <p class="text-danger text-center mt-2">{{$message}}</p>
                @enderror
            </div>

        </div>


        <button type="submit" class="btn btn-primary">Save</button>
    </form>
</div>


@endsection
