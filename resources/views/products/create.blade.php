@extends('layouts.app')
@section('content')
<div class="container">
  <div class="row">
<div class="card">
  <div class="card-header">Create Products</div>
  <div class="card-body">
      @if ($errors->any())
        <div class="alert alert-danger">
            <strong>Whoops!</strong> There were some problems with your input.<br><br>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
      @endif
      <form action="{{ url('products') }}" method="post">
          <input type="hidden" name="user_id" value="{{ $uid }}" >
        {!! csrf_field() !!}
        <label>Product title</label></br>
        <input type="text" name="name" id="name" class="form-control"></br>
        <label>Price</label></br>
        <input type="text" name="price" id="price" class="form-control"></br>
        <label>Description</label></br>
        <textarea type="text" name="description" id="description" class="form-control"></textarea></br>
        <input type="submit" value="Save" class="btn btn-success"></br>
    </form>

  </div>
</div>
</div>
</div>
@stop
