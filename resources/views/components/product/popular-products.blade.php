@if (count($popular) >= 1)
<h2 class="widget-title">Popular Products</h2>
<div class="widget-content">
    <ul class="products">
        @foreach($popular as $product)
        <li class="product-item">
            <div class="product product-widget-style">
                <div class="thumbnnail">
                    <a href="{{ url('/product/'.$product['slug'] ) }}" title="{{ $product['name'] }}">
                        <figure><img src="{{ $product['image'] }}" alt=""></figure>
                    </a>
                </div>
                <div class="product-info">
                    <a href="{{ url('/product/'.$product['slug'] ) }}" class="product-name"><span>{{ $product['name'] }}</span></a>
                    <div class="wrap-price"><span class="product-price">${{ $product['price'] }}</span></div>
                </div>
            </div>
        </li>
        @endforeach

    </ul>
</div>
@endif
