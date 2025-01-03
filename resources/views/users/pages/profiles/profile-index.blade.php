@extends('index')
@section('bodyclient')
    <div class="custom-body">
        <nav class="custom-sidebar">
            <ul class="custom-sidebar-nav">
                <li><a href="#">Tổng quan</a></li>
                <li><a href="{{route('client.profile-info')}}">Thông tin</a></li>
                <li><a href="{{route('client.profile-order')}}">Đơn hàng</a></li>
                <li><a href="{{route('client.profile-change_pass')}}">Đổi mật khẩu</a></li>
            </ul>
        </nav>

        @yield('main-profile')
    </div>
@endsection
