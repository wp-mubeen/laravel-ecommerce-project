@extends('layouts.app')
@section('content')
 
<div class="container">
  <div class="row">
<div class="card">
  <div class="card-header">Edit Product</div>
  <div class="card-body">
      
      <form action="{{ url('products/' .$product->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$product->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$product->name}}" class="form-control"></br>
        <label>Price</label></br>
        <input type="text" name="price" id="price" value="{{$product->price}}" class="form-control"></br>
        <label>Description</label></br>
        <textarea  name="description" class="form-control" id="description">{{$product->description}}</textarea> </br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>
   
  </div>
</div>

</div>
</div>
 
@stop