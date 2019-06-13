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
            @if(count($allMails))
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <div class="card-header">
                            <h3 class="card-title">All</h3>

                            <div class="card-tools">
                                <div class="input-group input-group-sm">
                                    <input type="text" onkeyup="myFunction()"
                                           placeholder="Search Inbox By Name..." title="Type Name..."
                                           class="form-control tableInput input-sm">
                                    <span class="input-group-append">
                    <button type="button" disabled class="btn btn-primary btn-flat"><span
                            class="fa fa-search"></span></button>
                  </span>
                                </div>
                            </div>
                            <!-- /.card-tools -->
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body p-0">
                            <div class="mailbox-controls">
                                <div class="row">
                                    <div class="col-md-12 card-header">
                                        <h3 class="card-title pull-left">Showing
                                            <strong>{{ count($allMails) }}</strong>
                                            records
                                            of <strong>{{ $allMails->total() }}</strong></h3>
                                        <ul class="pagination pagination-sm m-0 float-right">
                                            {{ $allMails->links() }}
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="table-responsive mailbox-messages">
                                <table class="table table-hover table-striped mailbox">
                                    <tbody>
                                    @foreach($allMails as $allMail)
                                        <tr>
                                            <td class="mailbox-star">
                                                @if($allMail->status == 0)
                                                    <a href="{{ route('admin.read.mailbox',[ 'id' => $allMail->id]) }}"><i
                                                            class="fa fa-envelope text-danger"></i></a>
                                                @else
                                                    <a href="{{ route('admin.read.mailbox',[ 'id' => $allMail->id]) }}"><i
                                                            class="fa fa-envelope-open text-success"></i></a>
                                                @endif
                                            </td>
                                            <td class="mailbox-name"><a
                                                    href="{{ route('admin.read.mailbox',[ 'id' => $allMail->id]) }}"><b>{{ $allMail->subject }}</b></a>
                                            </td>
                                            <td class="mailbox-subject">{{ substr($allMail->description, 0, 150) }}@if(strlen($allMail->description) > 150)
                                                    ...@endif
                                            </td>
                                            <td class="mailbox-date">{{ \App\Http\Controllers\SystemController::elapsedTime($allMail->created_at) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <!-- /.table -->
                            </div>
                            <!-- /.mail-box-messages -->
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer p-0">
                            <div class="row">
                                <div class="col-md-12 card-header">
                                    <form action="{{ route('admin.delete.all.mailbox') }}" class="deleteMail"
                                          method="GET">
                                        <button type="submit" class="btn btn-danger btn-sm float-right"
                                                title="Click to delete all notifications"><i class="fa fa-trash-o"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 card-header">
                                    <h3 class="card-title pull-left">Showing <strong>{{ count($allMails) }}</strong>
                                        records
                                        of <strong>{{ $allMails->total() }}</strong></h3>
                                    <ul class="pagination pagination-sm m-0 float-right">
                                        {{ $allMails->links() }}
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /. box -->
                </div>
                <!-- /.col -->
            @else
                <div class="col-md-9">
                    <div class="card card-primary card-outline">
                        <center>
                            <br>
                            <br>
                            <br>
                            <h4 class="text-danger">No Notifications Were Found</h4>
                            <h6>
                                <hr>
                                <a href="{{ route('admin.home') }}">
                                    <strong><span class="fa fa-home"></span> Home</strong>
                                </a>
                                <hr>
                            </h6>
                            <br>
                            <br>
                            <br>
                        </center>
                    </div>
                </div>
            @endif
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
                title: "Delete All Notifications",
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

        function myFunction() {
            $(document).ready(function () {
                $(".tableInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $(".mailbox  tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        }
    </script>
@endsection
