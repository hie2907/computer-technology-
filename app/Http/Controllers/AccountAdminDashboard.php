<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountAdminDashboard extends Controller
{
    public function index()
    {
        $admins = Admin::where('roleId', 1)->get();
        return view('admin.accounts.admins.adminaccountDashboard', compact('admins'));
    }
    public function update($adminID)
    {
        $adminID = (int) $adminID;
        $admin = Admin::where('adminID', $adminID)->first();
        if (!$admin) {
            return abort(404, 'Không tìm thấy nhân viên với adminID này.');
        }
        return view('admin.accounts.admins.components.updateadminDashboard', compact('admin'));
    }
    public function postupdate(Request $request, $adminID)
    {
        $request->validate([
            'adminName' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'dateofBirth' => 'nullable|date',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:3255',
        ]);
        $admin = Admin::where('adminID', (int) $adminID)->firstOrFail();
        if ($request->filled('email') && $request->email !== $admin->email) {
            $existingAdmin = Admin::where('email', $request->email)->first();
            if ($existingAdmin) {
                return redirect()
                    ->back()
                    ->withErrors(['email' => 'Email này đã tồn tại, vui lòng sử dụng email khác.']);
            }
        }


        $data = array_filter($request->only(['adminName', 'email', 'dateofBirth', 'phone','address','roleId']));
        if (isset($data['roleId'])) {
            $data['roleId'] = (int) $data['roleId'];
        }
        $admin->update($data);
        return redirect()->route('admin.account.admin')->with('success', 'Nhân viên đã được cập nhật thành công.');
    }
    public function delete($adminID)
    {
        $admin = Admin::where('adminID', (int) $adminID)->firstOrFail();
        $admin->delete();
        return redirect()->route('admin.account.admin')->with('success', 'Nhân viên đã được xóa thành công.');
    }
}
