<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ClientProfile extends Controller
{
    public function profile_order()
    {
        $userId = Auth::guard('user')->user()->userID;
        $orders = Order::where('userID', $userId)->get();
        return view('users.pages.profiles.components.profile-list_order', compact('orders'));
    }
    public function profile_order_detail($orderId)
    {
        $orderId = (int) $orderId;
        $orders = OrderDetail::where('orderID', $orderId)->get();
        return view('users.pages.profiles.components.profile-detail_order', compact('orders'));
    }
    public function profile_info()
    {
        $userId = Auth::guard('user')->user()->userID;
        $users = User::where('userID', $userId)->get();
        return view('users.pages.profiles.components.profile-list_profile', compact('users'));
    }
    public function profile_info_edit()
    {
        $userId = Auth::guard('user')->user()->userID;
        $users = User::where('userID', $userId)->get();
        return view('users.pages.profiles.components.profile-list_profile_edit', compact('users'));
    }
    public function profile_info_update_edit(Request $request)
    {
        $userId = Auth::guard('user')->user()->userID;
        $request->validate([
            'userName' => 'nullable|string|max:255',
        ]);
        $user = User::where('userID', (int) $userId)->firstOrFail();
        $data = array_filter($request->only(['userName']));
        $user->update($data);
        return redirect()->route('client.profile-info')->with('success', 'Cập nhật thông tin thành công');
    }
    public function profile_change_pass(Request $request)
    {
        return view('users.pages.profiles.components.profile-list_changepass');
    }
    public function profile_update_pass(Request $request)
    {
        $request->validate([
            'password_old' => 'required',
            'password' => 'required|string|min:8|confirmed',
            'password_confirm' => 'required|string|min:8',
        ]);
        if ($request->password !== $request->password_confirm) {
            return back()->withErrors(['password_confirm' => 'Mật khẩu xác nhận không khớp']);
        }
        if (!Hash::check($request->password_old, Auth::guard('user')->user()->password)) {
            return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
        }
        // Đổi mật khẩu
        $userId = Auth::guard('user')->user()->userID;
        $user = User::where('userID', (int) $userId)->firstOrFail();
        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('client.profile-change_pass')->with('status', 'Đổi mật khẩu thành công');
    }
}
