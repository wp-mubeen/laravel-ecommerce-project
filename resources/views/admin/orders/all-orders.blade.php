@extends('admin.top-and-sidebar')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />
<link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">
@section('content')

<div class="container bootstrap snippets bootdey">
    <div class="row">
        <div class="col-lg-12">
            @if(Session::has('message'))
                <div class="col-md-12 mt-4" >
                    <p class="alert alert-info">{{ Session::get('message') }}</p>
                </div>
            @endif
            <div class="main-box no-header mt-4 clearfix">
                <table class="table table-bordered" id="datatable-crud">
                    <thead>
                    <tr>
                        <th>Id</th>
                        <th>User Id</th>
                        <th>First Name</th>
                        <th>Last Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>
<!-- /#page-wrapper -->
<script src="{{ asset('assets/admin/js/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/raphael-min.js') }}"></script>
<script src="{{ asset('assets/admin/js/morris.min.js') }}"></script>
<script src="{{ asset('assets/admin/js/bootstrap.min.js') }}"></script>
<script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
    $(document).ready( function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('#datatable-crud').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ url('/admin/all-orders') }}",
            columns: [
                { data: 'id', name: 'id' },
                { data: 'userid', name: 'userid' },
                { data: 'fname', name: 'fname' },
                { data: 'lname', name: 'lname' },
                { data: 'email', name: 'email' },
                { data: 'phone_number', name: 'phone_number' },
                {data: 'action', orderable: false},
            ],
            order: [[0, 'desc']]
        });

    });
</script>


@stop
