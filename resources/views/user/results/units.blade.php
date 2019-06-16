@extends('layouts.user')
@section('content')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h5>All Units</h5>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}"><span class="fa fa-home"></span></a>
                        </li>
                        <li class="breadcrumb-item active">Units</li>
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
                    @if(count($units))
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
                                Showing <strong>{{ count($units) }}</strong> records
                                of <strong>{{ $units->total() }}</strong></h3>
                            <ul class="pagination pagination-sm m-0 float-right">
                                {{ $units->links() }}
                            </ul>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="col-12 table-responsive">
                                <table class="table table-hover biz">
                                    <thead>
                                    <tr class="text-primary">
                                        <th>No</th>
                                        <th>Program</th>
                                        <th>Unit</th>
                                        <th>Taken</th>
                                        <th>Semester One</th>
                                        <th>Semester Two</th>
                                        <th>Registered On</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @php($count = 1)
                                    @foreach($units as $unit)
                                        <tr>
                                            <td>{{ $count++ }}</td>
                                            <td>{{ $unit->program->name }}</td>
                                            <td>{{ $unit->unit }}</td>
                                            <td>
                                                <button class="btn btn-success btn-sm" disabled><span
                                                        class="fa fa-check"></span>
                                                </button>
                                            </td>
                                            <td>
                                                @if($unit->semesterOne)
                                                    <button class="btn btn-success btn-sm" disabled><span
                                                            class="fa fa-check"></span>
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" disabled><span
                                                            class="fa fa-close"></span>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>
                                                @if($unit->semesterTwo)
                                                    <button class="btn btn-success btn-sm" disabled><span
                                                            class="fa fa-check"></span>
                                                    </button>
                                                @else
                                                    <button class="btn btn-danger btn-sm" disabled><span
                                                            class="fa fa-close"></span>
                                                    </button>
                                                @endif
                                            </td>
                                            <td>{{ date('F d, Y', strtotime($unit->created_at)) }}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                    <tfoot>
                                    <tr class="text-primary">
                                        <th>No</th>
                                        <th>Program</th>
                                        <th>Unit</th>
                                        <th>Taken</th>
                                        <th>Semester One</th>
                                        <th>Semester Two</th>
                                        <th>Registered On</th>
                                    </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="card-header no-print">
                                <h3 class="card-title pull-left">Showing <strong>{{ count($units) }}</strong>
                                    records
                                    of <strong>{{ $units->total() }}</strong></h3>
                                <ul class="pagination pagination-sm m-0 float-right">
                                    {{ $units->links() }}
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
                                <h4 class="text-danger">No Units Were Found</h4>
                                <hr>
                                <h6>
                                    <a href="{{ route('home') }}">
                                        <strong><span class="fa fa-home"></span></strong>
                                    </a>
                                </h6>
                                <hr>
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
