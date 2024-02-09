<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserLoginRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Traits\HttpResponses;
class UserController extends Controller
{
    use HttpResponses;
    public function login(UserLoginRequest $request)
    {
        $request->validated($request->all());

        if (!Auth::attempt($request->only("email","password"))){
            return $this->error('credentials do not match', "", 401);
        }

        $user = User::where("email",$request->email)->first();
        return $this->success([
            "user" => $user,
            "token" => $user->createToken("API Token of ". $user->name)->plainTextToken
        ]);
    }

    public function register(Request $request)
    {

        try {
            $request->validate([
                "name" => "required|string|max:256",
                "email" => "required|email|unique:users",
                "password" => "required|min:8"
            ]);

            $user = new User;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = $request->input('password');

            $user->save();

//            return response(["name" => $user->name, "email" => $user->email, "token" => $user->createToken("API TOKEN")], 201);
            return $this->success([
                "user" => $user,
                "token" => $user->createToken("API Token of ". $user->name)->plainTextToken
            ]);
        }catch (Exception $exception){
            return response($exception->getMessage(),422);
        }


    }
}
