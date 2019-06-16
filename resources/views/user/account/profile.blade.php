@extends('layouts.user')
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
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span class="fa fa-home"></span></a>
                        </li>
                        <li class="breadcrumb-item active">{{ auth()->user()->name }} Profile</li>
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
                            <a href="{{ route('user.logout') }}" class="btn btn-danger btn-block"><b>Sign Out</b></a>
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
                                            <div class="col-6">
                                                <table class="table table-hover table-responsive">
                                                    <tr>
                                                        <td><h3><span class="fa fa-user text-primary"></span></h3></td>
                                                        <td><p>{{ auth()->user()->name }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h3><span class="fa fa-envelope text-primary"></span></h3>
                                                        </td>
                                                        <td><p>{{ auth()->user()->email }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h3><span class="fa fa-genderless text-primary"></span></h3>
                                                        </td>
                                                        <td><p>{{ auth()->user()->gender }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h3><span class="fa fa-phone-square text-primary"></span>
                                                            </h3>
                                                        </td>
                                                        <td><p>{{ auth()->user()->phoneNumber }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h3><span class="fa fa-graduation-cap text-primary"></span>
                                                            </h3>
                                                        </td>
                                                        <td>
                                                            @if(auth()->user()->program_verified)
                                                                <button class="btn btn-success btn-sm" disabled><span
                                                                        class="fa fa-check"> {{ auth()->user()->program->name }}  Program Verified</span>
                                                                </button>
                                                            @else
                                                                <button class="btn btn-danger btn-sm" disabled><span
                                                                        class="fa fa-close"> {{ auth()->user()->program->name }}  Program Un-Verified</span>
                                                                </button>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="col-6">
                                                <table class="table table-hover table-responsive">
                                                    <tr>
                                                        <td><h3><span class="fa fa-university text-primary"></span></h3>
                                                        </td>
                                                        <td><p>{{ auth()->user()->registrationNumber }}</p></td>
                                                    </tr>
                                                    <tr>
                                                        <td><h3><span class="fa fa-location-arrow text-primary"></span>
                                                            </h3>
                                                        </td>
                                                        <td><p>{{ auth()->user()->county->name }}</p></td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <center>
                                                    <hr>
                                                    <h6 class="text-danger text-bold">Last Login :: <span
                                                            class="text-black-50">{{ date('F d, Y h:i a', strtotime(auth()->user()->updated_at)) }}</span>
                                                    </h6>
                                                    <hr>
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
