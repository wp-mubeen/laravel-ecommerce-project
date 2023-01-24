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
        @if($errors->has('stripeToken'))
            <div class="alert alert-success">
                <h3>Card detail is invalid or being declined</h3>
            </div>
        @endif
    </div>
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

        @if ( session('cart') )
            <div class="col-md-8">
                <div class="wrap-address-billing">
                    <h3 class="box-title">Billing Address</h3>
                    <form action="{{ url('place-order') }}" method="post" name="frm-billing"
                          data-cc-on-file="false"
                          data-stripe-publishable-key="{{ env('STRIPE_KEY') }}"
                          id="payment-form"   class="validation">
                        {!! csrf_field() !!}
                        <p class="row-in-form">
                            <label for="fname">first name<span>*</span></label>
                            <input id="fname" class="@error('fname') is-invalid @enderror form-control"  type="text" name="fname" value="{{ old('fname') }}" placeholder="Your name">
                        </p>
                        <p class="row-in-form">
                            <label for="lname">last name<span>*</span></label>
                            <input id="lname" class="@error('lname') is-invalid @enderror form-control" type="text" name="lname" value="{{ old('lname') }}" placeholder="Your last name">
                        </p>
                        <p class="row-in-form">
                            <label for="email">Email Addreess:</label>
                            <input id="email" class="@error('email') is-invalid @enderror form-control" type="email" name="email" value="{{ old('email') }}" placeholder="Type your email">
                        </p>
                        <p class="row-in-form">
                            <label for="phone">Phone number<span>*</span></label>
                            <input id="phone" type="number" class="@error('phone_number') is-invalid @enderror form-control" name="phone_number" value="{{ old('phone_number') }}" placeholder="10 digits format">
                        </p>
                        <p class="row-in-form">
                            <label for="add">Address:</label>
                            <input id="add" type="text" class="@error('address') is-invalid @enderror form-control" name="address" value="{{ old('address') }}" placeholder="Street at apartment number">
                        </p>
                        <p class="row-in-form">
                            <label for="country">Country<span>*</span></label>
                            <input id="country" type="text" class="@error('country') is-invalid @enderror form-control" name="country" value="{{ old('country') }}" placeholder="United States">
                        </p>
                        <p class="row-in-form">
                            <label for="country">State<span>*</span></label>
                            <input id="country" type="text" class="@error('state') is-invalid @enderror form-control" name="state" value="{{ old('state') }}" placeholder="United States">
                        </p>
                        <p class="row-in-form">
                            <label for="zip-code">Postcode / ZIP:</label>
                            <input id="zip-code" type="number" class="@error('postcode') is-invalid @enderror form-control" name="postcode" value="{{ old('postcode') }}" placeholder="Your postal code">
                        </p>
                        <p class="row-in-form">
                            <label for="city">Town / City<span>*</span></label>
                            <input id="city" type="text" class="@error('city') is-invalid @enderror form-control" name="city" value="{{ old('city') }}" placeholder="City name">
                        </p>
                        <p class="row-in-form">
                            <label for="country">Comments<span>*</span></label>
                            <textarea class="form-control" name="message" >{{ old('message') }}</textarea>
                        </p>
                        <?php $totalprice = 0 ?>
                        @foreach(session('cart') as $id => $details)
                            @php
                                $totalprice += $details['price'] * $details['quantity'];
                            @endphp
                            <input type="hidden" value="{{ $totalprice }}" name="total_payment" >
                        @endforeach

                        <section>
                            <div class="choose-payment-methods">
                                <label></label>
                                <label class="payment-method">
                                    <input name="payment-method" class="payment_method_select" id="payment-method-visa" value="card" type="radio">
                                    <span>visa</span>
                                    <div class="payment-desc">

                                        <div class='form-row row'>
                                            <div class='col-xs-12 form-group card required'>
                                                <label class='control-label'>Card Number</label> <input
                                                    autocomplete='off'  name="card_number" class='form-control card-num' size='20'
                                                    type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row row'>
                                            <div class='col-xs-12 col-md-4 form-group cvc required'>
                                                <label class='control-label'>CVC</label>
                                                <input autocomplete='off'  name="cvc" class='form-control card-cvc' placeholder='e.g 415' size='4'
                                                       type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Month</label>
                                                <input class='form-control card-expiry-month'  name="month"  placeholder='MM' size='2' type='text'>
                                            </div>
                                            <div class='col-xs-12 col-md-4 form-group expiration required'>
                                                <label class='control-label'>Expiration Year</label> <input
                                                    class='form-control card-expiry-year' name="year"  placeholder='YYYY' size='4'
                                                    type='text'>
                                            </div>
                                        </div>

                                        <div class='form-row row'>
                                            <div class='col-md-12 hide error form-group'>
                                                <div class='alert-danger alert'>Fix the errors before you begin.</div>
                                            </div>
                                        </div>


                                    </div>
                                </label>
                                <label class="payment-method">
                                    <input name="payment-method" class="payment_method_select" id="payment-method-paypal" value="COD" type="radio">
                                    <span>Cash on delivery</span>
                                    <!--<span class="payment-desc">You can pay with your credit</span>
                                    <span class="payment-desc">card if you don't have a paypal account</span>-->
                                </label>
                            </div>
                            <div class="submitbutton">
                                <input type="submit" value="Place order now" class="btn btn-danger btn-lg btn-block">
                            </div>
                        </section>
                    </form>
                </div>
            </div>
            <div class="col-md-4">
                <h3 class="box-title">Order Details</h3>
                <ul class="order_item">
                    <?php $total = 0 ?>
                    @if(session('cart'))
                        <li class="order-items">
                            <div class="product-name"><b>Name</b></div>
                            <div class="quantity"><b>Quantity</b> </div>
                            <div class="price-field sub-total"><b>Price</b></div>
                        </li>

                        @foreach(session('cart') as $id => $details)
                            @php
                                $total += $details['price'] * $details['quantity'];
                               $ptitle = str_replace(' ', '-', $details['name']);
                               $p_slug = strtolower($ptitle);
                            @endphp
                            <li class="order-items">
                                <div class="product-name">
                                    <a class="link-to-product" href="{{ url( '/product/'.$p_slug ) }}">{{ $details['name'] }}</a>
                                </div>
                                <div class="quantity">{{ $details['quantity'] }} </div>
                                <div class="price-field sub-total"><p class="price">${{ $details['price'] * $details['quantity'] }}</p></div>
                            </li>
                        @endforeach
                            <li class="total_payment">
                                <div class="total-payment"><b>Total Payment</b></div>
                                <b class="total-amount"><b>{{ $total }}</b></div>
                            </li>
                    @else
                        <h4>No record found!</h4>
                    @endif
                </ul>
            </div>
        @else
            <h3>Your cart is currently empty.</h3>
            <a class="btn btn-danger" href="{{ url('products') }}">Return to shop</a>
        @endif
    </div>
