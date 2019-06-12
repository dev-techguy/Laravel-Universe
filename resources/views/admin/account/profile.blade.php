@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Profile Section</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><span class="fa fa-home"></span></a>
                        </li>
                        <li class="breadcrumb-item active">{{ auth('admin')->user()->name }} Profile</li>
                    </ol>
                </div>
            </div>
            <hr>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-md-3">
                    <!-- Profile Image -->
                    <div class="card card-primary card-outline">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{ asset('img/avatar.png') }}"
                                     alt="User profile picture">
                            </div>
                            <hr>
                            <h3 class="profile-username text-center">System Admin</h3>
                            <hr>
                            <a href="{{ route('admin.logout') }}" class="btn btn-danger btn-block"><b>Logout</b></a>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
                <div class="col-md-9">
                    <div class="card">
                        <div class="card-header p-2">
                            <ul class="nav nav-pills">
                                <li class="nav-item"><a class="nav-link active" href="{{ route('admin.profile') }}"
                                                        data-toggle="tab">Account Details</a></li>
                            </ul>
                        </div><!-- /.card-header -->
                        <div class="card-body">
                            <div class="tab-content">
                                <div class="active tab-pane" id="activity">
                                    <!-- Account -->
                                    <div class="post">
                                        <div class="row">
                                            <div class="col-12">
                                                <table class="table table-hover table-responsive">
                                                    <tr>
                                                        <td><h3><span class="fa fa-user text-primary"></span></h3></td>
                                                        <td><p>{{ auth('admin')->user()->name }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h3><span class="fa fa-envelope text-primary"></span></h3>
                                                        </td>
                                                        <td><p>{{ auth('admin')->user()->email }}</p></td>
                                                    </tr>
                                                </table>
                                                <center>
                                                    <div class="col-md-6">
                                                        <hr>
                                                        <h6 class="text-danger text-bold">Last Login :: <span
                                                                class="text-black-50">{{ date('F d, Y h:m a', strtotime(auth('admin')->user()->updated_at)) }}</span>
                                                        </h6>
                                                        <hr>
                                                    </div>
                                                </center>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.Account -->
                                </div>
                            </div>
                            <!-- /.tab-content -->
                        </div><!-- /.card-body -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
