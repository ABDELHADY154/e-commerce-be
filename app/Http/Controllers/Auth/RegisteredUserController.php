<?php

namespace App\Http\Controllers\Auth;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Authentication\ClientLoginRequest;
use App\Http\Requests\Authentication\ClientRegisterRequest;
use App\Http\Resources\Authentication\AuthClientResource;
use App\Models\Client;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Validation\ValidationException;

class RegisteredUserController extends Controller
{
    use CoreJsonResponse;
    /**
     * Display the registration view.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }

    public function clientRegister(ClientRegisterRequest $request)
    {
        $client =  Client::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);
        $token = $client->createToken('Auth Token')->accessToken;
        return $this->created((new AuthClientResource(['client' => $client, 'token' => $token]))->resolve());
    }

    public function clientLogin(ClientLoginRequest $request)
    {
        $client = Client::where('email', $request->email)->first();

        if (!$client || !Hash::check($request->password, $client->password) || ($client == null)) {
            throw ValidationException::withMessages([
                'error' => ['Incorrect Email or Password'],
            ]);
        }
        $token = $client->createToken('Auth Token')->accessToken;
        return $this->ok((new AuthClientResource(['client' => $client, 'token' => $token]))->resolve());
    }
}
