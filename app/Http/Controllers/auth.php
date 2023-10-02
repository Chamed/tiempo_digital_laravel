<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class auth extends Controller
{
    public function show(){
        return view('auth');
    }

    public function authenticate(Request $request) {
        $type = $request->input('type');
        $first_name = $request->input('name');
        $last_name = $request->input('lastname');
        $email = $request->input('email');
        $password = $type == 'login' ? $request->input('pass') : Hash::make($request->input('pass'));

        if($type == 'register'){
            User::create([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'password' => $password,
            ]);

            return response()->json(['message' => 'Registro realizado', 'status' => 'success']);
        } else if($type == 'login'){
            $user = User::where('email', $email)->first();

            if(Hash::check($password, $user->password)){
                $_SESSION['user'] = [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ];

                return response()->json(['message' => 'Login realizado', 'status' => 'success', 'user' => [
                    'id' => $user->id,
                    'first_name' => $user->first_name,
                    'last_name' => $user->last_name,
                    'email' => $user->email,
                ]]);
            } else{
                return response()->json(['message' => 'Email ou senha invalidos', 'status' => 'error']);
            }
        }
    }
}
