<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ClientPayment extends Controller
{
    public function index()
    {
        return view('users.pages.cart.payment');
    }
    public function bank_payment(Request $request)
    {
        $paymentMethod = $request->input('paymentMethod');
        if ($paymentMethod === 'zalopay') {
            $config = [
                'app_id' => 2553,
                'key1' => 'PcY4iZIKFCIdgZvA6ueMcMHHUbRLYjPL',
                'key2' => 'kLtgPl8HHhfvMuDHPwKfgfsY4Ydm9eIz',
                'endpoint' => 'https://sb-openapi.zalopay.vn/v2/create',
            ];

            $embeddata = json_encode(['redirecturl' => 'https://fb.com']);
            $items = '[]';
            $transID = rand(0, 1000000);
            $order = [
                'app_id' => $config['app_id'],
                'app_time' => round(microtime(true) * 1000),
                'app_trans_id' => date('ymd') . '_' . $transID,
                'app_user' => 'user123',
                'item' => $items,
                'embed_data' => $embeddata,
                'amount' => 50000,
                'description' => "Lazada - Payment for the order #$transID",
                'bank_code' => '',
                'callback_url' => 'https://your-callback-url.com/zalo_pay/callback.php',
            ];

            $data = $order['app_id'] . '|' . $order['app_trans_id'] . '|' . $order['app_user'] . '|' . $order['amount'] . '|' . $order['app_time'] . '|' . $order['embed_data'] . '|' . $order['item'];
            $order['mac'] = hash_hmac('sha256', $data, $config['key1']);

            $context = stream_context_create([
                'http' => [
                    'header' => "Content-type: application/x-www-form-urlencoded\r\n",
                    'method' => 'POST',
                    'content' => http_build_query($order),
                ],
            ]);

            $resp = file_get_contents($config['endpoint'], false, $context);
            $result = json_decode($resp, true);
            if ($result['return_code'] == 1) {
                return redirect($result['order_url']);
            }
            return response()->json($result);
        }

        // Handle other payment methods or fallback
    }

    public function post_payment(Request $request)
    {
        $lastOrder = Order::orderBy('orderID', 'desc')->first();
        $orderID = $lastOrder ? $lastOrder->orderID + 1 : 1;
        $order_Date = Carbon::now();
        // Tạo một đơn hàng mới
        $order = Order::create([
            'orderID' => $orderID,
            'userID' => auth()->id(), // Hoặc có thể là null nếu khách hàng không đăng nhập
            'order_Date' => $order_Date->toDateString(),
            'total_Amount' => (float) $request->total,
            'order_Status' => 1,
        ]);

        $lastdetailOrder = Order::orderBy('order_infoID', 'desc')->first();
        $order_detailID = $lastdetailOrder ? $lastdetailOrder->order_detailID + 1 : 1;
        // Lưu thông tin chi tiết đơn hàng
        foreach ($request->products as $product) {
            OrderDetail::create([
                'order_detailID' => $order_detailID,
                'orderID' => $order->orderID,
                'productId' => $product['productId'],
                'quantity' => $product['quantity'],
                'price_Purchase' => (float) $product['price'],
                'note' => $request->note,
            ]);
        }

        $lastinfoOrder = Order::orderBy('order_infoID', 'desc')->first();
        $order_infoID = $lastinfoOrder ? $lastinfoOrder->order_infoID + 1 : 1;
        // Lưu thông tin người đặt hàng
        OrderInfo::create([
            'order_infoID' => $order_infoID,
            'orderID' => $order->orderID,
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => true, 'message' => 'Order placed successfully.']);
    }
}
