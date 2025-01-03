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
    public function search(Request $request)
    {
        $search = $request->input('seach_query');
        $products = Product::where('productName', 'LIKE', "%$search%")
            ->orWhereHas('category', function ($q) use ($search) {
                $q->where('categoryName', 'LIKE', "%$search%");
            })
            ->get();
        $sidebarBrands = Brand::all();
        $sidebarCategories = Category::all();

        return view('users.pages.products.product', compact('products', 'sidebarCategories', 'sidebarBrands'));
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

            Log::info('Received category IDs:', ['ids' => $category_ids]);
            Log::info('Received brand IDs:', ['ids' => $brand_ids]);
            Log::info('Received price min:', ['value' => $price_min]);
            Log::info('Received price max:', ['value' => $price_max]);
            Log::info('Received sort option:', ['option' => $sort_option]);
            Log::info('Received display count:', ['count' => $display_count]);

            $query = Product::query();
            if (!empty($category_ids) && is_array($category_ids)) {
                $category_ids = array_map('intval', $category_ids);
                $query->whereIn('categoryId', $category_ids);
            }
            if (!empty($brand_ids) && is_array($brand_ids)) {
                $brand_ids = array_map('intval', $brand_ids);
                $query->whereIn('brandId', $brand_ids);
            }
            if (!empty($price_min) && !empty($price_max)) {
                // Ép kiểu giá trị price sang float
                $price_min = (string) $price_min;
                $price_max = (string) $price_max;
                $query->whereBetween('price', [$price_min, $price_max]);
            }
            if (!empty($sort_option)) {
                if ($sort_option == '0') {
                    $query->orderByRaw('price + 0 DESC'); // Ép kiểu gián tiếp bằng cách cộng thêm 0
                } elseif ($sort_option == '1') {
                    $query->orderByRaw('price + 0 ASC'); // Ép kiểu gián tiếp bằng cách cộng thêm 0
                }
            }

            if (!empty($display_count)) {
                $query->limit((int) $display_count);
            }

            Log::info('SQL Query:', ['query' => $query->toSql()]);
            $products = $query->get();
            Log::info('Number of products found:', ['count' => $products->count()]);

            if ($products->isEmpty()) {
                Log::info('No products found matching the criteria');
            }

            $html = view('users.pages.products.components.productList', compact('products'))->render();
            return response()->json(['html' => $html]);
        } catch (\Exception $e) {
            Log::error('Error filtering products: ' . $e->getMessage());
            return response()->json(['error' => 'An error occurred'], 500);
        }
    }

    public function product_camera()
    {
        $sidebarCategories = Category::all();
        $sidebarBrands = Brand::all();
        $products = Product::with('category')->where('categoryId', 2)->get();
        return view('users.pages.products.custom.product_camera', compact('sidebarCategories', 'sidebarBrands', 'products'));
    }
    public function product_laptop()
    {
        $sidebarCategories = Category::all();
        $sidebarBrands = Brand::all();
        $products = Product::with('category')->where('categoryId', 1)->get();
        return view('users.pages.products.custom.product_camera', compact('sidebarCategories', 'sidebarBrands', 'products'));
    }
    public function product_accessory()
    {
        $sidebarCategories = Category::all();
        $sidebarBrands = Brand::all();
        $products = Product::with('category')->where('categoryId', 3)->get();
        return view('users.pages.products.custom.product_camera', compact('sidebarCategories', 'sidebarBrands', 'products'));
    }
    /* api */
    public function get_popular_products_laptop(Request $request)
    {
        $list = Product::where('categoryId', 1)->take(10)->orderBy('created_at', 'DESC')->get();

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
    public function get_popular_products_camera(Request $request)
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
    public function get_popular_products_accessory(Request $request)
    {
        $list = Product::where('categoryId', 3)->take(10)->orderBy('created_at', 'DESC')->get();

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
    /* end api */
}
