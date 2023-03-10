<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\str;
use Illuminate\Http\Request;
use Illuminate\Mail\Message;
use App\Models\PasswordReset;
use App\Traits\HttpResponses;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\UserResetPasswordRequest;

class PasswordResetController extends Controller
{
    use HttpResponses;

    public function send_reset_password_email(UserResetPasswordRequest $request){
        $request -> validated([
            'email' => 'required|email',
        ]);
        $email = $request->email;

        // check user email exist or Not
        $user = User::where('email', $request->email)->first();

        if(!$user){
            return $this->error('','email do not match', 401);
        }

        // Generate Token
        $token = Str::random(60);

        // Saving data to password reset table
        PasswordReset::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        // Sending Message with Reset Password View
        Mail::send('reset', ['token'=>$token], function(Message $message)use($email){
            $message -> subject('Reset your Password');
            $message -> to($email);
        });

        return $this->success([
            'message' => 'Password Reset Email Sent.. Check Your Email'
        ]);
    }
}
