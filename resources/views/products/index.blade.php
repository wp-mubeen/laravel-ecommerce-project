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
                    <figure><img src="assets/images/shop-banner.jpg" alt=""></figure>
                </div>

                <div class="wrap-shop-control">

                    <h1 class="shop-title">All Products</h1>

                    <div class="wrap-right">

                        <div class="sort-item orderby ">
                            <select name="orderby" class="use-chosen" >
                                <option value="menu_order" selected="selected">Default sorting</option>
                                <option value="popularity">Sort by popularity</option>
                                <option value="rating">Sort by average rating</option>
                                <option value="date">Sort by newness</option>
                                <option value="price">Sort by price: low to high</option>
                                <option value="price-desc">Sort by price: high to low</option>
                            </select>
                        </div>

                        <div class="sort-item product-per-page">
                            <select name="post-per-page" class="use-chosen" >
                                <option value="12" selected="selected">12 per page</option>
                                <option value="16">16 per page</option>
                                <option value="18">18 per page</option>
                                <option value="21">21 per page</option>
                                <option value="24">24 per page</option>
                                <option value="30">30 per page</option>
                                <option value="32">32 per page</option>
                            </select>
                        </div>
                        <!--
                        <div class="change-display-mode">
                            <a href="#" class="grid-mode display-mode active"><i class="fa fa-th"></i>Grid</a>
                            <a href="list.html" class="list-mode display-mode"><i class="fa fa-th-list"></i>List</a>
                        </div>-->

                    </div>

                </div><!--end wrap shop control-->

                <div class="row">

                    <ul class="product-list grid-products equal-container">
                        @foreach($products as $product)
                            <li class="col-lg-4 col-md-6 col-sm-6 col-xs-6 ">
                                <div class="product product-style-3 equal-elem ">
                                    <div class="product-thumnail">
                                        <a href="{{ url('product/'. $product->slug ) }}" title="T-Shirt Raw Hem Organic Boro Constrast Denim">
                                            <figure><img src="{{ $product->image }}" alt="T-Shirt Raw Hem Organic Boro Constrast Denim"></figure>
                                        </a>
                                    </div>
                                    <div class="product-info">
                                        <a href="{{ url('product/'. $product->slug ) }}" class="product-name"><span>{{ $product->name }}</span></a>
                                        <div class="wrap-price"><span class="product-price">${{ $product->price }}</span></div>
                                        <a href="{{ url('add-to-cart/'. $product->id ) }}" class="btn add-to-cart">Add To Cart</a>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                        {{ $products->links() }}



                    </ul>

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
                                <a href="#" class="cate-link">{{ $category->name }}</a>
                                <x-product.sub-categories :subcategory="$category" />

                            </li>
                            @endforeach
                        </ul>
                        @endif
                    </div>
                </div><!-- Categories widget-->


                <div class="widget mercado-widget widget-product">
                    <x-product.popular-products popular="1" />
                </div><!-- brand widget-->

            </div><!--end sitebar-->

        </div><!--end row-->
@endsection
