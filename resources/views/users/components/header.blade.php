<header>
    <!-- TOP HEADER -->
    <div id="top-header">
        <div class="container">
            <ul class="header-links pull-left">
                <li>
                    <a href="#"><i class="fa fa-phone"></i> +84-0935-135-132</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-envelope-o"></i> email@email.com</a>
                </li>
                <li>
                    <a href="#"><i class="fa fa-map-marker"></i> Thôn 1 Đức Tân, Mộ Đức, QN</a>
                </li>
            </ul>
            <ul class="header-links pull-right">
                <li>
                    @if (Auth::guard('user')->check())
                        <a href="{{route('client.profile-info')}}"><i class="fa fa-user-o"></i> {{ Auth::guard('user')->user()->userName }}</a>
                        <form id="logout-form" action="{{ route('client.authen-logout') }}" method="POST"
                            style="display: none;">
                            @csrf
                        </form>
                        <a href="{{ route('client.authen-logout') }}"
                            onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            <i class="fa fa-user-o"></i> Đăng Xuất
                        </a>
                    @else
                        <a href="{{ route('client.authen-login') }}"><i class="fa fa-user-o"></i> Tài khoản</a>
                    @endif
                </li>
            </ul>
        </div>
    </div>
    <!-- /TOP HEADER -->

    <!-- MAIN HEADER -->
    <div id="header">
        <!-- container -->
        <div class="container">
            <!-- row -->
            <div class="row">
                <!-- LOGO -->
                <div class="col-md-3">
                    <div class="header-logo">
                        <a href="{{route('client.home')}}" class="logo">
                            <img src="{{ asset('client/img/logo1.png') }}" style="width: 85px;height:80px" alt="" />
                        </a>
                    </div>
                </div>
                <!-- /LOGO -->

                <!-- SEARCH BAR -->
                <div class="col-md-6">
                    <div class="header-search">
                        <form action="{{route('client.search')}}" method="GET">
                            <input class="input" name=seach_query placeholder="Tìm kiếm" />
                            <button class="search-btn" type="submit">Tìm kiếm</button>
                        </form>
                    </div>
                </div>
                <!-- /SEARCH BAR -->

                <!-- ACCOUNT -->
                <div class="col-md-3 clearfix">
                    <div class="header-ctn">
                        <!-- Wishlist -->
                        <div>
                            <a href="#">
                                <i class="fa fa-heart-o"></i>
                                <span>Yêu thích</span>
                                <div class="qty">2</div>
                            </a>
                        </div>
                        <!-- /Wishlist -->
                        <!-- Cart -->
                        <div class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" aria-expanded="true">
                                <i class="fa fa-shopping-cart"></i>
                                <span>Giỏ hàng</span>
                                <div class="qty cart-qty">0</div>
                            </a>
                            <div class="cart-dropdown">
                                <div class="cart-list">
                                    <!-- Mẫu sản phẩm trong giỏ hàng -->
                                    <template id="cart-item-template">
                                        <div class="product-widget">
                                            <div class="product-img">
                                                <img src="" alt="" class="cart-item-img" />
                                            </div>
                                            <div class="product-body">
                                                <h3 class="product-name">
                                                    <a href="#">product name goes here</a>
                                                </h3>
                                                <h4 class="product-price" id="cart-item-price">
                                                    <span class="qty" id="cart-item-qty">1x</span>
                                                    <span class="price">price goes here</span>
                                                </h4>
                                            </div>
                                            <button class="delete">
                                                <i class="fa fa-close"></i>
                                            </button>
                                        </div>
                                    </template>
                                    <!-- /Mẫu sản phẩm trong giỏ hàng -->
                                </div>
                                <div class="cart-summary">
                                    <small>Tổng tiền 0 sản phẩm</small>
                                    <h5>Tổng: đ</h5>
                                </div>
                                <div class="cart-btns">
                                    <a href="{{ route('client.cart') }}">Giỏ Hàng</a>
                                    <a href="#">Thanh Toán <i class="fa fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- /Cart -->
                        <!-- Menu Toogle -->
                        <div class="menu-toggle">
                            <a href="#">
                                <i class="fa fa-bars"></i>
                                <span>Menu</span>
                            </a>
                        </div>
                        <!-- /Menu Toogle -->
                    </div>
                </div>
                <!-- /ACCOUNT -->
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </div>
    <!-- /MAIN HEADER -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="{{ asset('client/js/cartFunction.js') }}"></script>
    <script src="{{ asset('client/js/products/dropdownCart-Product.js') }}"></script>
</header>
