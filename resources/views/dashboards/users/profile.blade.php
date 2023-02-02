@extends('layouts.app')

@section('content')
<div class="container">
    <div class="container">
        <div class="panel panel-default">
            <div class="panel-heading panel-heading-nav">
                <ul class="nav nav-tabs">
                    <li role="presentation" class="active">
                        <a href="#one" aria-controls="one" role="tab" data-toggle="tab">Profile</a>
                    </li>
                    <li role="presentation">
                        <a href="#two" aria-controls="two" role="tab" data-toggle="tab">My Orders</a>
                    </li>
                </ul>
            </div>
            <div class="panel-body">
                <div class="tab-content">
                    <div role="tabpanel" class="tab-pane fade in active" id="one">
                        <div class="row profile">
                            <div class="col-md-3">
                                <div class="profile-sidebar">
                                    <!-- SIDEBAR USERPIC -->
                                    <div class="profile-userpic">
                                        <img  src="{{ $urlImg  }}" class="img-responsive" alt="">
                                    </div>
                                    <!-- END SIDEBAR USERPIC -->
                                    <!-- SIDEBAR USER TITLE -->
                                    <div class="profile-usertitle">
                                        <div class="profile-usertitle-name">
                                            {{ Auth::user()->name }}
                                        </div>
                                        <div class="profile-usertitle-job">
                                            Developer
                                        </div>
                                    </div>

                                </div>
                            </div>
                            <div class="col-md-9">
                                <div class="card">
                                    <div class="card-header">{{ __('Update Profile') }}  </div>
                                    @if(Session::has('success'))
                                        <div class="alert alert-success">
                                            {{Session::get('success')}}
                                        </div>
                                    @endif

                                    <div class="card-body">
                                        <form method="POST" action="{{ url('profile/' ) }}" enctype="multipart/form-data">
                                            @csrf
                                            <input type="hidden" value="{{ Auth::user()->id }}" name="id" >
                                            <div class="row mb-3">
                                                <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>

                                                <div class="col-md-6">
                                                    <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ Auth::user()->name }}" required autocomplete="name" autofocus>

                                                    @error('name')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                                                <div class="col-md-6">
                                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ Auth::user()->email }}" required autocomplete="email">

                                                    @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="favoriteColor" class="col-md-4 col-form-label text-md-end">Favorite Color</label>
                                                <div class="col-md-6">
                                                    <input id="favoriteColor" value="{{ Auth::user()->favoritecolor }}" type="text" class="form-control @error('favoritecolor') is-invalid @enderror" name="favoritecolor"  placeholder="Enter favorite color">
                                                    <span class="text-danger">@error('favoritecolor'){{ $message }}@enderror</span>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <label for="favoriteColor" class="col-md-4 col-form-label text-md-end">Upload File</label>
                                                <div class="col-md-6">
                                                    <input id="picture" type="file" class="form-control @error('picture_file') is-invalid @enderror" name="picture_file"  >
                                                    <span class="text-danger">@error('picture_file'){{ $message }}@enderror</span>
                                                </div>
                                            </div>

                                            <div class="row mb-3">
                                                <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                                                <div class="col-md-6">
                                                    <input id="password" value="{{ Auth::user()->password }}" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                                    @error('password')
                                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                                    @enderror
                                                </div>
                                            </div>


                                            <div class="row mb-0">
                                                <div class="col-md-6 offset-md-4">
                                                    <button type="submit" class="btn btn-primary">
                                                        {{ __('Update') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div role="tabpanel" class="tab-pane fade" id="two">
                        <h4>Orders</h4>

                        <table class="shop_table my_account_orders">

                            <thead>
                            <tr>
                                <th class="order-number">Order</th>
                                <th class="order-date">Date</th>
                                <th class="order-status">Tracking No</th>
                                <th class="order-total">Status</th>
                                <th class="order-actions">Actions</th>
                            </tr>
                            </thead>

                            <tbody>
                            @if($allorders)
                                @foreach($allorders as $order)

                                    <tr class="order">
                                        <td class="order-number" data-title="Order">
                                            <a href="{{ url('order-detail'). $order->id }}">#{{ $order->id }}</a>
                                        </td>
                                        <td class="order-date" data-title="Date">
                                            <time datetime="{{ $order->created_at }}" >{{ $order->created_at }}</time>
                                        </td>
                                        <td class="order-total" >
                                            {{ $order->tracking_no }}
                                        </td>
                                        <td class="order-status" data-title="Status">
                                            @if( $order->status == 0 )
                                                Processing
                                            @else
                                            Complete
                                            @endif
                                        </td>
                                        <td class="order-actions" data-title="Action">
                                            <a href="{{ url('order-detail'). $order->id }}" class="button view">View</a>
                                        </td>
                                    </tr>
                                @endforeach

                            @endif


                            </tbody>
                        </table>
                        {{ $allorders->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>



</div>
@endsection
