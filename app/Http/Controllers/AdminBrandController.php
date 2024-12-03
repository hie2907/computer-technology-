<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminBrandController extends Controller
{
    public function index()
    {
        $brands = Brand::all();
        return view('admin.products.brand.brandProductDashboard', compact('brands'));
    }
    public function create()
    {
        $categories = Category::all();
        return view('admin.products.brand.components.addbrandDashboard', compact('categories'));
    }
    public function addbrand(Request $request)
    {
        $request->validate([
            'brandName' => 'required|string|max:255',
        ]);
        $lastBrand = Brand::orderBy('brandId', 'desc')->first();
        $brandId = $lastBrand ? $lastBrand->brandId + 1 : 1;
        Brand::create([
            'brandId' => $brandId,
            'brandName' => $request->brandName,
            'categoryId' => (int) $request-> categoryId,
        ]);
        return redirect()->route('admin.products.brand')->with('success', 'Thuong hieu đã được thêm thành công.');
    }
    public function update($brandId)
    {
        $brandId = (int) $brandId;
        $brand = Brand::where('brandId', $brandId)->first();
        $categories= Category::all();
        if (!$brand) {
            return abort(404, 'Không tìm thấy nhân viên với brandId này.');
        }
        return view('admin.products.brand.components.updatebrandDashboard', compact('brand','categories'));
    }
    public function postupdate(Request $request, $brandId)
    {
        $request->validate([
            'brandName' => 'nullable|string|max:255',
            'categoryId' => 'nullable|integer',
        ]);
        $brand = Brand::where('brandId', (int) $brandId)->firstOrFail();
        $data = array_filter($request->only(['brandName','categoryId']));
        $data['categoryId'] = (int) $data['categoryId'];
        $brand->update($data);
        return redirect()->route('admin.products.brand')->with('success', 'Nhân viên đã được cập nhật thành công.');
    }
    public function delete($brandId)
    {
        $brand = Brand::where('brandId', (int) $brandId)->firstOrFail();
        $brand->delete();
        return redirect()->route('admin.products.brand')->with('success', 'Nhân viên đã được xóa thành công.');
    }
}
