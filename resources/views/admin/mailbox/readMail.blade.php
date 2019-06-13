@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>{{ env('APP_NAME') }} Inbox</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><span class="fa fa-home"></span></a>
                        </li>
                        <li class="breadcrumb-item active">Inbox</li>
                    </ol>
                </div>
            </div>
            <hr>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                @include('inc.alert')
            </div>
            <div class="col-md-3">
                {{--<a href="#" class="btn btn-primary btn-block mb-3">Compose</a>--}}

                @include('inc.adminMailbox')
            </div>
            <!-- /.col -->
            <div class="col-md-9">
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">Read Notification</h3>
                    </div>
                    <!-- /.card-header -->
                    <div class="card-body p-0">
                        <div class="mailbox-read-info">
                            <h5><strong>{{ $fetchMail->subject }}</strong></h5>
                            <h6>
                                <span
                                    class="mailbox-read-time float-right">{{ date('F d, Y h:i a', strtotime($fetchMail->created_at)) }}</span>
                            </h6>
                        </div>
                        <div class="mailbox-read-message">
                            <p>{{ $fetchMail->description }}</p>
                        </div>
                        <!-- /.mailbox-read-message -->
                    </div>
                    <!-- /.card-body -->
                    <!-- /.card-footer -->
                    <div class="card-footer">
                        <div class="float-right">
                            <form action="{{ route('admin.delete.single.mailbox') }}" class="deleteMail" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $fetchMail->id }}" name="id">
                                <button type="submit" class="btn btn-danger"><i class="fa fa-trash-o"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                    <!-- /.card-footer -->
                </div>
                <!-- /. box -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection

@section('scripts')
    <script>
        $('.deleteMail').click(function (e) {
            e.preventDefault();
            let form = this;

            swal({
                title: "Delete {{ $fetchMail->subject }} Notification",
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
                    return false;
                }
            });
        });
    </script>
@endsection
