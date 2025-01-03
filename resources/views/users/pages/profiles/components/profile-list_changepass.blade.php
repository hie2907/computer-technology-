@extends('users.pages.profiles.profile-index')
@section('main-profile')
    <main class="custom-main-content">
        <h1 class="custom-h1">Thay Đổi Mật Khẩu</h1>
        <div class="row">
            <form method="POST" action="{{ route('client.profile-update_pass') }}">
                @csrf
                <div class="col-md-7">
                    <div class="billing-details">
                        <div class="section-title">
                            <h5 class="title">Mật khẩu hiện tại</h5>
                        </div>
                        <div class="form-group">
                            <input class="input" type="password" name="password_old">
                        </div>
                        <div class="form-group">
                            <input class="input" type="password" name="password" placeholder="Mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <input class="input" type="password" name="password_confirm"
                                placeholder="Xác nhận mật khẩu mới">
                        </div>
                        <div class="form-group">
                            <button class="custom-btn custom-btn-success" type="submit">Cập Nhật</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </main>
@endsection
