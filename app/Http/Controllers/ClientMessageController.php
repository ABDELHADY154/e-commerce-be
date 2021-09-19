<?php

namespace App\Http\Controllers;

use App\ClientMessage;
use Illuminate\Http\Request;

class ClientMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = ClientMessage::all();

        return view('admin.ClientMessage.index', ['messages' => $messages]);
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
     * @param  \App\ClientMessage  $clientMessage
     * @return \Illuminate\Http\Response
     */
    public function show(ClientMessage $clientMessage)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\ClientMessage  $clientMessage
     * @return \Illuminate\Http\Response
     */
    public function edit(ClientMessage $clientMessage)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\ClientMessage  $clientMessage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ClientMessage $clientMessage)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\ClientMessage  $clientMessage
     * @return \Illuminate\Http\Response
     */
    public function destroy(ClientMessage $clientMessage)
    {
        $clientMessage->delete();
        return redirect(route('clientMessage.index'));
    }
}
