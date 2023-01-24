<!DOCTYPE html>
<html>
<head>
    <title>Order Detail</title>
</head>
<style type="text/css">
    body{
        font-family: 'Roboto Condensed', sans-serif;
    }
    .m-0{
        margin: 0px;
    }
    .p-0{
        padding: 0px;
    }
    .pt-5{
        padding-top:5px;
    }
    .mt-10{
        margin-top:10px;
    }
    .text-center{
        text-align:center !important;
    }
    .w-100{
        width: 100%;
    }
    .w-50{
        width:50%;
    }
    .w-85{
        width:85%;
    }
    .w-15{
        width:15%;
    }
    .logo img{
        width:45px;
        height:45px;
        padding-top:30px;
    }
    .logo span{
        margin-left:8px;
        top:19px;
        position: absolute;
        font-weight: bold;
        font-size:25px;
    }
    .gray-color{
        color:#5D5D5D;
    }
    .text-bold{
        font-weight: bold;
    }
    .border{
        border:1px solid black;
    }
    table tr,th,td{
        border: 1px solid #d2d2d2;
        border-collapse:collapse;
        padding:7px 8px;
    }
    table tr th{
        background: #F4F4F4;
        font-size:15px;
    }
    table tr td{
        font-size:13px;
    }
    table{
        border-collapse:collapse;
    }
    .box-text p{
        line-height:10px;
    }
    .float-left{
        float:left;
    }
    .total-part{
        font-size:16px;
        line-height:12px;
    }
    .total-right p{
        padding-right:20px;
    }
</style>
<body>
<div class="head-title">
    <h1 class="text-center m-0 p-0">Invoice</h1>
</div>
<div class="add-detail mt-10">
    <div class="w-50 float-left mt-10">
       <!-- <p class="m-0 pt-5 text-bold w-100">Invoice Id - <span class="gray-color">#{{ $orderId }}</span></p>-->
        <p class="m-0 pt-5 text-bold w-100">Order Id - <span class="gray-color">#{{ $orderId }}</span></p>
        <p class="m-0 pt-5 text-bold w-100">Order Date - <span class="gray-color">{{ $date }}</span></p>
    </div>
    <div class="w-50 float-left logo mt-10">
        <a href="{{  url('home') }}" ><img style="width:200px" src="{{ asset('assets/images/logo-top-1.png') }}"> </a>
    </div>
    <div style="clear: both;"></div>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Billing Address</th>
            <th class="w-50">Shipping Address</th>
        </tr>
        <tr>
            <td>
                <div class="box-text">
                    <p><b>Billing Detail</b></p>
                    <p>{{ $address }}</p>
                    <p>{{ $country }}</p>
                    <p>{{ $city }}</p>
                    <p>{{ $state }}</p>
                    <p>{{ $postcode }}</p>
                </div>
            </td>
            <td>
                <div class="box-text">
                    <p><b>Contact Detail</b></p>
                    <p>{{ $name }}</p>
                    <p>{{ $email }}</p>
                    <p>{{ $phone_number }}</p>
                </div>
            </td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Payment Method</th>
            <th class="w-50">Shipping Method</th>
        </tr>
        <tr>
            <td>Cash On Delivery</td>
            <td>Free Shipping</td>
        </tr>
    </table>
</div>
<div class="table-section bill-tbl w-100 mt-10">
    <table class="table w-100 mt-10">
        <tr>
            <th class="w-50">Product Name</th>
            <th class="w-50">Price</th>
            <th class="w-50">Qty</th>
            <th class="w-50">Tax Amount</th>
            <th class="w-50">Sub Total</th>
        </tr>
        <?php $totalprice = 0 ?>

        @foreach(session('cart') as $id => $details)
            @php
                $totalprice += $details['price'] * $details['quantity'];
                    $total = $details['price'] * $details['quantity'];

                    $ptitle = str_replace(' ', '-', $details['name']);
                    $p_slug = strtolower($ptitle);
            @endphp
            <tr align="center">
                <td>{{ $details['name'] }}</td>
                <td>{{ $details['price'] }}</td>
                <td>{{ $details['quantity'] }}</td>
                <td>0</td>
                <td>${{ $total }}</td>
            </tr>
        @endforeach


        <tr>
            <td colspan="6">
                <div class="total-part">
                    <div class="total-left w-85 float-left" align="right">
                        <p>Sub Total</p>
                        <p>Tax (0%)</p>
                        <p>Total Payable</p>
                    </div>
                    <div class="total-right w-15 float-left text-bold" align="right">
                        <p>${{ $totalprice }}</p>
                        <p>$0</p>
                        <p>${{ $totalprice }}</p>
                    </div>
                    <div style="clear: both;"></div>
                </div>
            </td>
        </tr>
    </table>
</div>
</html>
