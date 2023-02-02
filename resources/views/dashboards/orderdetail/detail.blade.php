@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="container">
            @if(Session::has('success'))
                <div class="alert alert-success">
                    {{Session::get('success')}}
                </div>
            @endif
            <!-- Title -->
            <div class="d-flex justify-content-between align-items-center py-3">
                <h2 class="h5 mb-0"><a href="#" class="text-muted"></a> Order #{{ $order->id }}</h2>
            </div>

            <!-- Main content -->
            <div class="row">
                <div class="col-lg-8">
                    <!-- Details -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="mb-3 d-flex justify-content-between">
                                <div>
                                    <span class="me-3">{{ $order->created_at }}</span>
                                </div>
                                <div class="d-flex">
                                    <button class="btn btn-link p-0 me-3 d-none d-lg-block btn-icon-text">
                                        @if($order->status == 0)
                                            <h4>Processing</h4>
                                            @if($userlevel == 1)
                                            <form method="post" action="">
                                                <input type="hidden" value="{{  $order->id }}" name="orderid" >
                                                {!! csrf_field() !!}
                                                <input type="submit" value="Complete" class="btn btn-primary" >
                                            </form>
                                            @endif
                                        @else
                                            <h4>Completed</h4>
                                        @endif
                                    </button>
                                </div>
                            </div>
                            <table class="table table-borderless">
                                <tbody>
                                @if($orderitems)
                                    @foreach($orderitems as $item)

                                <tr>
                                    <td>
                                        <div class="d-flex mb-2">
                                            <div class="flex-shrink-0">
                                                <img src="{{ $item->image }}" alt="" width="35" class="img-fluid">
                                            </div>
                                            <div class="flex-lg-grow-1 ms-3">
                                                <h6 class="small mb-0"><a href="{{ url('product/').$item->slug }}" class="text-reset">{{ $item->name }}</a></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>{{ $item->quantity }}</td>
                                    <td class="text-end">${{ $item->price }}</td>
                                </tr>
                                    @endforeach
                                @endif

                                </tbody>
                                <tfoot>
                                <tr>
                                    <td colspan="2">Subtotal</td>
                                    <td class="text-end">${{ $paymentdetail->total_amount }}</td>
                                </tr>
                                <tr>
                                    <td colspan="2">Shipping</td>
                                    <td class="text-end">$00.00</td>
                                </tr>
                               <!-- <tr>
                                    <td colspan="2">Discount (Code: NEWYEAR)</td>
                                    <td class="text-danger text-end">-$10.00</td>
                                </tr>-->
                                <tr class="fw-bold">
                                    <td colspan="2">TOTAL</td>
                                    <td class="text-end">${{ $paymentdetail->total_amount }}</td>
                                </tr>
                                </tfoot>
                            </table>
                        </div>
                    </div>
                    <!-- Payment -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-6">
                                    <h3 class="h6">Payment Method</h3>
                                    <p>{{ $paymentdetail->payment_method }} <br>
                                        <b>Payment Status  </b><span class="badge bg-success rounded-pill">{{ $paymentdetail->payment_status }}</span></p>
                                </div>
                                <div class="col-lg-6">
                                    <h3 class="h6">Billing address</h3>
                                    <address>
                                        <strong>{{ $order->f_name . ' '. $order->l_name }}</strong><br>
                                        <b>Address: </b>{{ $order->address }}<br>
                                        <b>Email: </b>{{ $order->email }}<br>
                                        <b title="Phone">Phone Number:</b> {{ $order->phone_number }}
                                    </address>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <!-- Customer Notes -->
                    <div class="card mb-4">
                        <div class="card-body">
                            <h3 class="h6">Customer Notes</h3>
                            <p>{{ $order->message }}</p>
                        </div>
                    </div>
                    <div class="card mb-4">
                        <!-- Shipping information -->

                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
@endsection
