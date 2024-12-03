<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;

class AdminCategoryController extends Controller
{
    public function index()
    {
        $categories = Category::all();
        return view('admin.products.category.categoryProduct', compact('categories'));
    }
    public function create()
    {
        return view('admin.products.category.components.addcategoryDasboard');
    }
    public function addcategory(Request $request)
    {
        $request->validate([
            'categoryName' => 'required|string|max:255',
        ]);
        $lastCategory = Category::orderBy('categoryId', 'desc')->first();
        $categoryId = $lastCategory ? $lastCategory->categoryId + 1 : 1;
        Category::create([
            'categoryId' => $categoryId,
            'categoryName' => $request->categoryName,
        ]);
        return redirect()->route('admin.products.category')->with('success', 'Danh mục đã được thêm thành công.');
    }
    public function update($categoryId)
    {
        $categoryId = (int) $categoryId;
        $category = Category::where('categoryId', $categoryId)->first();
        if (!$category) {
            return abort(404, 'Không tìm thấy nhân viên với categoryId này.');
        }
        return view('admin.products.category.components.updatecategoryDashboard', compact('category'));
    }
    public function postupdate(Request $request, $categoryId)
    {
        $request->validate([
            'categoryName' => 'nullable|string|max:255',
        ]);
        $category = Category::where('categoryId', (int) $categoryId)->firstOrFail();
        $data = array_filter($request->only(['categoryName']));
        $category->update($data);
        return redirect()->route('admin.products.category')->with('success', 'Nhân viên đã được cập nhật thành công.');
    }
    public function delete($categoryId)
    {
        $category = Category::where('categoryId', (int) $categoryId)->firstOrFail();
        $category->delete();
        return redirect()->route('admin.products.category')->with('success', 'Nhân viên đã được xóa thành công.');
    }
}
