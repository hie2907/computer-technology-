<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminOrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        return view('admin.order.orderDashboard', compact('orders'));
    }
    public function detail_order($orderID)
    {
        $orderID = (int) $orderID;
        $detailOrders = OrderDetail::where('orderID', $orderID)->get();
        return view('admin.order.components.detailOrderDashboard', compact('detailOrders'));
    }
    public function confirmed_order()
    {
        $orders = Order::where('order_Status', 1)->get();
        return view('admin.order.components.confirmOrderDashboard', compact('orders'));
    }
    public function send_confirmed_order(Request $request, $orderID)
    {
        $orderID = (int) $orderID;
        $order = Order::where('orderID', $orderID)->firstOrFail();
        $order->order_Status = (int) $request->order_Status;
        $order->save();
        return redirect()->route('admin.order.confi-order')->with('success', 'Order status updated successfully.');
    }
    public function processing_order()
    {
        $orders = Order::where('order_Status', 2)->get();
        return view('admin.order.components.processOrderDashboard', compact('orders'));
    }
    public function send_processing_order(Request $request, $orderID)
    {
        $orderID = (int) $orderID;
        $order = Order::where('orderID', $orderID)->firstOrFail();
        if (Auth::guard('admin')->user()->roleId == 3) {
            $order->adminID = Auth::guard('admin')->user()->adminID;
            $order->order_Status = 3;
        } else {
            $order->adminID = Auth::guard('admin')->user()->adminID;
            $order->order_Status = (int) $request->order_Status;
        }
        $order->save();
        return redirect()->route('admin.order.process-order')->with('success', 'Order status updated successfully.');
    }
    public function delivery_order()
    {
        $shipperId = Auth::guard('admin')->user()->adminID;
        $order_deliveries = Order::where('adminID', $shipperId)->where('order_Status', 3)->get();
        return view('admin.order.components.deliveryOrderDashboard', compact('order_deliveries'));
    }
    public function admin_delivery_order()
    {
        $order_deliveries = Order::where('order_Status', 3)->get();
        return view('admin.order.components.deliveryAdminOrderDashboard', compact('order_deliveries'));
    }
    public function send_delivery_order(Request $request, $orderID)
    {
        $orderID = (int) $orderID;
        $order = Order::where('orderID', $orderID)->firstOrFail();
        $order->order_Status = (int) $request->order_Status;
        $order->save();
        return redirect()->route('admin.order.delivery-order')->with('success', 'Order status updated successfully.');
    }
    public function delivered_order()
    {
        $shipperId = Auth::guard('admin')->user()->adminID;
        $order_deliveries = Order::where('adminID', $shipperId)->where('order_Status', 4)->get();
        return view('admin.order.components.deleveredOrderDashboard', compact('order_deliveries'));
    }
    public function admin_delivered_order()
    {
        $order_deliveries = Order::where('order_Status', 4)->get();
        return view('admin.order.components.deleveredAdminOrderDashboard', compact('order_deliveries'));
    }
}
