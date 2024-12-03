    <div class="sidebar" data-background-color="dark">
        <div class="sidebar-logo">
            <!-- Logo Header -->
            <div class="logo-header" data-background-color="dark">
                <a href="index.html" class="logo">
                    <img src="{{ asset('admin/DashboardAuth/assets/img/kaiadmin/logo_light.svg') }}" alt="navbar brand"
                        class="navbar-brand" height="20" />
                </a>
                <div class="nav-toggle">
                    <button class="btn btn-toggle toggle-sidebar">
                        <i class="gg-menu-right"></i>
                    </button>
                    <button class="btn btn-toggle sidenav-toggler">
                        <i class="gg-menu-left"></i>
                    </button>
                </div>
                <button class="topbar-toggler more">
                    <i class="gg-more-vertical-alt"></i>
                </button>
            </div>
            <!-- End Logo Header -->
        </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    <li class="nav-item active">
                        <a class="collapsed">
                            <i class="fas fa-home"></i>
                            <p>Dashboard</p>
                        </a>

                    </li>
                    <li class="nav-section">
                        <span class="sidebar-mini-icon">
                            <i class="fa fa-ellipsis-h"></i>
                        </span>
                        <h4 class="text-section">Quản Lý</h4>
                    </li>
                    @if (Auth::guard('admin')->user()->roleId == 1 || Auth::guard('admin')->user()->roleId == 2)
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#tables">
                                <i class="fas fa-user"></i>
                                <p>Tài Khoản</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="tables">
                                <ul class="nav nav-collapse">
                                    @if (Auth::guard('admin')->user()->roleId == 1)
                                        <li>
                                            <a href="{{ route('admin.account.role') }}">
                                                <span class="sub-item">Quyền Quản Lý</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.account.admin') }}">
                                                <span class="sub-item">Admin</span>
                                            </a>
                                        </li>
                                    @endif
                                    @if (Auth::guard('admin')->user()->roleId == 1 || Auth::guard('admin')->user()->roleId == 2)
                                        <li>
                                            <a href="{{ route('admin.account.employee') }}">
                                                <span class="sub-item">Nhân viên</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('admin.account.shipper') }}">
                                                <span class="sub-item">Shipper</span>
                                            </a>
                                        </li>
                                    @endif

                                </ul>
                            </div>
                        </li>
                    @endif
                    @if (Auth::guard('admin')->user()->roleId == 1 || Auth::guard('admin')->user()->roleId == 2)
                        <li class="nav-item">
                            <a data-bs-toggle="collapse" href="#base">
                                <i class="fas fa-folder"></i>
                                <p>Sản Phẩm</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse" id="base">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('admin.products.category') }}">
                                            <span class="sub-item">Danh Mục Sản Phẩm</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.products.brand') }}">
                                            <span class="sub-item">Thương Hiệu</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.products.products') }}">
                                            <span class="sub-item">Sản Phẩm</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li class="nav-item">
                        <a data-bs-toggle="collapse" href="#order">
                            <i class="fas fa-folder"></i>
                            <p>Đơn Hàng</p>
                            <span class="caret"></span>
                        </a>
                        <div class="collapse" id="order">
                            <ul class="nav nav-collapse">
                                @if (Auth::guard('admin')->user()->roleId == 1 || Auth::guard('admin')->user()->roleId == 2)
                                    <li>
                                        <a href="{{ route('admin.order.list-order') }}">
                                            <span class="sub-item">Đơn Hàng</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('admin.order.confi-order') }}">
                                            <span class="sub-item">Chờ Xác Nhận</span>
                                        </a>
                                    </li>
                                @endif
                                <li>
                                    <a href="{{ route('admin.order.process-order') }}">
                                        <span class="sub-item">Đang Xử Lý</span>
                                    </a>
                                </li>
                                @if (Auth::guard('admin')->user()->roleId == 1 || Auth::guard('admin')->user()->roleId == 2)
                                    <li>
                                        <a href="{{ route('admin.order.admin-delivery-order') }}">
                                            <span class="sub-item">Đang Giao</span>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('admin.order.delivery-order') }}">
                                            <span class="sub-item">Đang Giao</span>
                                        </a>
                                    </li>
                                @endif
                                @if (Auth::guard('admin')->user()->roleId == 1 || Auth::guard('admin')->user()->roleId == 2)
                                    <li>
                                        <a href="{{ route('admin.order.admin-delivered-order') }}">
                                            <span class="sub-item">Đã Giao</span>
                                        </a>
                                    </li>
                                @else
                                    <li>
                                        <a href="{{ route('admin.order.delivered-order') }}">
                                            <span class="sub-item">Đã Giao</span>
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>
