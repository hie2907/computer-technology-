@extends('users.pages.profiles.profile-index')
@section('main-profile')
    <main class="custom-main-content">
        <h1 class="custom-h1">Đơn hàng</h1>
        @foreach ($orders as $order)
            <section class="custom-section">
                <h2 class="custom-h2">Thông tin cơ bản</h2>
                <table class="custom-info-table">
                    <tr>
                        <td>ID đơn hàng</td>
                        <td>#{{ $order->orderID }}</td>
                    </tr>
                    <tr>
                        <td>Tổng đơn hàng</td>
                        <td>{{ $order->total_Amount }} đ</td>
                    </tr>
                    <tr>
                        <td>Thời gian đặt</td>
                        <td>{{ $order->order_Date }} 15:22:36</td>
                    </tr>
                    <tr>
                        <td>Trạng thái</td>
                        <td>
                            <div class="custom-status-buttons">
                                <button class="custom-btn custom-btn-pending">
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
                                <button class="custom-btn custom-btn-success">Thanh toán</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>Chi tiết đơn hàng</td>
                        <td><button class="custom-btn custom-btn-primary"
                                onclick="window.location.href='{{ route('client.profile-detail-order',$order->orderID) }}'">Chi
                                Tiết</button></td>
                    </tr>
                </table>
            </section>
        @endforeach
    </main>
@endsection
