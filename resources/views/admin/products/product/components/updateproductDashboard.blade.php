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
                        <a href="#">Sửa Sản Phẩm</a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <div class="card-title">Sửa Sản Phẩm</div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <form method="POST" action="{{ route('admin.products.products.postupdateproduct',$products->productId) }}"
                                    enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-6 col-lg-12">
                                        <div class="form-group">
                                            <label for="productName">Tên Sản Phẩm</label>
                                            <input type="text" name="productName" class="form-control"
                                                value="{{ old('productName', $products->productName) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="description">Mô Tả</label>
                                            <textarea name="description" class="form-control">{{ old('description', $products->description) }}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="price">Giá</label>
                                            <input type="number" name="price" class="form-control"
                                                value="{{ old('price', $products->price) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="stockQuantity">Số Lượng Tồn Kho</label>
                                            <input type="number" name="stockQuantity" class="form-control"
                                                value="{{ old('stockQuantity', $products->stockQuantity) }}">
                                        </div>
                                        <div class="form-group">
                                            <label for="categoryId">Danh Mục</label>
                                            <select name="categoryId" class="form-control" required>
                                                @foreach ($categories as $category)
                                                    <option value="{{ $category->categoryId }}"
                                                        {{ $products->categoryId  == $category->categoryId ? 'selected' : '' }}>
                                                        {{ $category->categoryName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="brandId">Thương Hiệu</label>
                                            <select name="brandId" class="form-control" required>
                                                @foreach ($brands as $brand)
                                                    <option value="{{ $brand->brandId }}"
                                                        {{ $products->brandId  == $brand->brandId ? 'selected' : '' }}>
                                                        {{ $brand->brandName }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <!-- Hiển thị ảnh chính hiện tại -->
                                        <div class="form-group">
                                            <label>Ảnh Chính Hiện Tại</label><br>
                                            <img src="{{ asset( $products->images['mainImage']) }}"
                                                alt="Main Image" width="150">
                                        </div>
                                        <!-- Chọn ảnh mới nếu cần -->
                                        <div class="form-group">
                                            <label for="mainImage">Thay Đổi Ảnh Chính</label>
                                            <input type="file" name="mainImage" class="form-control" accept="image/*">
                                        </div>

                                        <!-- Hiển thị ảnh bổ sung hiện tại -->
                                        <div class="form-group">
                                            <label>Ảnh Bổ Sung Hiện Tại</label><br>
                                            @foreach ($products->images['additionalImages'] as $additionalImage)
                                                <img src="{{ asset( $additionalImage) }}"
                                                    alt="Additional Image" width="100" style="margin-right: 5px;">
                                            @endforeach
                                        </div>
                                        <!-- Chọn ảnh bổ sung mới nếu cần -->
                                        <div class="form-group">
                                            <label for="additionalImages">Thêm Ảnh Bổ Sung Mới</label>
                                            <input type="file" name="additionalImages[]" class="form-control" multiple
                                                accept="image/*">
                                        </div>
                                    </div>
                                    <div class="card-action">
                                        <button class="btn btn-success" type="submit">Lưu</button>
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
