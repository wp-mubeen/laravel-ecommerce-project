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
                <li class="item-link"><a href="{{ url('/home') }}" class="link">home</a></li>
                <li class="item-link"><span>Wishlist</span></li>
            </ul>
        </div>
        <div class="row">
            <div class="col-md-12 wrap-iten-in-cart">
                <h3>Wishlist</h3>
                @if( $wishlist->count() > 0 )
                    <ul class="products-cart wishlist_item">
                    @foreach($wishlist as $item)
                        @php
                           $ptitle = str_replace(' ', '-', $item->products['name']);
                           $p_slug = strtolower($ptitle);

                        @endphp


                        <li class="pr-cart-item">
                            <div class="product-image">
                                @if($item->products->photo)
                                    <img src="{{  $item->products->photo }}" alt="">
                                @else
                                    <img src="{{  asset('assets/images/no-image.png') }}" alt="">
                                @endif
                            </div>
                            <div class="product-name">
                                <a class="link-to-product" href="{{ url( '/product/'.$p_slug ) }}">{{ $item->products->name }}</a>
                            </div>
                            <div class="price-field product-price"><p class="price">${{ $item->products->price }}</p></div>
                            <div class="add-product" ><a href="{{ url('add-to-cart/'. $item->products->id ) }}" class="btn btn-danger">Add to Cart</a></div>
                            <div class="delete">
                                <a href="javascript:void(0)" data-id="{{ $item->products->id }}" class="btn btn-delete remove-from-wishlist" title="">
                                    <span>Delete from your wishlist</span>
                                    <i class="fa fa-times-circle" aria-hidden="true"></i>
                                </a>
                            </div>
                        </li>


                    @endforeach

                    </ul>
                @else
                    <h4>There are no products in your wishlist</h4>
                @endif
            </div><!--end main products area-->
        </div><!--end row-->

    </div><!--end container-->
    <script src="{{ asset('assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4')}}"></script>
    <script>
        jQuery( document ).ready(function() {
            jQuery(".remove-from-wishlist").click(function (e) {
                e.preventDefault();
                var ele = jQuery(this);

                if(confirm("Are you sure")) {
                    jQuery.ajax({
                        url: '{{ url('remove-from-wishlist') }}',
                        method: "post",
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
