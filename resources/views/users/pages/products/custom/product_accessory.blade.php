@extends('index')
@section('bodyclient')
    <!-- BREADCRUMB -->
    <div id="breadcrumb" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <ul class="breadcrumb-tree">
                        <li><a href="{{ route('client.home') }}">Trang Chủ</a></li>
                        <li class="active">Thiết Bị</li>
                    </ul>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /BREADCRUMB -->

    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- ASIDE -->
                <div id="aside" class="col-md-3">
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Thương Hiệu</h3>
                        <div class="checkbox-filter">
                            @foreach ($sidebarBrands as $sidebarBrand)
                                <div class="input-checkbox">
                                    <input type="checkbox" class="brand-checkbox" id="brand-{{ $sidebarBrand->brandId }}"
                                        value="{{ $sidebarBrand->brandId }}">
                                    <label for="brand-{{ $sidebarBrand->brandId }}">
                                        <span></span>
                                        {{ $sidebarBrand->brandName }}
                                        <small>(578)</small>
                                    </label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <!-- /aside Widget -->
                    <!-- aside Widget -->
                    <div class="aside">
                        <h3 class="aside-title">Giá</h3>
                        <div class="price-filter">
                            <div id="price-slider"></div>
                            <div class="input-number price-min">
                                <input id="price-min" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                            <span>-</span>
                            <div class="input-number price-max">
                                <input id="price-max" type="number">
                                <span class="qty-up">+</span>
                                <span class="qty-down">-</span>
                            </div>
                        </div>
                    </div>
                    <!-- /aside Widget -->


                </div>
                <!-- /ASIDE -->

                <!-- STORE -->
                <div id="store" class="col-md-9">
                    <!-- store top filter -->
                    <div class="store-filter clearfix">
                        <div class="store-sort">
                            <label>
                                Sắp Xếp:
                                <select class="input-select" id="sort-select">
                                    <option value="0">Giá Giảm Dần</option>
                                    <option value="1">Giá Tăng Dần</option>
                                </select>
                            </label>

                            <label>
                                Hiển Thị:
                                <select class="input-select" id="display-select">
                                    <option value="20">20</option>
                                    <option value="50">50</option>
                                </select>
                            </label>
                        </div>
                        <ul class="store-grid">
                            <li class="active"><i class="fa fa-th"></i></li>
                            <li><a href="#"><i class="fa fa-th-list"></i></a></li>
                        </ul>
                    </div>
                    <!-- /store top filter -->

                    <!-- store products -->
                    <div class="row" id="product-list">
                        @include('users.pages.products.components.productList', [
                            'products' => $products,
                        ])
                    </div>
                    <div class="store-filter clearfix">
                        <span class="store-qty">Showing 20-100 products</span>
                        <ul class="store-pagination">
                            <li class="active">1</li>
                            <li><a href="#">2</a></li>
                            <li><a href="#">3</a></li>
                            <li><a href="#">4</a></li>
                            <li><a href="#"><i class="fa fa-angle-right"></i></a></li>
                        </ul>
                    </div>

                </div>
                <!-- /STORE -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
@endsection
