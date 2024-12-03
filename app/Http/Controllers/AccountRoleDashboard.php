<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;

class AccountRoleDashboard extends Controller
{
    public function index(){
        $admins = Admin::whereIn('roleId', [1,2])->get();
        return view('admin.accounts.role.roleaccountDashboard', compact('admins'));
    }
    public function update($adminID){
        $adminID = (int) $adminID;
        $admin=Admin::where('adminID',$adminID)->first();
        if(!$admin){
            return abort(404,'khong tim thay');
        }
        return view('admin.accounts.role.components.updateroleDashboard',compact('admin'));
    }
     public function postupdate(Request $request, $adminID)
    {
        $request->validate([
            'adminName' => 'nullable|string|max:255',
            'email' => 'nullable|email',
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
        $data = array_filter($request->only(['adminName', 'email','roleId']));
        if (isset($data['roleId'])) {
            $data['roleId'] = (int) $data['roleId'];
        }
        $admin->update($data);
        return redirect()->route('admin.account.role')->with('success', 'Nhân viên đã được cập nhật thành công.');
    }

}
