@foreach ($products as $product)
    <div class="col-md-4 col-xs-6">
        <div class="product" data-href="{{ route('client.detail-product', $product->productId) }}" data-product-list-id="{{ $product->productId }}" data-category-id="{{$product->categoryId}}">
            <div class="product-img">
                <img src="{{ asset($product->images['mainImage']) }}" alt="" class="homeproduct" />
                <div class="product-label">
                    <span class="sale">-30%</span>
                    <span class="new">NEW</span>
                </div>
            </div>
            <div class="product-body">
                <p class="product-category">{{ $product->category->categoryName }}</p>
                <h3 class="product-name cart-product-name">{{ $product->productName }}</></h3>
                <h4 class="product-price cart-product-price">
                    {{ number_format($product->price, 0, ',', '.') }} đ <del class="product-old-price">$990.00</del>
                </h4>
            </div>
            <div class="add-to-cart">
                <button class="add-to-cart-btn add-to-cart-btn-product"><i class="fa fa-shopping-cart"></i> add to cart</button>
            </div>
        </div>
    </div>
@endforeach
