<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Carbon\Carbon;
use Illuminate\Http\Request;

class AdminProductController extends Controller
{
    public function index()
    {
        $products = Product::all();
        return view('admin.products.product.productDashboard', compact('products'));
    }
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        return view('admin.products.product.components.addproductDasboard', compact('categories', 'brands'));
    }
    public function addproduct(Request $request)
    {
        $request->validate([
            'productName' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stockQuantity' => 'required|integer',
            'mainImage' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'additionalImages.*' => 'image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
        $lastProduct = Product::orderBy('productId', 'desc')->first();
        $productId = $lastProduct ? $lastProduct->productId + 1 : 1;
        $dateAdded = Carbon::now();
        $additionalImages = [];
        // Tải lên hình ảnh chính lên Cloudinary
        $mainImage = $request->file('mainImage');
        $mainImagePath = cloudinary()->upload($mainImage->getRealPath())->getSecurePath();

        // Tải lên các hình ảnh bổ sung lên Cloudinary
        $additionalImages = [];
        if ($request->hasFile('additionalImages')) {
            foreach ($request->file('additionalImages') as $file) {
                $path = cloudinary()->upload($file->getRealPath())->getSecurePath();
                $additionalImages[] = $path;
            }
        }

        Product::create([
            'productId' => $productId,
            'productName' => $request->productName,
            'description' => $request->description,
            'price' => $request->price,
            'stockQuantity' => (int) $request->stockQuantity,
            'images' => [
                'mainImage' => $mainImagePath,
                'additionalImages' => $additionalImages,
            ],
            'categoryId' => (int) $request->categoryId,
            'brandId' => (int) $request->brandId,
            'dateAdded' => $dateAdded->toDateString(),
        ]);
        return redirect()->route('admin.products.products')->with('success', 'Sản phẩm đã được thêm thành công.');
    }
    public function update($productId)
    {
        $productId = (int) $productId;
        $products = Product::where('productId', $productId)->first();
        $brands = Brand::all();
        $categories = Category::all();
        if (!$products) {
            print 'loi';
        }
        return view('admin.products.product.components.updateproductDashboard', compact('products', 'brands', 'categories'));
    }
    public function postupdate(Request $request, $productId)
    {
        $request->validate([
            'productName' => 'nullable|string|max:255',
            'description' => 'nullable|string',
            'price' => 'nullable|numeric',
            'stockQuantity' => 'nullable|integer',
            'categoryId' => 'nullable|integer',
            'brandId' => 'nullable|integer',
            'mainImage' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'additionalImages.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $product = Product::where('productId', (int) $productId)->firstOrFail();
        $data = array_filter($request->only(['productName', 'description', 'price', 'stockQuantity', 'categoryId', 'brandId']));
        $currentImages = $product->images;

        // Cập nhật ảnh chính nếu có
        if ($request->hasFile('mainImage')) {
            // Xóa ảnh cũ khỏi Cloudinary nếu có
            if (isset($currentImages['mainImage'])) {
                cloudinary()->destroy($currentImages['mainImage']);
            }
            // Tải lên ảnh mới lên Cloudinary
            $mainImagePath = cloudinary()->upload($request->file('mainImage')->getRealPath())->getSecurePath();
            $data['images']['mainImage'] = $mainImagePath;
        } else {
            $data['images']['mainImage'] = $currentImages['mainImage'] ?? null;
        }

        // Cập nhật ảnh bổ sung nếu có
        if ($request->hasFile('additionalImages')) {
            // Xóa ảnh bổ sung cũ khỏi Cloudinary nếu có
            if (isset($currentImages['additionalImages']) && is_array($currentImages['additionalImages'])) {
                foreach ($currentImages['additionalImages'] as $oldImage) {
                    cloudinary()->destroy($oldImage);
                }
            }

            $additionalImages = [];
            foreach ($request->file('additionalImages') as $file) {
                $path = cloudinary()->upload($file->getRealPath())->getSecurePath();
                $additionalImages[] = $path;
            }
            $data['images']['additionalImages'] = $additionalImages;
        } else {
            $data['images']['additionalImages'] = $currentImages['additionalImages'] ?? [];
        }

        if (isset($data['categoryId'])) {
            $data['categoryId'] = (int) $data['categoryId'];
        }
        if (isset($data['brandId'])) {
            $data['brandId'] = (int) $data['brandId'];
        }

        $product->update($data);

        return redirect()->route('admin.products.products')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    public function delete($productId)
    {
        $product = Product::where('productId', (int) $productId)->firstOrFail();
        $images = $product->images;

        // Xóa ảnh chính khỏi Cloudinary nếu có
        if (isset($images['mainImage'])) {
            cloudinary()->destroy($images['mainImage']);
        }
        // Xóa ảnh bổ sung khỏi Cloudinary nếu có
        if (isset($images['additionalImages']) && is_array($images['additionalImages'])) {
            foreach ($images['additionalImages'] as $image) {
                cloudinary()->destroy($image);
            }
        }
        $product->delete();
        return redirect()->route('admin.products.products')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
