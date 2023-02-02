@if (count($related) >= 1)
<h3 class="title-box">Related Products</h3>
<div class="wrap-products">
    <div class="products slide-carousel owl-carousel style-nav-1 equal-container" data-items="5" data-loop="false" data-nav="true" data-dots="false" data-responsive='{"0":{"items":"1"},"480":{"items":"2"},"768":{"items":"3"},"992":{"items":"3"},"1200":{"items":"5"}}' >
        @foreach($related as $product)

        <div class="product product-style-2 equal-elem ">
            <div class="product-thumnail">
                <a href="{{ url( 'product/'. $product['slug'] ) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                    <figure><img src="{{ $product['image'] }}" width="214" height="214" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                </a>
                <div class="group-flash">
                    <span class="flash-item new-label">new</span>
                </div>
                <div class="wrap-btn">
                    <a href="{{ url('/product/'.$product['slug'] ) }}" class="function-link">quick view</a>
                </div>
            </div>
            <div class="product-info">
                <a href="#" class="product-name"><span>{{ $product['name'] }}</span></a>
                <div class="wrap-price"><span class="product-price">${{ $product['price'] }}</span></div>
            </div>
        </div>
        @endforeach
    </div>
</div><!--End wrap-products-->
@endif
