@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row mt-4">
      <h3><a href="{{route('all')}}">Back to all listing</a> </h3>
  <div class="card">
    <div class="card-header">Product Detail</div>
    <div class="card-body">


          <div class="card-body">
          <h5 class="card-title">Name : {{ $product->name }}</h5>
          <p class="card-text">price : {{ $product->price }}</p>
          <p class="card-text">description : {{ $product->description }}</p>
    </div>

      </hr>

  </div>
  </div>
</div>
@endsection
