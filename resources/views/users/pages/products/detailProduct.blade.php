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
                        <li><a href="#">Home</a></li>
                        <li><a href="#">All Categories</a></li>
                        <li><a href="#">Accessories</a></li>
                        <li><a href="#">Headphones</a></li>
                        <li class="active">Product name goes here</li>
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
                <!-- Product main img -->
                <div class="col-md-5 col-md-push-2">
                    <div id="product-main-img">
                        <div class="product-preview">
                            <img src="{{ asset($products->images['mainImage']) }}" alt="Main Image">
                        </div>
                        @foreach ($products->images['additionalImages'] as $additionalImage)
                            <div class="product-preview">
                                <img src="{{ asset($additionalImage) }}" alt="Additional Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product main img -->

                <!-- Product thumb imgs -->
                <div class="col-md-2  col-md-pull-5">
                    <div id="product-imgs">
                        <div class="product-preview">
                            <img src="{{ asset($products->images['mainImage']) }}" alt="Main Image">
                        </div>
                        @foreach ($products->images['additionalImages'] as $additionalImage)
                            <div class="product-preview">
                                <img src="{{ asset($additionalImage) }}" alt="Additional Image">
                            </div>
                        @endforeach
                    </div>
                </div>
                <!-- /Product thumb imgs -->

                <!-- Product details -->
                <div class="col-md-5">
                    <div class="product-details" data-product-id="{{ $products->productId }}">
                        <h2 class="product-name" id="product-name">{{ $products->productName }}</h2>
                        <div>
                            <div class="product-rating">
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star"></i>
                                <i class="fa fa-star-o"></i>
                            </div>
                            <a class="review-link" href="#">10 Review(s) | Add your review</a>
                        </div>
                        <div>
                            <h3 class="product-price" id="product-price"> {{ $products->price }} đ<del
                                    class="product-old-price">$990.00</del></h3>
                            <span class="product-available">In Stock</span>
                        </div>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut
                            labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                            laboris nisi ut aliquip ex ea commodo consequat.</p>

                        <div class="product-options">
                            <label>
                                Size
                                <select class="input-select">
                                    <option value="0">X</option>
                                </select>
                            </label>
                            <label>
                                Màu
                                <select class="input-select">
                                    <option value="0">Red</option>
                                </select>
                            </label>
                        </div>

                        <div class="add-to-cart">
                            <div class="qty-label">
                                Số Lượng
                                <div class="input-number">
                                    <input type="number" value="1" min="1" id="product-qty">
                                    <span class="qty-up">+</span>
                                    <span class="qty-down">-</span>
                                </div>
                            </div>
                            <button class="add-to-cart-btn" id="add-to-cart-btn"><i class="fa fa-shopping-cart"></i> Thêm
                                giỏ hàng</button>
                        </div>
                    </div>
                </div>
                <!-- /Product details -->


                <!-- Product tab -->
                <div class="col-md-12">
                    <div id="product-tab">
                        <!-- product tab nav -->
                        <ul class="tab-nav">
                            <li class="active"><a data-toggle="tab" href="#tab1">Mô Tả Sản Phẩm</a></li>
                            <li><a data-toggle="tab" href="#tab2">Thông Số</a></li>
                            <li><a data-toggle="tab" href="#tab3">Phản Hồi (3)</a></li>
                        </ul>
                        <!-- /product tab nav -->

                        <!-- product tab content -->
                        <div class="tab-content">
                            <!-- tab1  -->
                            @include(
                                'users.pages.products.components.detailProductComponents.productComponentDescription',
                                ['products' => $products]
                            )
                            <!-- /tab1  -->

                            <!-- tab2  -->
                            @include('users.pages.products.components.detailProductComponents.productComponentDetail')
                            <!-- /tab2  -->

                            <!-- tab3  -->
                            @include('users.pages.products.components.detailProductComponents.productComponentReview')
                            <!-- /tab3  -->
                        </div>
                        <!-- /product tab content  -->
                    </div>
                </div>
                <!-- /product tab -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- Section -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="section-title text-center">
                        <h3 class="title">Sản Phẩm Liên Quan</h3>
                    </div>
                </div>
                @foreach ($recommendedProducts as $recommendedProduct)
                    <!-- product -->
                    <div class="col-md-3 col-xs-6">
                        <div class="product"
                            data-href="{{ route('client.detail-product', $recommendedProduct->productId) }}"
                            data-product-list-id="{{ $recommendedProduct->productId }}"
                            data-category-id="{{ $recommendedProduct->categoryId }}">
                            <div class="product-img">
                                <img src="{{ asset($recommendedProduct->images['mainImage']) }}" alt=""
                                    class="homeproduct" />
                                <div class="product-label">
                                    <span class="sale">-30%</span>
                                    <span class="new">NEW</span>
                                </div>
                            </div>
                            <div class="product-body">
                                <p class="product-category">{{ $recommendedProduct->category1->categoryName ?? 'null' }}</p>
                                <h3 class="product-name cart-product-name">{{ $recommendedProduct->productName }}</>
                                </h3>
                                <h4 class="product-price cart-product-price">{{ $recommendedProduct->price }} đ <del
                                        class="product-old-price">{{ $recommendedProduct->price }} đ</del></h4>
                            </div>
                            <div class="add-to-cart">
                                <button class="add-to-cart-btn add-to-cart-btn-product"><i class="fa fa-shopping-cart"></i>
                                    add to cart</button>
                            </div>
                        </div>
                    </div>
                    <!-- /product -->
                @endforeach
                <div class="clearfix visible-sm visible-xs"></div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Section -->
    <script src="{{ asset('client/js/cartFunction.js') }}"></script>
    <script src="{{ asset('client/js/products/detailProduct.js') }}"></script>
@endsection
