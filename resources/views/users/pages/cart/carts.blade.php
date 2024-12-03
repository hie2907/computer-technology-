@extends('index')
@section('bodyclient')
    <div class="container-cart">
        <div class="header-cart">
            <h1>Giỏ hàng</h1>
            <a href="#" id="delete-all">Xóa tất cả</a>
        </div>

        <div class="card-cart">
            <div class="company-cart">
                <input type="checkbox" id="select-all">
                <span class="company-name-cart">TRUNG TÂM MÁY TÍNH ĐÌNH LƯU</span>
            </div>

            <div id="cart-items">
            </div>
        </div>

        <div class="card-cart checkout-card-cart">
            <h2 class="checkout-title-cart">Thanh toán</h2>

            <div class="checkout-row-cart">
                <span>Tổng tạm tính</span>
                <span id="subtotal">0đ</span>
            </div>

            <div class="checkout-row-cart">
                <span>Thành tiền</span>
                <span id="total-price" class="checkout-total-cart">0đ</span>
            </div>

            <div class="vat-text-cart">(Đã bao gồm VAT)</div>

            <button class="checkout-btn-cart"> THANH TOÁN</button>
            <div class="login-text-cart">Bạn cần đăng nhập để tiếp tục</div>
        </div>
    </div>
    <script src="{{asset('client/js/cart.js')}}"></script>
    <script src="{{asset('client/js/cartFunction.js')}}"></script>
@endsection
