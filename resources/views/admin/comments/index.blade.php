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
            @if(Session::has('message'))
                <div class="alert alert-success">
                    {{Session::get('message')}}
                </div>
            @endif
            </div>
        </div>
            <div class="card">
                <div class="card-header">
                    <h2>All Comments</h2>
                </div>
                <div class="card-body">
                    @if($comments)
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Comment</th>
                                <th>Actions</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($comments as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->name }}</td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->comment }}</td>

                                    @php
                                        if( $item->status == 0 ){
                                            $buttonvalue = 'Publish';
                                            $commentval = '1';
                                       }elseif(   $item->status == 1 ){
                                            $buttonvalue = 'Draft';
                                            $commentval = '0';
                                        }
                                    @endphp
                                    <td>
                                        <form  method="POST" action="{{ url('/admin/all-comments') }}" accept-charset="UTF-8" style="display:inline">
                                             {{ csrf_field() }}
                                            <input type="hidden" value="{{ $commentval }}" name="action" >
                                            <input type="hidden" value="{{ $item->id }}" name="comment_id" >

                                            <button type="submit" class="btn btn-success btn-sm mb-4" title="Delete Product" ><i class="fa fa-trash-o" aria-hidden="true"></i>
                                                {{ $buttonvalue }}</button>
                                        </form>
                                        <form method="POST" action="{{ url('/admin/all-comments') }}" accept-charset="UTF-8" style="display:inline">
                                            {{ csrf_field() }}
                                            <input type="hidden" value="delete" name="delete" >
                                            <input type="hidden" value="{{ $item->id }}" name="comment_id" >
                                            <button type="submit" class="btn btn-danger btn-sm" title="Delete Product" onclick="return confirm(&quot;Confirm delete?&quot;)"><i class="fa fa-trash-o" aria-hidden="true"></i> Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                        {{ $comments->links() }}
                    @endif
                </div>
            </div>
    </div>
    <script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/raphael-min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/morris.min.js') }}"></script>
    <script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
@endsection




