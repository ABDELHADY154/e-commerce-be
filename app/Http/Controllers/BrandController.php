<?php

namespace App\Http\Controllers;

use App\Brand;
use App\Gender;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.Brand.index', ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $genders = Gender::all();
        return view('admin.Brand.create', ['genders' => $genders]);
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
            'brand' => ['required', 'string'],
            'brand_desc' => ['nullable', 'string'],
            'brand_image' => ['required', 'image', 'mimes:png,jpg,jpeg', 'max:2048'],
            'gender_id' => ['required', 'integer', 'exists:genders,id']
        ]);
        $fileName = $request->file('brand_image')->hashName();
        $path = $request->file('brand_image')->storeAs(
            'public/brands',
            $fileName
        );

        $brand = Brand::create([
            'brand' => $request->brand,
            'brand_desc' => $request->brand_desc,
            'gender_id' => $request->gender_id,
            'brand_image' => $fileName
        ]);
        return redirect(route('brand.index'));
    }
    // ‘required|image|mimes:jpeg,png,jpg,gif,svg|max:2048’
    /**
     * Display the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function show(Brand $brand)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function edit(Brand $brand)
    {
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Brand $brand)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Brand  $brand
     * @return \Illuminate\Http\Response
     */
    public function destroy(Brand $brand)
    {
        $brand->delete();
        return redirect(route('brand.index'));
    }
}
