<?php

namespace App\Http\Controllers;

use App\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = Order::all();
        return view('admin.Order.index', ['orders' => $orders]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(Order $order)
    {
        return view('admin.Order.show', ['order' => $order]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Order $order)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(Order $order)
    {
        //
    }

    public function processOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = "processing";
            $order->save();
            return redirect(route('order.show', $order));
        }
    }

    public function wayorder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = "on the way";
            $order->save();
            return redirect(route('order.show', $order));
        }
    }

    public function deliverOrder($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = "delivered";
            $order->save();
            return redirect(route('order.show', $order));
        }
    }
    public function processOrderIndex($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = "processing";
            $order->save();
            return redirect(route('order.index'));
        }
    }

    public function wayorderIndex($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = "on the way";
            $order->save();
            return redirect(route('order.index'));
        }
    }

    public function deliverOrderIndex($id)
    {
        $order = Order::find($id);
        if ($order) {
            $order->status = "delivered";
            $order->save();
            return redirect(route('order.index'));
        }
    }
}
