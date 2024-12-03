@extends('admin.auth.components.formAuthencation')
@section('formAuthen')
    <form method="POST" action="{{ route('admin.login') }}">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Đăng Nhập</label>
            <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
        </div>
        <div class="mb-4">
            <label for="exampleInputPassword1" class="form-label">Mật Khẩu</label>
            <input type="password" class="form-control" name="password" id="exampleInputPassword1">
        </div>
        <div class="d-flex align-items-center justify-content-between mb-4">
            <div class="form-check">
                <input class="form-check-input primary" type="checkbox" value="" id="flexCheckChecked" checked>
                <label class="form-check-label text-dark" for="flexCheckChecked">
                    Ghi nhớ mật khẩu
                </label>
            </div>
            <a class="text-primary fw-bold" href="./index.html">Quên Mật khẩu ?</a>
        </div>
        <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4 rounded-2">Đăng Nhập</button>
        <div class="d-flex align-items-center justify-content-center">
            <p class="fs-4 mb-0 fw-bold">Chưa có tài khoản?</p>
            <a class="text-primary fw-bold ms-2" href="{{ route('admin.register.form') }}">Đăng ký</a>
        </div>
    </form>
@endsection
