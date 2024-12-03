<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientProfile extends Controller
{
    public function profile_order(){
        $userId= Auth::guard('user')->user()->userID;
        $orders=Order::where('userID', $userId)->get();
        return view('users.pages.profiles.components.profile-list_order',compact('orders'));
    }
    public function profile_order_detail($orderId){
        $orderId= (int) $orderId;
        $orders= OrderDetail::where('orderID',$orderId)->get();
        return view('users.pages.profiles.components.profile-detail_order',compact('orders'));
    }
}
