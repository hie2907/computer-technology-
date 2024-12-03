<?php
namespace App\Http\Controllers;

use App\Models\CartItems;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class ClientCart extends Controller
{
    private function generateCartItemId()
    {
        $lastCartItem = CartItems::orderBy('cartItemId', 'desc')->first();
        return $lastCartItem ? $lastCartItem->cartItemId + 1 : 1;
    }
    public function cart_item(Request $request)
    {
        Log::info('cart_item method called');

        if (Auth::guard('user')->check()) {
            $cartItems = $request->all();
            Log::info('Cart Items Received: ', ['cartItems' => $cartItems]);

            try {
                $userId = Auth::id();

                // Lấy tất cả các sản phẩm hiện tại từ database
                $currentCartItems = CartItems::where('cartId', $userId)->get()->keyBy('productId')->toArray();
                Log::info('Current Cart Items: ', ['currentCartItems' => $currentCartItems]);

                // Cập nhật hoặc thêm mới sản phẩm từ storage
                foreach ($cartItems as $item) {
                    if (isset($currentCartItems[$item['productId']])) {
                        // Nếu sản phẩm đã tồn tại, cập nhật số lượng
                        $currentCartItems[$item['productId']]['quantity'] = $item['quantity'];
                        CartItems::where([['productId', '=', $item['productId']], ['cartId', '=', $userId]])->update(['quantity' => $item['quantity']]);
                    } else {
                        // Nếu sản phẩm chưa tồn tại, thêm mới
                        $cartItemId = $this->generateCartItemId();
                        CartItems::create([
                            'cartItemId' => $cartItemId,
                            'productId' => $item['productId'],
                            'cartId' => $userId,
                            'quantity' => $item['quantity'],
                        ]);
                    }
                }

                // Xóa các sản phẩm không có trong storage
                $storageProductIds = array_column($cartItems, 'productId');
                CartItems::where('cartId', $userId)->whereNotIn('productId', $storageProductIds)->delete();

                // Trả về dữ liệu hiện tại trong database
                $updatedCartItems = CartItems::where('cartId', $userId)->get();
                Log::info('Updated Cart Items: ', ['updatedCartItems' => $updatedCartItems->toArray()]);
                return response()->json($updatedCartItems, 200);
            } catch (\Exception $e) {
                Log::error('Error updating cart items: ' . $e->getMessage());
                return response()->json(['message' => 'Internal Server Error'], 500);
            }
        }

        Log::error('Unauthorized access');
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
