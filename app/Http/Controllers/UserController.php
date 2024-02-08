<?php

namespace App\Http\Controllers;

use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use HttpResponses;
class UserController extends Controller
{
    public function login()
    {

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
                "message" => "fununciou",
                "data" => $user->createToken('API'),
                "code" => 201
            ]);
        }catch (Exception $exception){
            return response($exception->getMessage(),422);
        }


    }
}
