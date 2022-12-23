@extends('admin.top-and-sidebar')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 mt-4">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('message'))
                    <div class="col-md-12 mt-4" >
                        <p class="alert alert-info">{{ Session::get('message') }}</p>
                    </div>
                @endif

                <section class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Add Product</h3>
                    </div>
                    <form action="/admin/product/{{$productSingle->id}} }}" enctype="multipart/form-data" class="form-horizontal" method="post">
                        <input type="hidden" name="user_id" value="{{ $uid }}" >
                        {!! csrf_field() !!}
                        @method("PATCH")
                        <div class="form-group mt-3">
                            <label for="tech" class="col-sm-2 control-label">Add Category</label>
                            <div class="col-sm-9">
                                @if($categories)
                                    <select class="form-control" name="cate_id">
                                        @foreach($categories as $item)
                                            <option value="{{ $item->id }}" @if (  $item->id ==  $productSingle->cate_id )
                                                {{'selected="selected"'}}
                                                @endif >{{$item->name}}</option>
                                        @endforeach
                                    </select>
                                @endif
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Title</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$productSingle->name}}" class="form-control" name="name" id="product_title" placeholder="Product Title">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Small Description</label>
                            <div class="col-sm-9">
                                <textarea  class="form-control" name="small_description" id="small_desc" >{{$productSingle->small_description}}</textarea>
                            </div>
                        </div> <!-- form-group // -->
                        <div class="form-group">
                            <label for="name" class="col-sm-2 control-label">Description</label>
                            <div class="col-sm-9">
                                <textarea  class="form-control" name="description" id="full_desc" >{{$productSingle->description}}</textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about" class="col-sm-2 control-label">Price</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$productSingle->price}}" name="price" id="price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about" class="col-sm-2 control-label">Sale Price</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$productSingle->selling_price}}" name="selling_price" id="sell_price" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="about" class="col-sm-2 control-label">Upload Image</label>
                            <div class="col-sm-9">
                                <input type="hidden" name="product_img" value="{{$productSingle->product_img}}" >
                                <input type="file" name="product_img" id="prd_img" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-sm-2 control-label">Quantity</label>
                            <div class="col-sm-3">
                                <input type="number" value="{{$productSingle->qty}}" class="form-control" name="qty" id="qty" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Trending</label>
                            <div class="col-sm-3">
                                <label class="radio-inline">
                                    <input type="radio" name="trending"  value="1"> Yes
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="trending"  value="0"> No
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Status</label>
                            <div class="col-sm-9">
                                <label class="radio-inline">
                                    <input type="radio" name="status"  value="1"> Publish
                                </label>
                                <label class="radio-inline">
                                    <input type="radio" name="status"  value="0"> Draft
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-sm-2 control-label">Tax % value</label>
                            <div class="col-sm-9">
                                <input type="number" value="{{$productSingle->tax}}" class="form-control" name="tax" id="tax" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-sm-2 control-label">Meta Title</label>
                            <div class="col-sm-9">
                                <input type="text" value="{{$productSingle->meta_title}}" class="form-control" name="meta_title" id="meta_title" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-sm-2 control-label">Meta Keywords</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$productSingle->meta_keywords}}" name="meta_keywords" id="meta_keywords" >
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="qty" class="col-sm-2 control-label">Meta Description</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" value="{{$productSingle->meta_description}}" name="meta_description" id="meta_desc" >
                            </div>
                        </div>


                        <hr>
                        <div class="form-group">
                            <div class="col-sm-offset-3 col-sm-9">
                                <button type="submit" class="btn btn-primary">Update</button>
                            </div>
                        </div>
                    </form>
                </section>

            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
@stop
