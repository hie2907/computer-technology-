@extends('index')
@section('bodyclient')
    <!-- SECTION -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="{{ asset('client/img/shop01.png') }}" alt="" />
                        </div>
                        <div class="shop-body">
                            <h3>Laptop<br />Chính Hãng</h3>
                            <a href="{{route('client.category')}}" class="cta-btn">Truy cập ngay <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="{{ asset('client/img/shop02.png') }}" alt="" />
                        </div>
                        <div class="shop-body">
                            <h3>Cameras<br />Chất Lượng</h3>
                            <a href="{{route('client.category')}}" class="cta-btn">Truy cập ngay <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->

                <!-- shop -->
                <div class="col-md-4 col-xs-6">
                    <div class="shop">
                        <div class="shop-img">
                            <img src="{{ asset('client/img/shop03.png') }}" alt="" />
                        </div>
                        <div class="shop-body">
                            <h3>Phụ kiện<br />Đa dạng</h3>
                            <a href="{{route('client.category')}}" class="cta-btn">Truy cập ngay <i class="fa fa-arrow-circle-right"></i></a>
                        </div>
                    </div>
                </div>
                <!-- /shop -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /SECTION -->

    <!-- New Product -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Sản Phẩm Mới</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab1">Laptops</a>
                                </li>
                                <li><a data-toggle="tab" href="#tab2">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab3">Phụ kiện</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab1" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($laptops as $laptop)
                                        <!-- product -->
                                        <div class="product"
                                            data-href="{{ route('client.detail-product', $laptop->productId) }}"
                                            data-product-list-id="{{ $laptop->productId }}">
                                            <div class="product-img">
                                                <img src="{{ asset($laptop->images['mainImage']) }}" alt=""
                                                    class="homeproduct" />
                                                <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $laptop->brand->brandName }}</p>
                                                <h3 class="product-name cart-product-name">{{ $laptop->productName }}</>
                                                </h3>
                                                <h4 class="product-price cart-product-price">
                                                    {{ number_format($laptop->price, 0, ',', '.') }} đ <del
                                                        class="product-old-price">{{ $laptop->price }} đ</del></h4>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn add-to-cart-btn-product"><i
                                                        class="fa fa-shopping-cart"></i> Thêm Giỏ Hàng</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                            <!-- tab -->
                            <div id="tab2" class="tab-pane">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach ($cameras as $camera)
                                        <!-- product -->
                                        <div class="product"
                                            data-href="{{ route('client.detail-product', $camera->productId) }}"
                                            data-product-list-id="{{ $camera->productId }}">
                                            <div class="product-img">
                                                <img src="{{ asset($camera->images['mainImage']) }}" alt=""
                                                    class="homeproduct" />
                                                <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $camera->brand->brandName }}</p>
                                                <h3 class="product-name cart-product-name">{{ $camera->productName }}</>
                                                </h3>
                                                <h4 class="product-price cart-product-price">
                                                    {{ number_format($camera->price, 0, ',', '.') }} đ <del
                                                        class="product-old-price">{{ number_format($camera->price, 0, ',', '.') }}
                                                        đ</del></h4>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn add-to-cart-btn-product"><i
                                                        class="fa fa-shopping-cart"></i> Thêm Giỏ Hàng</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                            <!-- tab -->
                            <div id="tab3" class="tab-pane">
                                <div class="products-slick" data-nav="#slick-nav-3">
                                    @foreach ($accessories as $accessory)
                                        <!-- product -->
                                        <div class="product"
                                            data-href="{{ route('client.detail-product', $accessory->productId) }}"
                                            data-product-list-id="{{ $accessory->productId }}">
                                            <div class="product-img">
                                                <img src="{{ asset($accessory->images['mainImage']) }}" alt=""
                                                    class="homeproduct" />
                                                <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $accessory->brand->brandName }}</p>
                                                <h3 class="product-name cart-product-name">{{ $accessory->productName }}
                                                    </>
                                                </h3>
                                                <h4 class="product-price cart-product-price">
                                                    {{ number_format($accessory->price, 0, ',', '.') }} đ
                                                    <del class="product-old-price">{{ number_format($accessory->price, 0, ',', '.') }}
                                                        đ</del>
                                                </h4>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn add-to-cart-btn-product"><i
                                                        class="fa fa-shopping-cart"></i> Thêm Giỏ Hàng</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-3" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /New Product -->
    <!-- HOT DEAL Product -->
    <div id="hot-deal" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="hot-deal">
                        <ul class="hot-deal-countdown">
                            <li>
                                <div>
                                    <h3>02</h3>
                                    <span>Ngày</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>10</h3>
                                    <span>Giờ</span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>34</h3>
                                    <span>Phút
                                    </span>
                                </div>
                            </li>
                            <li>
                                <div>
                                    <h3>60</h3>
                                    <span>Giây</span>
                                </div>
                            </li>
                        </ul>
                        <h2 class="text-uppercase">Ưu đãi trong tuần</h2>
                        <p>Sản phẩm mới giảm 50%</p>
                        <a class="primary-btn cta-btn" href="#">Truy cập ngay</a>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /HOT DEAL Product -->

    <!-- Top Selling -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- section title -->
                <div class="col-md-12">
                    <div class="section-title">
                        <h3 class="title">Sản Phẩm Nổi Bật</h3>
                        <div class="section-nav">
                            <ul class="section-tab-nav tab-nav">
                                <li class="active">
                                    <a data-toggle="tab" href="#tab12">Laptops</a>
                                </li>
                                <li><a data-toggle="tab" href="#tab22">Cameras</a></li>
                                <li><a data-toggle="tab" href="#tab32">Phụ kiện</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- /section title -->

                <!-- Products tab & slick -->
                <div class="col-md-12">
                    <div class="row">
                        <div class="products-tabs">
                            <!-- tab -->
                            <div id="tab12" class="tab-pane active">
                                <div class="products-slick" data-nav="#slick-nav-1">
                                    @foreach ($laptops as $laptop)
                                        <!-- product -->
                                        <div class="product"
                                            data-href="{{ route('client.detail-product', $laptop->productId) }}"
                                            data-product-list-id="{{ $laptop->productId }}">
                                            <div class="product-img">
                                                <img src="{{ asset($laptop->images['mainImage']) }}" alt=""
                                                    class="homeproduct" />
                                                <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $laptop->brand->brandName }}</p>
                                                <h3 class="product-name cart-product-name">{{ $laptop->productName }}</>
                                                </h3>
                                                <h4 class="product-price cart-product-price">
                                                    {{ number_format($laptop->price, 0, ',', '.') }} đ <del
                                                        class="product-old-price">{{ number_format($laptop->price, 0, ',', '.') }}
                                                        đ</del></h4>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn add-to-cart-btn-product"><i
                                                        class="fa fa-shopping-cart"></i> Thêm Giỏ Hàng</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-1" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                            <!-- tab -->
                            <div id="tab22" class="tab-pane">
                                <div class="products-slick" data-nav="#slick-nav-2">
                                    @foreach ($cameras as $camera)
                                        <!-- product -->
                                        <div class="product"
                                            data-href="{{ route('client.detail-product', $camera->productId) }}"
                                            data-product-list-id="{{ $camera->productId }}">
                                            <div class="product-img">
                                                <img src="{{ asset($camera->images['mainImage']) }}" alt=""
                                                    class="homeproduct" />
                                                <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $camera->brand->brandName }}</p>
                                                <h3 class="product-name cart-product-name">{{ $camera->productName }}</>
                                                </h3>
                                                <h4 class="product-price cart-product-price">
                                                    {{ number_format($camera->price, 0, ',', '.') }} đ <del
                                                        class="product-old-price">
                                                        {{ number_format($camera->price, 0, ',', '.') }} đ</del></h4>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn add-to-cart-btn-product"><i
                                                        class="fa fa-shopping-cart"></i> Thêm Giỏ Hàng</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-2" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                            <!-- tab -->
                            <div id="tab32" class="tab-pane">
                                <div class="products-slick" data-nav="#slick-nav-3">
                                    @foreach ($accessories as $accessory)
                                        <!-- product -->
                                        <div class="product"
                                            data-href="{{ route('client.detail-product', $accessory->productId) }}"
                                            data-product-list-id="{{ $accessory->productId }}">
                                            <div class="product-img">
                                                <img src="{{ asset($accessory->images['mainImage']) }}" alt=""
                                                    class="homeproduct" />
                                                <div class="product-label">
                                                    <span class="sale">-30%</span>
                                                    <span class="new">NEW</span>
                                                </div>
                                            </div>
                                            <div class="product-body">
                                                <p class="product-category">{{ $accessory->brand->brandName }}</p>
                                                <h3 class="product-name cart-product-name">{{ $accessory->productName }}
                                                    </>
                                                </h3>
                                                <h4 class="product-price cart-product-price">
                                                    {{ number_format($accessory->price, 0, ',', '.') }} đ
                                                    <del class="product-old-price">{{ number_format($accessory->price, 0, ',', '.') }}
                                                        đ</del>
                                                </h4>
                                            </div>
                                            <div class="add-to-cart">
                                                <button class="add-to-cart-btn add-to-cart-btn-product"><i
                                                        class="fa fa-shopping-cart"></i> Thêm Giỏ Hàng</button>
                                            </div>
                                        </div>
                                        <!-- /product -->
                                    @endforeach
                                </div>
                                <div id="slick-nav-3" class="products-slick-nav"></div>
                            </div>
                            <!-- /tab -->
                        </div>
                    </div>
                </div>
                <!-- /Products tab & slick -->
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- Top Selling -->

    <!-- Top Selling -->
    <div class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Sản Phẩm Hot</h4>
                        <div class="section-nav">
                            <div id="slick-nav-3" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-3">
                        <div>
                            <!-- product widget -->
                            @foreach ($laptops as $laptop)
                                <div class="product-widget"
                                    data-href="{{ route('client.detail-product', $laptop->productId) }}"
                                    data-product-list-id="{{ $laptop->productId }}">
                                    <div class="product-img">
                                        <img src="{{ asset($laptop->images['mainImage']) }}" alt="" />
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $laptop->brand->brandName }}</p>
                                        <h3 class="product-name">
                                            {{ $laptop->productName }}
                                        </h3>
                                        <h4 class="product-price">
                                            {{ number_format($laptop->price, 0, ',', '.') }} đ <del
                                                class="product-old-price">$990.00</del>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            @foreach ($laptops as $laptop)
                                <div class="product-widget"
                                    data-href="{{ route('client.detail-product', $laptop->productId) }}"
                                    data-product-list-id="{{ $laptop->productId }}">
                                    <div class="product-img">
                                        <img src="{{ asset($laptop->images['mainImage']) }}" alt="" />
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $laptop->brand->brandName }}</p>
                                        <h3 class="product-name">
                                            {{ $laptop->productName }}
                                        </h3>
                                        <h4 class="product-price">
                                            {{ number_format($laptop->price, 0, ',', '.') }} đ <del
                                                class="product-old-price">$990.00</del>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /product widget -->
                        </div>
                    </div>
                </div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Sản Phẩm Hot</h4>
                        <div class="section-nav">
                            <div id="slick-nav-4" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-4">
                        <div>
                            <!-- product widget -->
                            @foreach ($cameras as $camera)
                                <div class="product-widget"
                                    data-href="{{ route('client.detail-product', $camera->productId) }}"
                                    data-product-list-id="{{ $camera->productId }}">
                                    <div class="product-img">
                                        <img src="{{ asset($camera->images['mainImage']) }}" alt="" />
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $camera->brand->brandName }}</p>
                                        <h3 class="product-name">
                                            {{ $camera->productName }}
                                        </h3>
                                        <h4 class="product-price">
                                            {{ number_format($camera->price, 0, ',', '.') }} đ <del
                                                class="product-old-price">$990.00</del>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            @foreach ($cameras as $camera)
                                <div class="product-widget"
                                    data-href="{{ route('client.detail-product', $camera->productId) }}"
                                    data-product-list-id="{{ $camera->productId }}">
                                    <div class="product-img">
                                        <img src="{{ asset($camera->images['mainImage']) }}" alt="" />
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $camera->brand->brandName }}</p>
                                        <h3 class="product-name">
                                            {{ $camera->productName }}
                                        </h3>
                                        <h4 class="product-price">
                                            {{ number_format($camera->price, 0, ',', '.') }} đ <del
                                                class="product-old-price">$990.00</del>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /product widget -->
                        </div>
                    </div>
                </div>

                <div class="clearfix visible-sm visible-xs"></div>

                <div class="col-md-4 col-xs-6">
                    <div class="section-title">
                        <h4 class="title">Sản Phẩm Hot</h4>
                        <div class="section-nav">
                            <div id="slick-nav-5" class="products-slick-nav"></div>
                        </div>
                    </div>

                    <div class="products-widget-slick" data-nav="#slick-nav-5">
                        <div>
                            <!-- product widget -->
                            @foreach ($accessories as $accessory)
                                <div class="product-widget"
                                    data-href="{{ route('client.detail-product', $accessory->productId) }}"
                                    data-product-list-id="{{ $accessory->productId }}">
                                    <div class="product-img">
                                        <img src="{{ asset($accessory->images['mainImage']) }}" alt="" />
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $accessory->brand->brandName }}</p>
                                        <h3 class="product-name">
                                            {{ $accessory->productName }}
                                        </h3>
                                        <h4 class="product-price">
                                            {{ number_format($accessory->price, 0, ',', '.') }} đ <del
                                                class="product-old-price">$990.00</del>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /product widget -->
                        </div>

                        <div>
                            <!-- product widget -->
                            @foreach ($accessories as $accessory)
                                <div class="product-widget"
                                    data-href="{{ route('client.detail-product', $accessory->productId) }}"
                                    data-product-list-id="{{ $accessory->productId }}">
                                    <div class="product-img">
                                        <img src="{{ asset($accessory->images['mainImage']) }}" alt="" />
                                    </div>
                                    <div class="product-body">
                                        <p class="product-category">{{ $accessory->brand->brandName }}</p>
                                        <h3 class="product-name">
                                            {{ $accessory->productName }}
                                        </h3>
                                        <h4 class="product-price">
                                            {{ number_format($accessory->price, 0, ',', '.') }} đ <del
                                                class="product-old-price">$990.00</del>
                                        </h4>
                                    </div>
                                </div>
                            @endforeach
                            <!-- /product widget -->
                        </div>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /Top Selling -->

    <!-- NEWSLETTER -->
    <div id="newsletter" class="section">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <div class="col-md-12">
                    <div class="newsletter">
                        <p>Đăng ký để nhận <strong>Thông Báo</strong></p>
                        <form>
                            <input class="input" type="email" placeholder="Nhập Email của bạn" />
                            <button class="newsletter-btn">
                                <i class="fa fa-envelope"></i> Đăng Ký
                            </button>
                        </form>
                        <ul class="newsletter-follow">
                            <li>
                                <a href="#"><i class="fa fa-facebook"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-twitter"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-instagram"></i></a>
                            </li>
                            <li>
                                <a href="#"><i class="fa fa-pinterest"></i></a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- /row -->
        </div>
        <!-- /container -->
    </div>
    <!-- /NEWSLETTER -->
    <script src="https://www.gstatic.com/dialogflow-console/fast/messenger/bootstrap.js?v=1"></script>
    <df-messenger
  intent="WELCOME"
  chat-title="computer_dl"
  agent-id="e46542ca-1941-47c4-8536-7220673af919"
  language-code="en"
></df-messenger>
@endsection
