@extends('admin.dashboard')
@section('bodyDashboard')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Tài khoản</h3>
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
                        <a href="#">Tài khoản</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Quyền Quản Lý</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Cập Nhật Quyền</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form method="POST"
                                    action="{{ route('admin.account.role.postupdaterole', $admin->adminID) }}">
                                    @csrf
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="username">Họ Và Tên</label>
                                            <input type="text" name="adminName" class="form-control"
                                                value="{{ old('adminName', $admin->adminName) }}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email2">Email</label>
                                            <input type="email" name="email" class="form-control"
                                                value="{{ old('email', $admin->email) }}" />
                                        </div>
                                        <div class="form-group">
                                            <div class="col-lg-4 col-md-9 col-sm-8">
                                                <label for="username">Chọn Quyền Quản Lý</label>
                                                <select class="form-select input-fixed" name="roleId" required>
                                                    <option value="1" {{ $admin->roleId == 1 ? 'selected' : '' }}>Admin
                                                    </option>
                                                    <option value="2" {{ $admin->roleId == 2 ? 'selected' : '' }}>
                                                        Employee</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Bạn có đồng ý với điều khoản này không
                                            </label>
                                        </div>
                                        <input type="hidden" name="dateHired" value="{{ \Carbon\Carbon::now() }}" />
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="submit">Cập Nhật</button>
                                        <button class="btn btn-danger" type="button"
                                            onclick="window.location.href='{{ route('admin.account.role') }}'">Hủy</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
