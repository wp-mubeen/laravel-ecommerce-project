@extends('admin.top-and-sidebar')
@section('content')
<div class="container">
  <div class="row mt-4">
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

      <section class="panel panel-default">
          <div class="panel-heading">
              <h2 class="panel-title">Add Product</h2>
          </div>
              <form action="{{ url('/admin/products') }}" enctype="multipart/form-data" class="form-horizontal" method="post">
                  <input type="hidden" name="user_id" value="{{ $uid }}" >
                  {!! csrf_field() !!}
                  <div class="form-group mt-3">
                      <label for="tech" class="col-sm-2 control-label">Add Category</label>
                      <div class="col-sm-9">
                          @if($categories)
                              <select class="form-control" name="cate_id">
                                  @foreach($categories as $item)
                                     <option value="{{ $item->id }}" @if (  $item->id ==  old('cate_id') )
                                         {{'selected="selected"'}}
                                         @endif  >{{$item->name}}</option>
                                  @endforeach
                           </select>
                           @endif
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Title</label>
                      <div class="col-sm-9">
                          <input type="text" value="{{ old('name') }}" class="form-control @error('name') is-invalid  @enderror" name="name" id="product_title" placeholder="Product Title">
                          @error('name') <span class="invalid-feedback">{{ $message }} </span> @enderror
                      </div>
                  </div>

                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Small Description</label>
                      <div class="col-sm-9">
                          <textarea  class="form-control" name="small_description" id="small_desc" >{{ old('small_description') }}</textarea>
                      </div>
                  </div> <!-- form-group // -->
                  <div class="form-group">
                      <label for="name" class="col-sm-2 control-label">Description</label>
                      <div class="col-sm-9">
                          <textarea  class="form-control" name="description" id="full_desc" >{{ old('description') }}</textarea>
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="about" class="col-sm-2 control-label">Price</label>
                      <div class="col-sm-9">
                          <input type="text" value="{{ old('price') }}" name="price" class="form-control  @error('price') is-invalid  @enderror" id="price" >
                          @error('price') <span class="invalid-feedback">{{ $message }} </span> @enderror
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="about" class="col-sm-2 control-label">Sale Price</label>
                      <div class="col-sm-9">
                          <input type="text" value="{{ old('selling_price') }}" name="selling_price" id="sell_price" class="form-control">
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="about" class="col-sm-2 control-label">Upload Image</label>
                      <div class="col-sm-9">
                          <input type="file" value="{{ old('product_img') }}"  class="form-control @error('product_img') is-invalid  @enderror" name="product_img" id="prd_img" >
                          @error('product_img') <span class="invalid-feedback">{{ $message }} </span> @enderror
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="qty" class="col-sm-2 control-label">Quantity</label>
                      <div class="col-sm-3">
                          <input type="number" value="{{ old('qty') }}" class="form-control" name="qty" id="qty" >
                      </div>
                  </div>
                  <div class="form-group">
                      <label class="col-sm-2 control-label">Trending</label>
                      <div class="col-sm-3">
                          <label class="radio-inline">
                              <input type="radio"  name="trending"  value="1"> Yes
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
                          <input type="number" value="{{ old('tax') }}" class="form-control" name="tax" id="tax" >
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="qty" class="col-sm-2 control-label">Meta Title</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ old('meta_title') }}" name="meta_title" id="meta_title" >
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="qty" class="col-sm-2 control-label">Meta Keywords</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ old('meta_keywords') }}" name="meta_keywords" id="meta_keywords" >
                      </div>
                  </div>
                  <div class="form-group">
                      <label for="qty" class="col-sm-2 control-label">Meta Description</label>
                      <div class="col-sm-9">
                          <input type="text" class="form-control" value="{{ old('meta_description') }}" name="meta_description" id="meta_desc" >
                      </div>
                  </div>


                  <hr>
                  <div class="form-group">
                      <div class="col-sm-offset-3 col-sm-9">
                          <button type="submit" class="btn btn-primary">Submit</button>
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
