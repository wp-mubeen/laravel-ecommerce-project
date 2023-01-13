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
                <li class="item-link"><span>{{ $product->name }}</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">
                <div class="wrap-product-detail">
                    <div class="detail-media">
                        <div class="product-gallery">
                            <ul class="slides">

                                <li data-thumb="assets/images/products/digital_18.jpg">
                                    <img src="{{ $product->image }}" alt="product thumbnail" />
                                </li>

                                <li data-thumb="assets/images/products/digital_17.jpg">
                                    <img src="{{ $product->image }}" alt="product thumbnail" />
                                </li>



                            </ul>
                        </div>
                    </div>
                    <div class="detail-info">
                        <div class="product-rating">
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <i class="fa fa-star" aria-hidden="true"></i>
                            <a href="#" class="count-review">(05 review)</a>
                        </div>
                        <h2 class="product-name">{{ $product->name }}</h2>
                        <div class="short-desc">
                            {{ $product->small_description }}
                        </div>
                        <div class="wrap-social">
                            <a class="link-socail" href="#"><img src="assets/images/social-list.png" alt=""></a>
                        </div>
                        <div class="wrap-price"><span class="product-price">${{ $product->price }}</span></div>
                        <div class="stock-info in-stock">
                            <p class="availability">Availability: <b>In Stock</b></p>
                        </div>
                        <div class="quantity">
                            <span>Quantity:</span>
                            <div class="quantity-input">
                                <input type="text" name="product-quatity" value="1" data-max="120" pattern="[0-9]*" >

                                <a class="btn btn-reduce" href="#"></a>
                                <a class="btn btn-increase" href="#"></a>
                            </div>
                        </div>
                        <div class="wrap-butons">
                            <a href="{{ url('add-to-cart/'. $product->id ) }}" class="btn add-to-cart">Add to Cart</a>
                            <div class="wrap-btn">
                                <a href="#" class="btn btn-compare">Add Compare</a>
                                <a href="#" class="btn btn-wishlist">Add Wishlist</a>
                            </div>
                        </div>
                    </div>
                    <div class="advance-info">
                        <div class="tab-control normal">
                            <a href="#description" class="tab-control-item active">description</a>
                            <a href="#add_infomation" class="tab-control-item">Addtional Infomation</a>
                            <a href="#review" class="tab-control-item">Reviews</a>
                        </div>
                        <div class="tab-contents">
                            <div class="tab-content-item active" id="description">
                                {{ $product->description }}
                            </div>
                            <div class="tab-content-item " id="add_infomation">
                                {{ $product->small_description }}
                            </div>
                            <div class="tab-content-item " id="review">

                                <div class="wrap-review-form">
                                    <h2 class="woocommerce-Reviews-title">{{ $TotalComment }} Review for <span>{{ $product->name }}</span></h2>
                                    <div id="comments">
                                        <x-product.comments  product="{{ $product->id }}"  />
                                    </div><!-- #comments -->

                                    <div id="review_form_wrapper">
                                        <div id="review_form">
                                            <div id="respond" class="comment-respond">

                                                <x-product.comment-form slug="{{ $product->slug }}" productid="{{ $product->id }}" />
                                            </div><!-- .comment-respond-->
                                        </div><!-- #review_form -->
                                    </div><!-- #review_form_wrapper -->

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget widget-product">
                <x-product.popular-products popular="{{ $product->cate_id }}" />
                </div>
            </div><!--end sitebar-->

            <div class="single-advance-box col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="wrap-show-advance-info-box style-1 box-in-site">
                    <x-product.related related="{{ $product->cate_id }}" />
                </div>
            </div> <!-- end related wrr -->

        </div><!--end row-->

    </div><!--end container-->
@endsection
