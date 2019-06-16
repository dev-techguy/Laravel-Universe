@extends('layouts.admin')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>Students Semester One Marks</h5>
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
                    @if(count($ones))
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
                                Showing <strong>{{ count($ones) }}</strong> records
                                of <strong>{{ $ones->total() }}</strong></h3>
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $ones->links() }}
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-12 table-responsive">
                                <form action="{{ route('semester.one') }}" method="post">
                                    @csrf
                                    <table class="table table-hover">
                                        <thead>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>Unit</th>
                                            <th>Reg. No</th>
                                            <th>Cat One</th>
                                            <th>Cat Two</th>
                                            <th>Main Exam</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($count =1)
                                        @foreach($ones as $one)
                                            <tr>
                                                <td>{{ $count++ }}</td>
                                                <td>{{ $one->unit->unit }}</td>
                                                <td>{{ $one->user->registrationNumber }}</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="user_id[]" id="user_id"
                                                               value="{{ $one->user_id }}">
                                                        <input type="number" name="catOne[]" id="catOne" required
                                                               class="form-control" value="{{ $one->catOne }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" name="catTwo[]" id="catTwo" required
                                                               class="form-control" value="{{ $one->catTwo }}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" name="mainExam[]" id="mainExam" required
                                                               class="form-control" value="{{ $one->mainExam }}">
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                                <td>
                                                    <button type="submit" class="btn btn-primary pull-right">Update
                                                        Semester One
                                                        Marks
                                                    </button>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                        <tfoot>
                                        <tr class="text-primary">
                                            <th>#</th>
                                            <th>Unit</th>
                                            <th>Reg. No</th>
                                            <th>Cat One</th>
                                            <th>Cat Two</th>
                                            <th>Main Exam</th>
                                        </tr>
                                        </tfoot>
                                    </table>
                                </form>
                            </div>
                            <div class="card-header no-print">
                                <h3 class="card-title pull-left">Showing <strong>{{ count($ones) }}</strong>
                                    records
                                    of <strong>{{ $ones->total() }}</strong></h3>
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $ones->links() }}
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
                                <h4 class="text-danger">No Marks Were Found</h4>
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
