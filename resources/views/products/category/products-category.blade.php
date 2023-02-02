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
                <li class="item-link"><span>Products</span></li>
            </ul>
        </div>
        <div class="row">

            <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12 main-content-area">

                <div class="banner-shop">
                    <figure><img src="{{ asset('assets/images/shop-banner.jpg') }}" alt=""></figure>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">All {{ $productcategory }}</h1>

                    <div class="wrap-right">
                        <form method="get" action="" id="submitform">

                        <div class="sort-item product-per-page">
                            <select name="per-page" id="select_count" class="use-chosen" >
                                <option value="12" >12 per page</option>
                                <option value="15">15 per page</option>
                                <option value="18">18 per page</option>
                                <option value="21">21 per page</option>
                                <option value="24">24 per page</option>
                                <option value="27">27 per page</option>
                                <option value="30">30 per page</option>
                            </select>
                        </div>
                        </form>
                        <!--
                        <div class="change-display-mode">
                            <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                            <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                        </div>-->

                    </div>

                </div><!--end wrap shop control-->

                <div class="row">
                    @if(count($products) >= 1)
                    <ul class="product-list grid-products equal-container">
                        @foreach($products as $product)

                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ url('product/'. $product->slug ) }}" title="{{ $product->name }}">
                                            <figure><img src="{{ $product->image }}" ></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ url('product/'. $product->slug ) }}" class="product-name"><span>{{ $product->name }}</span></a>
                                        <div class="wrap-price"><span class="product-price">${{ $product->price }}</span></div>
                                        @if($product->qty < 1)
                                            <button class="btn btn-danger">Out of Stock</button>
                                        @else
                                            <a href="{{ url('add-to-cart/'. $product->id ) }}" class="btn add-to-cart">Add To Cart</a>
                                        @endif
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        {{ $products->links() }}
                    </ul>
                    @else
                        <h3 class=""mt-4>No Product found!</h3>
                    @endif
                </div>


            </div><!--end main products area-->

            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12 sitebar">
                <div class="widget mercado-widget categories-widget">
                    <h2 class="widget-title">All Categories</h2>
                    <div class="widget-content">
                        @if (count($Categories) >= 1)
                        <ul class="list-category">
                            @foreach($Categories as $category)
                            <li class="category-item has-child-cate">
                                <a href="{{ url( 'products/category/'.$category->slug ) }}" class="cate-link">{{ $category->name }}</a>
                                <x-product.sub-categories :subcategory="$category" />

                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div><!-- Categories widget-->


                <div class="widget mercado-widget widget-product">
                    <x-product.popular-products popular="1" />
                </div>

            </div>

        </div><!--end row-->
            <script>
                jQuery(document).ready(function() {
                    jQuery('#select_count').on('change', function() {
                        jQuery( "#submitform" ).submit();

                    });
                });
            </script>

@endsection
