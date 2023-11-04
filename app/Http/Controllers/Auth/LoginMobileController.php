<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException as ValidationValidationException;

class LoginMobileController extends Controller
{
    public function auth(Request $request){

        $credencials = $request->only([
            'email',
            'password'
        ]);

        $user = User::where('email', $request->email)->first();
        if (! $user || ! Hash::check($request->password, $user->password)){
            throw ValidationValidationException::withMessages([
                'email' => ['Credenciais invalidas'],
                'erro' => true
            ]);
        }

        $user->tokens()->delete();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'dados' => $user->userable,
             'errors' => ['erro' => false ]
        ]);

    }

    public function logout(Request $request){
        $request->user()->tokens()->delete();

        return response()->json([
            'message' => "Logout com sucesso",

        ]);

    }
}