</div><!--end container-->


<script src="assets/js/jquery-1.12.4.minb8ff.js?ver=1.12.4"></script>
<script src="assets/js/owl.carousel.min.js"></script>
<script src="assets/js/functions.js"></script>
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>


<script type="text/javascript">

    $(function() {
        var $form  = $(".validation");
        $('form.validation').bind('submit', function(e) {
            if($("#payment-method-visa").is(":checked")) {
                var $form = $(".validation"),
                    inputVal = ['input[type=email]', 'input[type=password]',
                        'input[type=text]', 'input[type=file]',
                        'textarea'].join(', '),
                    $inputs       = $form.find('.required').find(inputVal),
                    $errorStatus = $form.find('div.error'),
                    valid    = true;
                $errorStatus.addClass('hide');

                $('.has-error').removeClass('has-error');
                $inputs.each(function(i, el) {
                    var $input = $(el);
                    if ($input.val() === '') {
                        $input.parent().addClass('has-error');
                        $errorStatus.removeClass('hide');
                        e.preventDefault();
                    }
                });

                if (!$form.data('cc-on-file')) {
                    e.preventDefault();
                    Stripe.setPublishableKey($form.data('stripe-publishable-key'));
                    Stripe.createToken({
                        number: $('.card-num').val(),
                        cvc: $('.card-cvc').val(),
                        exp_month: $('.card-expiry-month').val(),
                        exp_year: $('.card-expiry-year').val()
                    }, stripeHandleResponse);
                }
            }

        });

        function stripeHandleResponse(status, response) {
            if (response.error) {
                $('.error')
                    .removeClass('hide')
                    .find('.alert')
                    .text(response.error.message);
            } else {
                var token = response['id'];
                $form.find('input[type=text]').empty();
                $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
                $form.get(0).submit();
            }
        }

    });
</script>


@endsection
