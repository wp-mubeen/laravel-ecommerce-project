@extends('admin.top-and-sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="row mt-4">
                <div class="card">
                    <div class="card-header"><h2>Edit Product</h2></div>
                    <div class="card-body">

                        <form action="{{ url('admin/categories/' .$category->id) }}" method="post">
                            {!! csrf_field() !!}
                            @method("PATCH")
                            @if(count($allCategories) > 1)
                                <label>Parent Category Name</label></br>
                                <select name="parent_catg" id="parent_catg" class="form-control">
                                    <option value="0">Select Category</option>
                                    @foreach($allCategories as $item)
                                        @if( $item->id ==  $category->id )
                                            @continue
                                        @endif
                                        <option value="{{ $item->id }}" @if (  $item->id ==  $category->parent_catg )
                                            {{'selected="selected"'}}
                                            @endif >{{ $item->name }}</option>
                                    @endforeach
                                </select></br>
                            @endif
                            <input type="hidden" name="id" id="id" value="{{$category->id}}" id="id" />
                            <label>Name</label></br>
                            <input type="text" name="name" id="name" value="{{$category->name}}" class="form-control"></br>
                            <input type="submit" value="Update" class="btn btn-success"></br>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
@stop
