<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AccountShipperDashboard extends Controller
{
    public function index()
    {
        $shippers = Admin::where('roleId', 3)->get();
        return view('admin.accounts.shipper.shipperAccountDashboard', compact('shippers'));
    }
    public function create()
    {
        return view('admin.accounts.shipper.components.addshipperAccountDashboard');
    }
    public function addshipper(Request $request)
    {
        $request->validate([
            'adminName' => 'required|string|max:255',
            'email' => 'required|email|unique:admin,email',
            'password' => 'required|min:6',
            'dateofBirth' => 'required|date',
            'address' => 'required|string|max:3255',
            'phone' => 'required|string',
        ]);
        $lastAdmin = Admin::orderBy('adminID', 'desc')->first();
        $adminID = $lastAdmin ? $lastAdmin->adminID + 1 : 1;
        $dateHired = Carbon::now();

        Admin::create([
            'adminID' => $adminID,
            'adminName' => $request->adminName,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'dateofBirth' => $request->dateofBirth,
            'phone' => $request->phone,
            'dateHired' => $dateHired->toDateTimeString(),
            'address' => $request->address,
            'status' => 'active',
            'roleId' => 3,
        ]);

        return redirect()->route('admin.account.shipper')->with('success', 'Nhân viên đã được thêm thành công.');
    }
    public function update($shipperId)
    {
        $shipperId = (int) $shipperId;
        $shipper = Admin::where('adminID', $shipperId)->first();
        if (!$shipper) {
            return abort(404, 'Không tìm thấy nhân viên với adminID này.');
        }
        return view('admin.accounts.shipper.components.updateshipperAccountDashboard', compact('shipper'));
    }
    public function postupdate(Request $request, $shipperId)
    {
        $request->validate([
            'adminName' => 'nullable|string|max:255',
            'email' => 'nullable|email',
            'dateofBirth' => 'nullable|date',
            'phone' => 'nullable|string',
            'address' => 'nullable|string|max:3255',
        ]);
        $shipper = Admin::where('adminID', (int) $shipperId)->firstOrFail();
        if ($request->filled('email') && $request->email !== $shipper->email) {
            $existingAdmin = Admin::where('email', $request->email)->first();
            if ($existingAdmin) {
                return redirect()
                    ->back()
                    ->withErrors(['email' => 'Email này đã tồn tại, vui lòng sử dụng email khác.']);
            }
        }

        $data = array_filter($request->only(['adminName', 'email', 'dateofBirth', 'phone', 'address', 'roleId']));
        if (isset($data['roleId'])) {
            $data['roleId'] = (int) $data['roleId'];
        }
        $shipper->update($data);
        return redirect()->route('admin.account.shipper')->with('success', 'Nhân viên đã được cập nhật thành công.');
    }
    public function delete($shipperId)
    {
        $shipper = Admin::where('adminID', (int) $shipperId)->firstOrFail();
        $shipper->delete();
        return redirect()->route('admin.account.shipper')->with('success', 'Nhân viên đã được xóa thành công.');
    }
}
