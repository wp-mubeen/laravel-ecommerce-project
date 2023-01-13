@extends('admin.top-and-sidebar')
@section('content')
    <div class="page-wrapper">
        <div class="container">
            <div class="row mt-4">
                <div class="card">
                    <div class="card-header"><h2>Add Category</h2></div>
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
                        <form action="{{ url('admin/categories') }}" method="post">
                            {!! csrf_field() !!}
                            @if(count($allCategories) >= 1)
                                <label>Parent Category Name</label></br>
                                <select name="parent_catg" id="parent_catg" class="form-control" >
                                    <option value="0">Select Category</option>
                                    @foreach($allCategories as $item)
                                        <option value="{{ $item->id }}"  @if (  $item->id ==  old('parent_catg') )
                                            {{'selected="selected"'}}
                                            @endif >{{ $item->name }}</option>
                                    @endforeach
                                </select></br>
                            @endif
                            <label>Name</label></br>
                            <input type="text" name="name" id="name"  class="form-control @error('name') is-invalid  @enderror" /></br>


                            <input type="submit" value="Create" class="btn btn-success"></br>
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
