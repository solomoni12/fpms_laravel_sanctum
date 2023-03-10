<?php

namespace App\Http\Controllers;

use App\Models\Crop;
use App\Models\User;
use App\Models\Field;
use Illuminate\Http\Request;
use App\Http\Requests\UserCropRequest;
use App\Traits\HttpResponses;
use App\Http\Resources\CropResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\facades\Hash;
use App\Http\Requests\LoginUserRequest;
use App\Http\Requests\StoreUserRequest;

class AuthController extends Controller
{
    use HttpResponses;

    // Function to user login
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

    // Function to find logged user
    public function logged_user(){
        $logged_user = auth()->user();

        return $this->success([
            'user' => $logged_user,
            'message' => 'logged user'
        ]);
    }

    // Function to change password of user
    public function change_password(LoginUserRequest $request){

        $request -> validated([
            'email' => 'required',
            'password'=> 'required|confirmed',
        ]);
        $logged_user = auth()->user(); 
        $logged_user -> password = Hash::make($request->password);
        $logged_user -> save();

        return $this->success([
            'user' => $logged_user,
            'message' => 'password changed'
        ]);
    }

    // function to register user
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

    // user logout function
    public function logout(){
        
        Auth::user()->currentAccessToken()->delete();

        return $this->success([
            'message'=>'You have been successfuly logged out and your token has been deleted'
        ]);
    }
}
