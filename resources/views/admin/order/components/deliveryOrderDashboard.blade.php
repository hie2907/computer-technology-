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
                        <a href="#">Đơn Hàng Đang Giao</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Đơn Hàng Đang Giao</h4>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Mã Đơn Hàng</th>
                                            <th class="text-center">Khách Hàng</th>
                                            <th class="text-center">Địa Chỉ</th>
                                            <th class="text-center">SDT</th>
                                            <th class="text-center">Tổng tiền</th>
                                            <th class="text-center">Chi tiết</th>
                                            <th class="text-center">Trạng Thái</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($order_deliveries as $order_delivery)
                                            <tr>
                                                <td>
                                                    <div class="text-center">
                                                        {{ $order_delivery->orderID }}
                                                    </div>
                                                </td>
                                                <td>{{ $order_delivery->user->userName }}</td>
                                                <td>{{ $order_delivery->orderInfo->location }}</td>
                                                <td>{{ $order_delivery->orderInfo->phone }}</td>
                                                <td>{{ $order_delivery->total_Amount }}</td>
                                                <td>
                                                    <div class="text-center">
                                                        <a
                                                            href="{{ route('admin.order.detail-order', $order_delivery->orderID) }}">
                                                            <i class="fa fa-eye"></i>
                                                        </a>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="text-center">
                                                        <form
                                                            action="{{ route('admin.order.put-delivery-order', $order_delivery->orderID) }}"
                                                            method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <select class="form-select input-fixed mx-auto"
                                                                style="width: 150px" name="order_Status" required
                                                                onchange="this.form.submit()">
                                                                <option value="3"
                                                                    {{ $order_delivery->order_Status == 3 ? 'selected' : '' }}>Đang Giao</option>
                                                                <option value="4"
                                                                    {{ $order_delivery->order_Status == 4 ? 'selected' : '' }}>Đã Giao</option>
                                                            </select>
                                                        </form>
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
