@extends('admin.top-and-sidebar')
@section('content')
    <div class="container">
        <div class="row">
            @if(Session::has('message'))
                <div class="col-md-12 mt-4" >
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                </div>
            @endif
            <div class="col-md-12 mt-4">
                <div class="card">
                    <div class="card-header">
                        <h2>Add New Products</h2>
                    </div>
                    <div class="card-body">
                        <a href="{{ url('/admin/product/add') }}" class="btn btn-success btn-sm" title="Add New Product">
                            <i class="fa fa-plus" aria-hidden="true"></i> Add New
                        </a>
                        <br/>
                        <br/>
                        <div class="table-responsive">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Name</th>
                                        <th>Price</th>
                                        <th>Quantity</th>
                                        <th>Status</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>

                                @foreach($products as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->name }}</td>
                                        <td>{{ $item->price }}</td>
                                        <td>{{ $item->qty }}</td>
                                        <td>
                                            @if( $item->status == 1 )
                                                Publish
                                                <form method="POST" action="{{ url('/admin/products' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    <input type="hidden" value="0" name="status">
                                                    <input type="hidden" value="{{ $item->id }}" name="product_id">
                                                    {{ method_field('post') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" name="submit_action" class="btn btn-danger btn-sm" title="Update Product" onclick="return confirm(&quot;Confirm Update?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Draft</button>
                                                </form>
                                            @elseif($item->status == 0)
                                                Draft
                                                <form method="POST" action="{{ url('/admin/products' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                    <input type="hidden" value="1" name="status">
                                                    <input type="hidden" value="{{ $item->id }}" name="product_id">
                                                    {{ method_field('post') }}
                                                    {{ csrf_field() }}
                                                    <button type="submit" name="submit_action" class="btn btn-success btn-sm" title="Update Product" onclick="return confirm(&quot;Confirm Update?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Publish</button>
                                                </form>
                                            @endif
                                        </td>

                                        <td>
                                            <a href="{{ url('/product/' . $item->slug) }}" title="View Product"><button class="btn btn-info btn-sm"><i class="fa fa-eye" aria-hidden="true"></i> View</button></a>
                                            <a href="{{ url('/admin/product/edit/' . $item->id ) }}" title="Edit Product"><button class="btn btn-primary btn-sm"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Edit</button></a>

                                            <form method="POST" action="{{ url('/admin/products' . '/' . $item->id) }}" accept-charset="UTF-8" style="display:inline">
                                                {{ method_field('DELETE') }}
                                                {{ csrf_field() }}
                                                <button type="submit" class="btn btn-danger btn-sm" title="Delete Product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>

                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
@endsection
