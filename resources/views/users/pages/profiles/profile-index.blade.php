@extends('index')
@section('bodyclient')
    <div class="custom-body">
        <nav class="custom-sidebar">
            <ul class="custom-sidebar-nav">
                <li><a href="#">Tổng quan</a></li>
                <li><a href="#">Thông tin</a></li>
                <li><a href="#">Đơn hàng</a></li>
                <li><a href="#">Đổi mật khẩu</a></li>
                <li><a href="#">Đăng xuất</a></li>
            </ul>
        </nav>

        @yield('main-profile')
    </div>
@endsection
