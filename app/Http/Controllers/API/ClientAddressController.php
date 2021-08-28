<?php

namespace App\Http\Controllers\API;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Client;
use App\ClientAddress;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ClientAddressController extends Controller
{
    use CoreJsonResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $client = Client::find(auth('api')->id());
        $addresses = $client->addresses;
        return $this->ok(['addresses' => $addresses]);
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
            "default" => $request->default ? true : false,
            "client_id" => auth('api')->id(),
        ]);

        return $this->created(['address' => $address]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required'],
            'city' => ['required', 'in:Alexandria,Cairo'],
            'building_no' => ['required'],
            "floor" => ['required'],
            "appartment_no" => ['required'],
            "region" => ['required'],
            "street_name" => ['required'],
            "default" => ['boolean']
        ]);
        $client = Client::find(auth('api')->id());
        $address = $client->addresses()->find($id);
        if ($address) {
            $address->update([
                'name' => $request->name,
                'city' => $request->city,
                'building_no' => $request->building_no,
                "floor" => $request->floor,
                "appartment_no" => $request->appartment_no,
                "region" => $request->region,
                "street_name" => $request->street_name,
                "default" => $request->default ? true : false,
            ]);
            return $this->created(['address' => $address]);
        }
        return $this->notFound();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $client = Client::find(auth('api')->id());
        $address = $client->addresses()->find($id);
        if ($address) {
            $address->delete();
            return $this->ok(['deleted']);
        }
        return $this->notFound();
    }
}
