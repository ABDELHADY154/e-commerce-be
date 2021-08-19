<?php

namespace App\Http\Controllers;

use App\Product;
use App\ProductSize;
use Illuminate\Http\Request;

class ProductSizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productSizes = ProductSize::all();
        return view('admin.productSize.index', ['productSizes' => $productSizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = Product::all();
        return view('admin.productSize.create', ['products' => $products]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'size' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1']
        ]);
        $size = ProductSize::create($request->all());
        $product = Product::find($request->product_id);
        if ($product) {
            $product->quantity = $product->quantity +  $request->quantity;
            $product->save();
        }
        return redirect(route('productSize.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function show(ProductSize $productSize)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function edit(ProductSize $productSize)
    {
        $products = Product::all();
        return view('admin.productSize.edit', ['productSize' => $productSize, 'products' => $products]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProductSize $productSize)
    {
        $request->validate([
            'product_id' => ['required', 'integer', 'exists:products,id'],
            'size' => ['required', 'string'],
            'quantity' => ['required', 'integer', 'min:1']
        ]);
        $product = Product::find($request->product_id);
        if ($product) {
            $product->quantity = $product->quantity -  $productSize->quantity;
            $product->save();
            $product->quantity = $product->quantity +  $request->quantity;
            $product->save();
        }
        $productSize->update($request->all());
        $productSize->save();
        return redirect(route('productSize.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ProductSize  $productSize
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProductSize $productSize)
    {
        $product = Product::find($productSize->product_id);
        $product->quantity -= $productSize->quantity;
        $product->save();
        $productSize->delete();
        return redirect(route('productSize.index'));
    }
}
