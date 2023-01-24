@extends('layouts.app')

@section('content')
<div class="container">
    <div class="col-md-12">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
        @endif
    </div>
    <!--main area-->
    <main id="main" class="main-site">
        <div class="container">
            <div class="wrap-breadcrumb">
                <ul>
                    <li class="item-link"><a href="{{ url('home') }}" class="link">home</a></li>
                    <li class="item-link"><span>Thank You</span></li>
                </ul>
            </div>
        </div>
        <div class="container pb-60">
            <div class="row">
                <div class="col-md-12 text-center">
                    <h2>Thank you for your order</h2>
                    <p>A confirmation email was sent.</p>
                    <a href="{{ url('products') }}" class="btn btn-submit btn-submitx">Continue Shopping</a>
                </div>
            </div>
        </div><!--end container-->
    </main>
    <!--main area-->

</div><!--end container-->


<script src="assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/functions.js"></script>


@endsection
