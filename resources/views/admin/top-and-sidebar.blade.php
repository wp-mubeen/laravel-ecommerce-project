@extends('admin.layout.app')
    <!-- Navigation -->
    <nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
           <h3 class="text-white">{{ $user->name }}</h3>
        </div>

        <!-- Top Menu Items -->
        <ul class="nav navbar-right top-nav">
            <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user"></i> <img style="width:25px;" src="{{ $user->picture }}" > John Smith <b class="caret"></b></a>
                <ul class="dropdown-menu">
                    <li>
                        <a href="{{ url('admin/profile') }}"><i class="fa fa-fw fa-user"></i> Profile</a>
                    </li>
                    <li class="divider"></li>
                    <li>
                        <a href="{{ route('logout') }}" class="fa fa-fw fa-power-off">Logout</a>
                    <li>
                </ul>
            </li>
        </ul>
        <!-- Sidebar Menu Items - These collapse to the responsive navigation menu on small screens -->
        <div class="collapse navbar-collapse navbar-ex1-collapse">
            <ul class="nav navbar-nav side-nav">
                <li class="active">
                    <a href="{{ url('admin') }}"><i class="fa fa-fw fa-dashboard"></i> Dashboard</a>
                </li>
                <li>
                    <a href="{{ url('admin/products') }}"><i class="fa fa-fw fa-bar-chart-o"></i> Products</a>
                </li>
                <li>
                    <a href="{{ url('admin/all-comments') }}"><i class="fa fa-fw fa-bar-chart-o"></i> Product Comments</a>
                </li>
                <li>
                    <a href="{{ url('admin/categories') }}"><i class="fa fa-fw fa-table"></i> Categories</a>
                </li>
                <li>
                    <a href="{{ url('admin/all-orders') }}"><i class="fa fa-fw fa-desktop"></i> Orders</a>
                </li>
                <li>
                    <a href="{{ url('admin/all-users') }}"><i class="fa fa-fw fa-edit"></i> Users</a>
                </li>
                <li>
                    <a href="{{ url('admin/profile') }}"><i class="fa fa-fw fa-desktop"></i> Profile</a>
                </li>
            </ul>
        </div>
        <!-- /.navbar-collapse -->
    </nav>




