<?php

namespace App\Http\Controllers;

use AElnemr\RestFullResponse\CoreJsonResponse;
use App\Client;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class ForgetPasswordController extends Controller
{
    use CoreJsonResponse;

    public function forgot(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:clients,email']
        ]);
        $email  = $request->input('email');
        if (Client::where('email', $email)->doesntExist()) {
            return $this->notFound(['message' => 'email do not exist']);
        }
        $token = Str::random(4);
        DB::table('forget_password_resets')->insert([
            'email' => $email,
            'token' => $token,
            'created_at' => now()
        ]);
        Mail::send('Email.ForgetPassword', ['token' => $token], function (Message $message) use ($email) {
            $message->to($email);
            $message->subject('Password Reset');
        });
        return $this->created(['message' => 'Email with link to reset password will be sent to you if the email matches our credentials']);
    }
}
