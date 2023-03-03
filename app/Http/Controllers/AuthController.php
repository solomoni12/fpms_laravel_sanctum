<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\LoginUserRequest;
use App\Models\User;
use App\Traits\HttpResponses;
use Illuminate\Http\Request;
use Illuminate\Support\facades\Hash;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    use HttpResponses;

    public function login(LoginUserRequest $request){

        $request->validated($request->all());  
        if(!Auth::attempt(['email' => $request->email, 'password' => $request->password])){
            return $this->error('','Credential do not match', 401);
        }

        $user = User::where('email', $request->email)->first();
        
        return $this->success([
            'user'=>$user,
            'token'=>$user->createToken('API token of' . $user->name)->plainTextToken
        ]);
    }

    public function register(StoreUserRequest $request){
       
        $request->validated($request->all());   

        $user = User::create([
            'name'=>$request->name,
            'email'=>$request->email,
            'password'=> Hash::make($request->password),
        ]);

        return $this->success([
            'user' => $user,
            'token' => $user->createToken('API token of' . $user->name)->plainTextToken
        ]);
    }

    public function logout(){
        
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message'=>'You have been successfuly logged out and your token has been deleted'
        ]);
    }
}
