@extends('admin.auth.components.formAuthencation')
@section('formAuthen')
    <!--  Body Wrapper -->
    <form method="POST" action="{{ route('admin.register') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputtext1" class="form-label">Tên</label>
            <input type="text" class="form-control" name="adminName" id="exampleInputtext1" aria-describedby="textHelp"
                required>
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Email</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp"
                required>
        </div>
        <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label">Mật khẩu</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1" required>
        </div>
        <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label">Xác Nhận Mật Khẩu</label>
            <input type="password" class="form-control" name="password_confirmation" id="exampleInputPassword1" required>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Đăng Ký</button>
        <div class="d-flex align-items-center justify-content-center">
            <p class="fs-4 mb-0 fw-bold">Bạn đã có tài khoản?</p>
            <a class="text-primary fw-bold ms-2" href="{{ route('admin.login.form') }}">Đăng Nhập</a>
        </div>
    </form>
@endsection
