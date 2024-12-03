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
                        <a href="#">Thêm Sản Phẩm</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Thêm Sản Phẩm</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="{{ route('admin.products.products.postaddproduct') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="productName">Tên Sản Phẩm</label>
                                            <input type="text" name="productName" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Mô Tả</label>
                                            <textarea name="description" class="form-control"></textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Giá</label>
                                            <input type="number" name="price" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="stockQuantity">Số Lượng Tồn Kho</label>
                                            <input type="number" name="stockQuantity" class="form-control" required>
                                        </div>
                                        <div class="form-group">
                                            <label for="categoryId">Danh Mục</label>
                                            <select name="categoryId" class="form-control" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->categoryId }}">
                                                        {{ $category->categoryName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="brandId">Thương Hiệu</label>
                                            <select name="brandId" class="form-control" required>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->brandId }}">{{ $brand->brandName }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="mainImage">Hình Ảnh Chính</label>
                                            <input type="file" name="mainImage" class="form-control" accept="image/*"
                                                required>
                                        </div>

                                        <div class="form-group">
                                            <label for="additionalImages">Hình Ảnh Bổ Sung</label>
                                            <input type="file" name="additionalImages[]" class="form-control" multiple
                                                accept="image/*">
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="submit">Thêm</button>
                                        <button class="btn btn-danger" type="button"
                                            onclick="window.location.href='{{ route('admin.products.products') }}'">Hủy</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endsection
