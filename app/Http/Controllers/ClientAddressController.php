<?php

namespace App\Http\Controllers;

use App\Client;
use App\ClientAddress;
use Illuminate\Http\Request;

class ClientAddressController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientAddresses = ClientAddress::all();
        return view('admin.ClientAdress.index', ['adresses' => $clientAddresses]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clients = Client::all();
        return view('admin.ClientAdress.create', ['clients' => $clients]);
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
            'name' => ['required'],
            'city' => ['required', 'in:Alexandria,Cairo'],
            'building_no' => ['required'],
            "floor" => ['required'],
            "appartment_no" => ['required'],
            "region" => ['required'],
            "street_name" => ['required'],
            "client_id" => ['required', 'exists:clients,id'],
            "default" => ['boolean']
        ]);
        $address = ClientAddress::create([
            'name' => $request->name,
            'city' => $request->city,
            'building_no' => $request->building_no,
            "floor" => $request->floor,
            "appartment_no" => $request->appartment_no,
            "region" => $request->region,
            "street_name" => $request->street_name,
            "client_id" => $request->client_id,
            "default" => $request->default ? true : false
        ]);

        return redirect(route('clientAddress.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\ClientAddress  $clientAddress
     * @return \Illuminate\Http\Response
     */
    public function show(ClientAddress $clientAddress)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientAddress  $clientAddress
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientAddress $clientAddress)
    {
        $clients = Client::all();
        return view('admin.ClientAdress.edit', ['address' => $clientAddress, 'clients' => $clients]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientAddress  $clientAddress
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientAddress $clientAddress)
    {
        $request->validate([
            'name' => ['required'],
            'city' => ['required', 'in:Alexandria,Cairo'],
            'building_no' => ['required'],
            "floor" => ['required'],
            "appartment_no" => ['required'],
            "region" => ['required'],
            "street_name" => ['required'],
            "client_id" => ['required', 'exists:clients,id'],
            "default" => ['boolean']
        ]);
        $clientAddress->update([
            'name' => $request->name,
            'city' => $request->city,
            'building_no' => $request->building_no,
            "floor" => $request->floor,
            "appartment_no" => $request->appartment_no,
            "region" => $request->region,
            "street_name" => $request->street_name,
            "client_id" => $request->client_id,
            "default" => $request->default ? true : false
        ]);

        return redirect(route('clientAddress.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientAddress  $clientAddress
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientAddress $clientAddress)
    {
        //
    }
}
