@extends('layouts.app')


@section('css')
<style>
    .card-header:first-child {
        border-radius: calc(0.37rem - 1px) calc(0.37rem - 1px) 0 0
    }

    .card-header {
        padding: 0.75rem 1.25rem;
        margin-bottom: 0;
        background-color: #fff;
        border-bottom: 1px solid rgba(0, 0, 0, 0.1)
    }

    .track {
        position: relative;
        background-color: #ddd;
        height: 7px;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        margin-bottom: 60px;
        margin-top: 50px
    }

    .track .step {
        -webkit-box-flex: 1;
        -ms-flex-positive: 1;
        flex-grow: 1;
        width: 25%;
        margin-top: -18px;
        text-align: center;
        position: relative
    }

    .track .step.active:before {
        background: #28AE7B
    }

    .track .step::before {
        height: 7px;
        position: absolute;
        content: "";
        width: 100%;
        left: 0;
        top: 18px
    }

    .track .step.active .icon {
        background: #28AE7B;
        color: #fff
    }

    .track .icon {
        display: inline-block;
        width: 40px;
        height: 40px;
        line-height: 40px;
        position: relative;
        border-radius: 100%;
        background: #ddd
    }

    .track .step.active .text {
        font-weight: 400;
        color: #000
    }

    .track .text {
        display: block;
        margin-top: 7px
    }

    .itemside {
        position: relative;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 100%
    }

    .itemside .aside {
        position: relative;
        -ms-flex-negative: 0;
        flex-shrink: 0
    }

    .img-sm {
        width: 80px;
        height: 80px;
        padding: 7px
    }

    ul.row,
    ul.row-sm {
        list-style: none;
        padding: 0
    }

    .itemside .info {
        padding-left: 15px;
        padding-right: 7px
    }

    .itemside .title {
        display: block;
        margin-bottom: 5px;
        color: #212529
    }

    p {
        margin-top: 0;
        margin-bottom: 1rem
    }

    .btn-warning {
        color: #ffffff;
        background-color: #ee5435;
        border-color: #ee5435;
        border-radius: 1px
    }

    .btn-warning:hover {
        color: #ffffff;
        background-color: #ff2b00;
        border-color: #ff2b00;
        border-radius: 1px
    }

</style>
@endsection


@section('content')


<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Order</h1>
    @if($order->status == "ordered")
    <a href="{{ route('process.order',$order->id) }}" class="btn btn-primary">Order Processed</a>
    @elseif ($order->status=="processing")
    <a href="{{ route('way.order',$order->id) }}" class="btn btn-primary">Order On The Way</a>
    @elseif ($order->status=="on the way")
    <a href="{{ route('deliver.order',$order->id) }}" class="btn btn-primary">Order Delivered</a>

    @endif

</div>

{{-- <div class="container"> --}}
<div class="card p-3">
    {{-- <livewire:product-create-form /> --}}
    {{-- <article class="card"> --}}
    <div class="card-body">
        <h6>Order ID: {{$order->order_num}}</h6>
        <article class="card">
            <div class="card-body row">
                <div class="col"> <strong>Shipping BY:</strong> <br>
                    {{$order->address->city}}, {{$order->address->region}}, {{$order->address->building_no}} {{$order->address->street_name}}, floor {{$order->address->floor}}, Appartment #{{$order->address->appartment_no}}
                    , | <i class="fa fa-phone"></i> {{$order->client->phone_number}} </div>
                <div class="col"> <strong>Status:</strong> <br> {{$order->status}} </div>
                <div class="col"> <strong>Price:</strong> <br> {{$order->price}} EGP</div>
                <div class="col"> <strong>Delivery:</strong> <br> {{$order->delivery}} EGP</div>
                <div class="col"> <strong>Total Price:</strong> <br> {{$order->total_price}} EGP</div>

                {{-- <div class="col"> <strong>Tracking #:</strong> <br> BD045903594059 </div> --}}
            </div>
        </article>
        <div class="track">
            @if($order->status == "ordered")
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Ordered</span> </div>
            <div class="step "> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
            @elseif ($order->status == "processing")
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Ordered</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
            <div class="step "> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
            @elseif ($order->status == "on the way")
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Ordered</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
            <div class="step"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>
            @elseif ($order->status == "delivered")
            <div class="step active"> <span class="icon"> <i class="fa fa-check"></i> </span> <span class="text">Ordered</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-user"></i> </span> <span class="text"> Processing</span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-truck"></i> </span> <span class="text"> On the way </span> </div>
            <div class="step active"> <span class="icon"> <i class="fa fa-box"></i> </span> <span class="text">Delivered</span> </div>

            @endif
        </div>
        <hr>
        <ul class="row">
            @foreach ($order->products as $product)
            <li class="col-md-4">
                <figure class="itemside mb-3">
                    <div class="aside"><img src="{{asset('storage/products/' . $product->images()->first()->image )}}" class="img-sm border"></div>
                    <figcaption class="info align-self-center">
                        <p class="title">{{$product->name}} <br> Quantity: {{$product->pivot->quantity}}</p> <span class="text-muted">{{$product->total_price}} EGP </span>
                    </figcaption>
                </figure>
            </li>
            @endforeach

        </ul>
        <hr>
        {{-- <a href="#" class="btn btn-warning" data-abc="true"> <i class="fa fa-chevron-left"></i> Back to orders</a> --}}
        {{-- </div> --}}
        </article>
    </div>
    {{-- </div> --}}


    @endsection
