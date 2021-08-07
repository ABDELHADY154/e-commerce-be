<?php

namespace App\Http\Controllers;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Client;
use App\Http\Resources\ClientAuthResource;
use App\Http\Resources\ClientProfileResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class ClientController extends Controller
{
    use CoreJsonResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {
        //
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);
        $client = Client::where('email', $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password) || ($client == null)) {
            throw ValidationException::withMessages([
                'error' => ['Incorrect Email or Password'],
            ]);
        }
        $token = $client->createToken('Auth Token')->accessToken;
        return $this->ok((new ClientAuthResource(['token' => $token, 'client' => $client]))->resolve());
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string'],
            'email' => ['required', 'email', 'unique:clients,email'],
            'phone_number' => ['nullable', 'numeric'],
            'password' => ['required', 'min:8']
        ]);
        $client =  Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'phone_number' => $request->phone_number

        ]);

        $token = $client->createToken('Auth Token')->accessToken;
        return $this->ok((new ClientAuthResource(['token' => $token, 'client' => $client]))->resolve());
    }
    public function getProfile()
    {
        $client = Client::find(auth('api')->id());
        return $this->ok((new ClientProfileResource($client))->resolve());
    }

    public function updateImage(Request $request)
    {
        $request->validate([
            'image' => ['required', 'file', 'mimes:png,jpg,jpeg',]
        ]);
        $client = Client::where('id', auth('api')->id())->first();

        if ($request->file('image')) {
            $fileName = $request->file('image')->hashName();
            $path = $request->file('image')->storeAs(
                'clientImages',
                $fileName
            );

            $client->update([
                'image' => $fileName,
            ]);
            $client->save();
            return $this->created(['image' => asset('storage/clientImages/' . $client->image),]);
        }
        return $this->notFound(['message' => 'File Not Found']);
    }
}
