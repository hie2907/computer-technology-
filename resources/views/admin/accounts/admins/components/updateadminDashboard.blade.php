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
                        <a href="#">Nhân viên</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Cập nhật Nhân Viên</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Cập Nhật Nhân Viên</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="{{route('admin.account.admin.postupdateadmin',$admin->adminID)}}">
                                    @csrf
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="username">Họ Và Tên</label>
                                            <input type="text" name="adminName" class="form-control" value="{{old('adminName',$admin->adminName)}}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="email2">Email</label>
                                            <input type="email" name="email" class="form-control" value="{{old('email',$admin->email)}}" />
                                        </div>
                                        <div class="form-group">
                                            <label for="dob" class="form-label">Ngày Sinh</label>
                                            <input type="date" name="dateofBirth" value="{{old('dateofBirth',$admin->dateofBirth)}}" class="form-control" id="dob" name="dob">
                                        </div>
                                        <div class="form-group">
                                            <label for="adrress" class="form-label">Địa Chỉ</label>
                                            <input type="text" name="address" class="form-control" value="{{old('address',$admin->address)}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="email2">Số điện thoại</label>
                                            <input type="text" name="phone" value="{{old('phone',$admin->phone)}}" class="form-control" </div>
                                        </div>
                                        <div class="form-group">
                                            <input class="form-check-input" type="checkbox" value=""
                                                id="flexCheckDefault" />
                                            <label class="form-check-label" for="flexCheckDefault">
                                                Bạn có đồng ý với điều khoản này không
                                            </label>
                                        </div>
                                        <input type="hidden" name="dateHired" value="{{ \Carbon\Carbon::now() }}" />
                                        <input type="hidden" name="roleId" value="{{1}}" />
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="submit">Cập Nhật</button>
                                        <button class="btn btn-danger" type="button"
                                            onclick="window.location.href='{{ route('admin.account.employee') }}'">Hủy</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
