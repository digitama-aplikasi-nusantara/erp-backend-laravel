<?php

namespace App\Http\Controllers\v1;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Response;

class AuthController extends Controller
{
    public function register(Request $request)
    {
        $validate = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create($validate);
        return $this->success($user);
    }

    public function login(Request $request)
    {
        $attr = $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        //dd(Auth::attempt($request->only(['email', 'password'])));
        if (!Auth::attempt($attr)) {
            return $this->error(Response::HTTP_UNAUTHORIZED, 'Credentials not match');
        }

        $response = auth()->user();
        $response['token'] = $response->createToken('API Token')->plainTextToken;
        return $this->success($response);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();

        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
