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
                        <a href="{{ route('admin.order.list-order') }}">Đơn Hàng</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Đơn Hàng Chờ Xử Lý</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Đơn Hàng Chờ Xử Lý</h4>
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
                                                        @if (Auth::guard('admin')->user()->roleId == 3)
                                                            <form
                                                                action="{{ route('admin.order.put-process-order', $order->orderID) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button class="btn btn-black btn-border">
                                                                    Nhận Đơn Hàng
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form
                                                                action="{{ route('admin.order.put-process-order', $order->orderID) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <select class="form-select input-fixed mx-auto"
                                                                    style="width: 150px" name="order_Status" required
                                                                    onchange="this.form.submit()">
                                                                    <option value="2"
                                                                        {{ $order->order_Status == 2 ? 'selected' : '' }}>
                                                                        Đang
                                                                        Xử lý</option>
                                                                    <option value="3"
                                                                        {{ $order->order_Status == 3 ? 'selected' : '' }}>
                                                                        Nhận Đơn Hàng</option>
                                                                </select>
                                                            </form>
                                                        @endif
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
