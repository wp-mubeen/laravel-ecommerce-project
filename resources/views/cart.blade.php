@extends('layouts.app')

@section('content')
    <div class="container">
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
        <div class="wrap-breadcrumb">
            <ul>
                <li class="item-link"><a href="{{ url('home') }}" class="link">home</a></li>
                <li class="item-link"><span>Cart</span></li>
            </ul>
        </div>
        <div class=" main-content-area">

            <div class="wrap-iten-in-cart">
                <h3 class="box-title">Products Name</h3>
                <ul class="products-cart">
                    <?php $total = 0 ?>
                    @if(session('cart'))
                        @foreach(session('cart') as $id => $details)
                            @php
                             $total += $details['price'] * $details['quantity'];
                            $ptitle = str_replace(' ', '-', $details['name']);
                            $p_slug = strtolower($ptitle);
                            @endphp
                            <li class="pr-cart-item">
                                <div class="product-image">
                                    <figure><img src="{{  $details['photo'] }}" alt=""></figure>
                                </div>
                                <div class="product-name">
                                    <a class="link-to-product" href="{{ url( '/product/'.$p_slug ) }}">{{ $details['name'] }}</a>
                                </div>
                                <div class="price-field produtc-price"><p class="price">${{ $details['price'] }}</p></div>
                                <div class="quantity">
                                    <div class="quantity-input">
                                        <input type="text" class="product_qty"  name="product-quatity" value="{{ $details['quantity'] }}" data-max="120" pattern="[0-9]*">
                                        <a class="btn btn-increase" href="#"></a>
                                        <a class="btn btn-reduce" href="#"></a>
                                    </div>
                                </div>
                                <div class="price-field sub-total"><p class="price">${{ $details['price'] * $details['quantity'] }}</p></div>
                                <div class="actions" >
                                    <button class="btn btn-info btn-sm update-cart"  data-id="{{ $id }}"><i class="fa fa-refresh"></i></button>
                                </div>
                                <div class="delete">
                                    <a href="javascript:void(0)" data-id="{{ $id }}" class="btn btn-delete remove-from-cart" title="">
                                        <span>Delete from your cart</span>
                                        <i class="fa fa-times-circle" aria-hidden="true"></i>
                                    </a>
                                </div>
                            </li>


                    @endforeach
                @else
                   <h3>No record found!</h3>
               @endif
            </ul>
        </div>

        <div class="summary">
            <div class="order-summary">
                <h4 class="title-box">Order Summary</h4>

                <p class="summary-info"><span class="title">Subtotal</span><b class="index">${{ $total }}</b></p>
                <p class="summary-info"><span class="title">Shipping</span><b class="index">Free Shipping</b></p>
                <p class="summary-info total-info "><span class="title">Total</span><b class="index">${{ $total }}</b></p>
            </div>
            <div class="checkout-info">
                <a class="btn btn-checkout" href="{{ url('/checkout') }}">Check out</a>
                <a class="link-to-shop" href="{{ url('/products') }}">Continue Shopping<i class="fa fa-arrow-circle-right" aria-hidden="true"></i></a>
            </div>
        </div>


    </div><!--end main content area-->
</div><!--end container-->


<script src="assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/functions.js"></script>

<script type="text/javascript">
    $( document ).ready(function() {
        $(".update-cart").click(function (e) {
           e.preventDefault();

            var ele = $(this);

            var qty = ele.parents("li").find(".product_qty").val();


            $.ajax({
                url: '{{ url('/update-cart') }}',
                method: "patch",
                data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id"), quantity: qty },

                success: function (response) {
                    window.location.reload();
                }
            });
        });

        $(".remove-from-cart").click(function (e) {
            e.preventDefault();

            var ele = $(this);

            if(confirm("Are you sure")) {
                $.ajax({
                    url: '{{ url('remove-from-cart') }}',
                    method: "DELETE",
                    data: {_token: '{{ csrf_token() }}', id: ele.attr("data-id")},
                    success: function (response) {
                        window.location.reload();
                    }
                });
            }
        });
    });

</script>

@endsection
