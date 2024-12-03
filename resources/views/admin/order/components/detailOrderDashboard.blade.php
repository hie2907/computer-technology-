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
                        <a href="{{route('admin.order.list-order')}}">Đơn Hàng</a>
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
                                <table class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Mã Đơn Hàng</th>
                                            <th class="text-center">Mã Sản Phẩm</th>
                                            <th class="text-center">Sản Phẩm</th>
                                            <th class="text-center">Giá</th>
                                            <th class="text-center">Số lượng</th>
                                            <th class="text-center">Ghi chú</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($detailOrders as $detailOrder)
                                            <tr class="text-center">
                                                <td>
                                                    <div class="text-center">
                                                        {{ $detailOrder->orderID }}
                                                    </div>
                                                </td>
                                                <td>{{ $detailOrder->product->productId }}</td>
                                                <td>{{ $detailOrder->product->productName }}</td>
                                                <td>{{ $detailOrder->price_Purchase }}</td>
                                                <td>{{ $detailOrder->quantity }}</td>
                                                <td>{{ $detailOrder->note }}</td>
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
