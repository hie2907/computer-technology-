@extends('admin.dashboard')
@section('bodyDashboard')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Tài Khoản</h3>
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
                        <a href="#">Tài Khoản</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Shipper</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Shipper</h4>
                                <button class="btn btn-primary btn-round ms-auto"
                                    onclick="window.location.href='{{ route('admin.account.shipper.addshipper') }}'">
                                    <i class="fa fa-plus"></i>
                                    Thêm Shipper
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th>Họ Và Tên</th>
                                            <th>Email</th>
                                            <th>Ngày Sinh</th>
                                            <th>Địa Chỉ</th>
                                            <th>Số điện thoại</th>
                                            <th>Ngày tạo</th>
                                            <th>Chức Năng</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($shippers as $shipper)
                                            <tr>
                                                <td>{{ $shipper->adminName }}</td>
                                                <td>
                                                    {{ $shipper->email }}
                                                </td>
                                                <td>{{ $shipper->dateofBirth }}</td>
                                                <td>{{ $shipper->address }}</td>
                                                <td>{{ $shipper->phone }}</td>
                                                <td>{{ $shipper->dateHired }}</td>
                                                <td>
                                                    <div class="form-action">
                                                        <a
                                                            href="{{ route('admin.account.shipper.updateshipper', $shipper->adminID) }}">
                                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin.account.shipper.deleteshipper', $shipper->adminID) }}"
                                                            onclick="event.preventDefault();
                                                                if(confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')) {
                                                                document.getElementById('delete-form-{{ $shipper->adminID }}').submit();
                                                                        }">
                                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </a>
                                                        <form id="delete-form-{{ $shipper->adminID }}"
                                                            action="{{ route('admin.account.shipper.deleteshipper', $shipper->adminID) }}"
                                                            method="POST" style="display: none;">
                                                            @csrf
                                                            @method('DELETE')
                                                        </form>

                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
