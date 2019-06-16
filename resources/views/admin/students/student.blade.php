@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>All Students</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.home') }}"><span class="fa fa-home"></span></a>
                        </li>
                        <li class="breadcrumb-item active">Students</li>
                    </ol>
                </div>
            </div>
            <hr>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content-header -->
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                @include('inc.alert')
                <div class="card">
                    @if(count($students))
                        <br>
                        <div class="card-header no-print">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="text" onkeyup="myFunction()"
                                           placeholder="Search..."
                                           title="Type to search..."
                                           class="form-control tableInput">
                                </div>
                            </div>
                            <br>
                            <h3 class="card-title pull-left">
                                Showing <strong>{{ count($students) }}</strong> records
                                of <strong>{{ $students->total() }}</strong></h3>
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $students->links() }}
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-12 table-responsive">
                                <table class="table table-hover">
                                    <thead>
                                    <tr class="text-primary">
                                        <th>#</th>
                                        <th>Program</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reg. No</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                        <th>Created At</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($count =1)
                                    @foreach($students as $student)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $student->program->name }}</td>
                                            <td>{{ $student->name }}</td>
                                            <td>{{ $student->email }}</td>
                                            <td>{{ $student->registrationNumber }}</td>
                                            <td>{{ $student->phoneNumber }}</td>
                                            <td>
                                                @if($student->program_verified)
                                                    <a href="#" class="btn btn-success disabled">Activated</a>
                                                @else
                                                    <a href="{{ route('verify',['id'=>$student->id]) }}"
                                                       class="btn btn-primary">Activate Program</a>
                                                @endif
                                            </td>
                                            <td>{{ date('F d, Y H:i a', strtotime($student->updated_at)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="text-primary">
                                        <th>#</th>
                                        <th>Program</th>
                                        <th>Name</th>
                                        <th>Email</th>
                                        <th>Reg. No</th>
                                        <th>Phone Number</th>
                                        <th>Action</th>
                                        <th>Created At</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="card-header no-print">
                                <h3 class="card-title pull-left">Showing <strong>{{ count($students) }}</strong>
                                    records
                                    of <strong>{{ $students->total() }}</strong></h3>
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $students->links() }}
                                </ul>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    @else
                        <center>
                            <div class="col-md-6">
                                <br>
                                <br>
                                <br>
                                <h4 class="text-danger">No Students Were Found</h4>
                                <h6>
                                    <hr>
                                    <a href="{{ route('admin.home') }}">
                                        <strong><span class="fa fa-home"></span></strong>
                                    </a>
                                    <hr>
                                </h6>
                                <br>
                                <br>
                                <br>
                            </div>
                        </center>
                    @endif
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
@endsection


@section('scripts')
    <script>
        function myFunction() {
            $(document).ready(function () {
                $(".tableInput").on("keyup", function () {
                    var value = $(this).val().toLowerCase();
                    $(".biz  tr").filter(function () {
                        $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                    });
                });
            });
        }
    </script>
@endsection
