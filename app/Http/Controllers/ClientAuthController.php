<?php

namespace App\Http\Controllers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientAuthController extends Controller
{
    public function userLogin()
    {
        return view('users.pages.auth.login');
    }

    public function userRegister()
    {
        return view('users.pages.auth.register');
    }
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'userName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $lastUsers = User::orderBy('userID', 'desc')->first();
        $userID = $lastUsers ? $lastUsers->userID + 1 : 1;
        $dateHired = Carbon::now();

        User::create([
            'userID' => $userID,
            'userName' => $request->userName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dateHired' => $dateHired->toDateTimeString(),
        ]);

        return redirect()->route('client.authen-login')->with('message', 'Registration successful. Please login.');
    }
    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');
        if (Auth::guard('user')->attempt($credentials)) {
            return response()->json(
                [
                    'success' => true,
                    'redirect' => route('client.cart'),
                ],
                200,
            );
        }
        return response()->json(
            [
                'success' => false,
                'error' => 'Invalid credentials',
            ],
            401,
        );
    }

    public function logout()
    {
        Auth::guard('user')->logout();
        return redirect()->route('client.authen-login')->with('message', 'Logged out successfully.');
    }
}
