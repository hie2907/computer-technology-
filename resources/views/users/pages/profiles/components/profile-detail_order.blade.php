@extends('users.pages.profiles.profile-index')
@section('main-profile')
    <main class="custom-main-content">
        <section class="custom-section">
            <h2 class="custom-h2"><i class="fa fa-arrow-left"
                    onclick="window.location.href='{{ route('client.profile-order') }}'"></i> Thông tin chi tiết</h2>
            <table class="custom-detail-table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Tên Sản Phẩm</th>
                        <th>Giá Sản Phẩm</th>
                        <th>Số lượng</th>
                        <th>Ghi Chú</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{$order->product->productName}}</td>
                            <td>{{$order->price_Purchase}} đ</td>
                            <td>{{$order->quantity}}</td>
                            <td>{{$order->note}}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </section>
    </main>
@endsection
