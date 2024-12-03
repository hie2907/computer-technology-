@extends('admin.dashboard')
@section('bodyDashboard')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Đơn Hàng</h3>
                <ul class="breadcrumbs mb-3">
                    <li class="nav-home">
                        <a href="#">
                            <i class="icon-home"></i>
                        </a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Đơn Hàng</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Tất Cả Đơn Hàng</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Tất Cả Đơn Hàng</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Mã Đơn Hàng</th>
                                            <th class="text-center">Người Đặt</th>
                                            <th class="text-center">Ngày Đặt</th>
                                            <th class="text-center">Tổng tiền</th>
                                            <th class="text-center">Chi tiết</th>
                                            <th class="text-center">Trạng Thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($orders as $order)
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        {{ $order->orderID }}
                                                    </div>
                                                </td>
                                                <td>{{ $order->user->userName }}</td>
                                                <td>{{ $order->order_Date }}</td>
                                                <td>{{ $order->total_Amount }}</td>
                                                <td>
                                                    <div class="text-center">
                                                        <a href="{{ route('admin.order.detail-order', $order->orderID) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <button class="btn btn-black btn-border">
                                                            @if ($order->order_Status == 1)
                                                                Chờ Xác Nhận
                                                            @elseif ($order->order_Status == 2)
                                                                Đang Xử Lý
                                                            @elseif ($order->order_Status == 3)
                                                                Đang Giao
                                                            @elseif ($order->order_Status == 4)
                                                                Đã Giao
                                                            @endif
                                                        </button>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
