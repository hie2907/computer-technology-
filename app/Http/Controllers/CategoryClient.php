<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryClient extends Controller
{
    public function index()
    {
        $sidebarCategories = Category::all();
        $sidebarBrands = Brand::all();
        $products = Product::all();
        return view('users.pages.products.product', compact('sidebarCategories', 'sidebarBrands', 'products'));
    }
    public function filterProducts(Request $request)
    {
        try {
            $category_ids = $request->input('category_ids');
            $brand_ids = $request->input('brand_ids');
            $price_min = $request->input('price_min');
            $price_max = $request->input('price_max');
            $sort_option = $request->input('sort_option');
            $display_count = $request->input('display_count');

            $query = Product::query();
            if (!empty($category_ids)) {
                $category_ids = array_map('intval', $category_ids);
                $query->whereIn('categoryId', $category_ids);
            }
            if (!empty($brand_ids)) {
                $brand_ids = array_map('intval', $brand_ids);
                $query->whereIn('brandId', $brand_ids);
            }
            if (!empty($price_min) && !empty($price_max)) {
                $query->whereBetween('price', [(float) $price_min, (float) $price_max]);
            }
            if (!empty($sort_option)) {
                if ($sort_option == '0') {
                    $query->orderBy('price', 'desc');
                } elseif ($sort_option == '1') {
                    $query->orderBy('price', 'asc');
                }
            }
            if (!empty($display_count)) {
                $query->limit((int) $display_count);
            }
            $products = $query->get();
            $html = view('users.pages.products.components.productList', compact('products'))->render();
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            Log::error('Error filtering products: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }
    public function get_popular_products(Request $request)
    {
        $list = Product::where('categoryId', 2)->take(10)->orderBy('created_at', 'DESC')->get();

        foreach ($list as $item) {
            $item['description'] = strip_tags($item['description']);
            $item['description'] = $Content = preg_replace('/&#?[a-z0-9]+;/i', ' ', $item['description']);
        }

        $data = [
            'total_size' => $list->count(),
            'type_id' => 2,
            'offset' => 0,
            'products' => $list,
        ];

        return response()->json($data, 200);
    }
}
