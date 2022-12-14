@extends('layouts.app')
@section('content')

<div class="container">
  <div class="row">
<div class="card">
  <div class="card-header">Edit Product</div>
  <div class="card-body">

      <form action="{{ url('admin/categories/' .$category->id) }}" method="post">
        {!! csrf_field() !!}
        @method("PATCH")
        <input type="hidden" name="id" id="id" value="{{$category->id}}" id="id" />
        <label>Name</label></br>
        <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control"></br>
        <input type="submit" value="Update" class="btn btn-success"></br>
    </form>

  </div>
</div>

</div>
</div>

@stop
