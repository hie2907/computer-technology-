<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class DetailProductClient extends Controller
{
    public function index($productId)
    {
        $productId = (int) $productId;
        $products = Product::where('productId', $productId)->first();
        $recommendedProducts = $this->getRecommendedProducts($productId);
        return view('users.pages.products.detailProduct', compact('products', 'recommendedProducts'));
    }

    private function getRecommendedProducts($productId)
    {
        // Đường dẫn đến script Python của bạn
        $scriptPath = base_path('python-scripts/script.py');

        // Tạo đối tượng dữ liệu sản phẩm
        $productData = json_encode(['productId' => $productId]);

        // Gọi script Python và lấy kết quả trả về
        $command = "python \"$scriptPath\" \"" . addslashes($productData) . "\" 2>&1";
        $output = shell_exec($command);

        // Chuyển đổi kết quả trả về từ JSON thành mảng đối tượng
        $recommendedProducts = json_decode($output, false); // Sử dụng `false` để nhận đối tượng

        // Giải mã thuộc tính images nếu cần
        foreach ($recommendedProducts as $product) {
            if (is_string($product->images)) {
                $product->images = json_decode($product->images, true);
            }
        }
        $categories= Category::all()->keyBy('categoryId');
        foreach($recommendedProducts as $product){
            $product->category1= $categories[$product->categoryId] ?? null;
        }
        return $recommendedProducts;
    }
}
