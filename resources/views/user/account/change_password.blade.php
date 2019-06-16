@extends('layouts.user')

@section('content')

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Update Password Section</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span class="fa fa-home"></span></a>
                        </li>
                        <li class="breadcrumb-item active">Update Password</li>
                    </ol>
                </div>
            </div>
            <hr>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12 col-sm-12 col-xs-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title"><span class="fa fa-lock"></span> Update Password</h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <div class="row">
                            <div class="col-md-6 offset-md-3">
                                <form role="form" action="{{ route('user.change.password') }}" method="POST"
                                      id="changePassword">
                                    @csrf
                                    <div class="card-body">
                                        @include('inc.alert')
                                        <div class="form-group">
                                            <label for="currentPassword">Current Password</label>
                                            <input type="password"
                                                   class="form-control {{ $errors->has('currentPassword') ? ' is-invalid' : '' }}"
                                                   id="currentPassword" name="currentPassword"
                                                   placeholder="Current Password" required minlength="8">

                                            @if ($errors->has('currentPassword'))
                                                <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('currentPassword') }}</strong>
			                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="newPassword">New Password</label>
                                            <input type="password"
                                                   class="form-control {{ $errors->has('newPassword') ? ' is-invalid' : '' }}"
                                                   id="newPassword" name="newPassword"
                                                   placeholder="New Password" required minlength="8">

                                            @if ($errors->has('newPassword'))
                                                <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('newPassword') }}</strong>
			                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <label for="confirmPassword">Confirm Password</label>
                                            <input type="password"
                                                   class="form-control {{ $errors->has('confirmPassword') ? ' is-invalid' : '' }}"
                                                   id="confirmPassword" name="confirmPassword"
                                                   placeholder="Confirm New Password" required minlength="8">

                                            @if ($errors->has('confirmPassword'))
                                                <span class="invalid-feedback">
			                                        <strong>{{ $errors->first('confirmPassword') }}</strong>
			                                    </span>
                                            @endif
                                        </div>
                                        <div class="form-group">
                                            <br>
                                            <button type="submit" class="btn btn-primary btn-block"><span
                                                    class="fa-lock fa"></span> Update Password
                                            </button>
                                        </div>
                                    </div>
                                    <!-- /.card-body -->
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!--/.col (left) -->
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        document.querySelector('#changePassword').addEventListener('submit', function (e) {
            let form = this;

            e.preventDefault(); // <--- prevent form from submitting

            swal({
                title: "Change Password",
                text: "Are you sure you want to proceed?",
                type: "question",
                showCancelButton: true,
                // confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, I am sure!',
                cancelButtonText: "No, cancel it!",
                closeOnConfirm: false,
                closeOnCancel: false,
                dangerMode: true,
            }).then((willPromote) => {
                e.preventDefault();
                if (willPromote.value) {
                    form.submit(); // <--- submit form programmatically
                } else {
                    swal("Cancelled :)", "", "success");
                    e.preventDefault();
                    $('#loading').hide();
                    return false;
                }
            });
        });
    </script>
@endsection
