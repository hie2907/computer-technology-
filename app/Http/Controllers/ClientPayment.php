<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\OrderInfo;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ClientPayment extends Controller
{
    public function index(){
        return view('users.pages.cart.payment');
    }
    public function post_payment(Request $request){
        $lastOrder = Order::orderBy('orderID', 'desc')->first();
        $orderID = $lastOrder ? $lastOrder->orderID + 1 : 1;
        $order_Date = Carbon::now();
         // Tạo một đơn hàng mới
        $order = Order::create([
            'orderID'=> $orderID,
            'userID' => auth()->id(), // Hoặc có thể là null nếu khách hàng không đăng nhập
            'order_Date' => $order_Date->toDateString(),
            'total_Amount' =>(float)$request->total,
            'order_Status' => 1,
        ]);

        $lastdetailOrder = Order::orderBy('order_infoID', 'desc')->first();
        $order_detailID = $lastdetailOrder ? $lastdetailOrder->order_detailID + 1 : 1;
        // Lưu thông tin chi tiết đơn hàng
        foreach ($request->products as $product) {
            OrderDetail::create([
                'order_detailID'=>$order_detailID,
                'orderID' => $order->orderID,
                'productId' => $product['productId'],
                'quantity' => $product['quantity'],
                'price_Purchase' => (float)$product['price'],
                'note' => $request->note,
            ]);
        }

        $lastinfoOrder = Order::orderBy('order_infoID', 'desc')->first();
        $order_infoID = $lastinfoOrder ? $lastinfoOrder->order_infoID + 1 : 1;
        // Lưu thông tin người đặt hàng
        OrderInfo::create([
            'order_infoID'=>$order_infoID,
            'orderID' => $order->orderID,
            'name' => $request->name,
            'email' => $request->email,
            'location' => $request->location,
            'phone' => $request->phone,
        ]);

        return response()->json(['success' => true, 'message' => 'Order placed successfully.']);

    }
}
