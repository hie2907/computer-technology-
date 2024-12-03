<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AdminAuthController extends Controller
{
    // Đăng ký admin
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'adminName' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:admins',
            'password' => 'required|string|min:6|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }
        $lastAdmin = Admin::orderBy('adminID', 'desc')->first();
        $adminID = $lastAdmin ? $lastAdmin->adminID + 1 : 1;

        $admin = Admin::create([
            'adminID' => $adminID,
            'adminName' => $request->adminName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'roleId' => $request->roleId,
            'dateHired' => now(),
        ]);

        return redirect()->route('admin.login.form')->with('message', 'Registration successful. Please login.');

    }

    // Đăng nhập admin
    public function login(Request $request)
    {
       $credentials = $request->only('email', 'password');

    if (Auth::guard('admin')->attempt($credentials)) {
        return redirect()->route('admin.dashboard');
    }

    return redirect()->route('admin.login.form')->with('error', 'Invalid credentials');
    }

    // Đăng xuất admin
    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect()->route('admin.login.form')->with('message', 'Logged out successfully.');
    }
}
