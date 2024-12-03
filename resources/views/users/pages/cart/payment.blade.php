@extends('index')
@section('bodyclient')
    <!-- BREADCRUMB -->
		<div id="breadcrumb" class="section">
			<!-- container -->
			<div class="container">
				<!-- row -->
				<div class="row">
					<div class="col-md-12">
						<h3 class="breadcrumb-header">Thanh Toán</h3>
						<ul class="breadcrumb-tree">
							<li><a href="#">Trang Chủ</a></li>
							<li class="active">Thanh Toán</li>
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

					<div class="col-md-7">
						<!-- Billing Details -->
						<div class="billing-details">
							<div class="section-title">
								<h3 class="title">Thông Tin Đặt Hàng</h3>
							</div>
							<div class="form-group">
								<input class="input" type="text" name="payment-name" placeholder="Họ Tên">
							</div>
							<div class="form-group">
								<input class="input" type="email" name="payment-email" placeholder="Email">
							</div>
							<div class="form-group">
								<input class="input" type="text" name="payment-address" placeholder="Địa Chỉ">
							</div>
							<div class="form-group">
								<input class="input" type="tel" name="payment-tel" placeholder="Số điện thoại">
							</div>
						</div>
						<!-- /Billing Details -->

						<!-- Shiping Details -->
						<div class="shiping-details">
							<div class="section-title">
								<h3 class="title">Ghi Chú Đơn Hàng</h3>
							</div>
						</div>
						<!-- /Shiping Details -->

						<!-- Order notes -->
						<div class="order-notes">
							<textarea class="input" name="payment-note" placeholder="Ghi chú cho đơn hàng"></textarea>
						</div>
						<!-- /Order notes -->
					</div>

					<!-- Order Details -->
					<div class="col-md-5 order-details">
						<div class="section-title text-center">
							<h3 class="title">Sản Phẩm Đặt Hàng</h3>
						</div>
						<div class="order-summary">
							<div class="order-col">
								<div><strong>Sản Phẩm</strong></div>
								<div><strong>Tổng</strong></div>
							</div>
							<div class="order-products">
							</div>
							<div class="order-col">
								<div>Giao Hàng</div>
								<div><strong>Miễn Phí</strong></div>
							</div>
							<div class="order-col">
								<div><strong>Tổng</strong></div>
								<div><strong class="order-total">$2940.00</strong></div>
							</div>
						</div>
						<div class="payment-method">
							<div class="input-radio">
								<input type="radio" name="payment" id="payment-1">
								<label for="payment-1">
									<span></span>
									Thanh toán khi nhận hàng
								</label>
							</div>
						</div>
						<div class="input-checkbox">
							<input type="checkbox" id="terms">
							<label for="terms">
								<span></span>
								Tôi đồng ý với các <a href="#">thông tin và điều khoản</a>
							</label>
						</div>
						<a href="#" class="primary-btn order-submit">Đặt Hàng</a>
					</div>
					<!-- /Order Details -->
				</div>
				<!-- /row -->
			</div>
			<!-- /container -->
		</div>
		<!-- /SECTION -->
        <script src="{{asset('client/js/cart/paymentUser.js')}}"></script>
@endsection
