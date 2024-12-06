@extends('admin.dashboard')
@section('bodyDashboard')
    <div class="container">
        <div class="page-inner">
            <div class="page-header">
                <h3 class="fw-bold mb-3">Sản Phẩm</h3>
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
                        <a href="#">Sản Phẩm</a>
                    </li>
                    <li class="separator">
                        <i class="icon-arrow-right"></i>
                    </li>
                    <li class="nav-item">
                        <a href="#">Sản Phẩm</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="d-flex align-items-center">
                                <h4 class="card-title">Sản Phẩm</h4>
                                <button class="btn btn-primary btn-round ms-auto"
                                    onclick="window.location.href='{{ route('admin.products.products.addproduct') }}'">
                                    <i class="fa fa-plus"></i>
                                    Thêm
                                </button>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table id="basic-datatables" class="display table table-striped table-hover">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Tên Sản Phẩm</th>
                                            <th class="text-center">Hình Ảnh</th>
                                            <th class="text-center">Số Lượng</th>
                                            <th class="text-center">Giá</th>
                                            <th class="text-center">Ngày Cập Nhật</th>
                                            <th class="text-center">Quản Lý</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($products as $product)
                                            <tr>
                                                <td>{{ $product->productName }}</td>
                                                <td>
                                                    <img src="{{ asset( $product->images['mainImage']) }}" alt="{{ $product->productName }}" class="rounded" style="width: 100px">
                                                </td>
                                                <td>{{$product->stockQuantity}}</td>
                                                <td>{{ number_format($product->price, 0, ',', '.') }} đ</td>
                                                <td>{{$product->dateAdded}}</td>
                                                <td>
                                                    <div class="form-actio text-center">
                                                        <a href="{{route('admin.products.products.updateproduct',$product->productId)}}">
                                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-primary btn-lg"
                                                                data-original-title="Edit Task">
                                                                <i class="fa fa-edit"></i>
                                                            </button>
                                                        </a>
                                                        <a href="{{ route('admin.products.products.deleteproduct', $product->productId) }}"
                                                            onclick="event.preventDefault();
                                                                if(confirm('Bạn có chắc chắn muốn xóa nhân viên này không?')) {
                                                                document.getElementById('delete-form-{{ $product->productId }}').submit();
                                                                        }">
                                                            <button type="button" data-bs-toggle="tooltip" title=""
                                                                class="btn btn-link btn-danger"
                                                                data-original-title="Remove">
                                                                <i class="fa fa-times"></i>
                                                            </button>
                                                        </a>
                                                        <form id="delete-form-{{ $product->productId }}"
                                                            action="{{ route('admin.products.products.deleteproduct', $product->productId) }}"
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
