@extends('layouts.print')
@section('print')
    <div class="wrapper">
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">
                        <!-- Main content -->
                        <div class="invoice p-3 mb-3">
                            <!-- title row -->
                            <div class="row">
                                <div class="col-12">
                                    <center>
                                        <h2 class="page-header">
                                            <a href="{{ env('APP_URL') }}" target="_blank"><i><img
                                                        src="{{ asset('img/logo.png') }}"
                                                        style="width: 200px;!important;"
                                                        alt=""></i></a>
                                        </h2>
                                    </center>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- info row -->
                            <div class="row invoice-info">
                                <div class="col-sm-4 invoice-col">
                                    From
                                    <address>
                                        <strong>{{ config('app.name') }}.</strong><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    To
                                    <address>
                                        <strong>{{ auth()->user()->name }}</strong><br>
                                    </address>
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-4 invoice-col">
                                    <b>Reg.no <i
                                            class="text-primary">{{ auth()->user()->registrationNumber }}</i></b><br>
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <h4 class="text-primary text-danger"><b>SEMESTER ONE RESULTS</b></h4>
                                <div class="col-12 table-responsive">
                                    @if(count($ones))
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Program</th>
                                                <th>Unit</th>
                                                <th>Cat One</th>
                                                <th>Cat Two</th>
                                                <th>Main Exam</th>
                                                <th>Grade</th>
                                                <th>Date/Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($ones as $result)
                                                <tr>
                                                    <td>{{ $result->unit->program->name }}</td>
                                                    <td>{{ $result->unit->unit }}</td>
                                                    <td>{{ number_format($result->catOne) }}</td>
                                                    <td>{{ number_format($result->catTwo) }}</td>
                                                    <td>{{ number_format($result->mainExam) }}</td>
                                                    <td>
                                                        <button
                                                            class="btn btn-default">{{ \App\Http\Controllers\SystemController::getGrade($result->average) }}</button>
                                                    </td>
                                                    <td>{{ date('F d, Y H:i a', strtotime($result->updated_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <center>
                                            <h1 class="text-danger">No Semester One Results Were Found</h1>
                                        </center>
                                    @endif
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- Table row -->
                            <div class="row">
                                <h4 class="text-primary text-danger"><b>SEMESTER TWO RESULTS</b></h4>
                                <div class="col-12 table-responsive">
                                    @if(count($twos))
                                        <table class="table table-striped">
                                            <thead>
                                            <tr>
                                                <th>Program</th>
                                                <th>Unit</th>
                                                <th>Cat One</th>
                                                <th>Cat Two</th>
                                                <th>Main Exam</th>
                                                <th>Grade</th>
                                                <th>Date/Time</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            @foreach($twos as $result)
                                                <tr>
                                                    <td>{{ $result->unit->program->name }}</td>
                                                    <td>{{ $result->unit->unit }}</td>
                                                    <td>{{ number_format($result->catOne) }}</td>
                                                    <td>{{ number_format($result->catTwo) }}</td>
                                                    <td>{{ number_format($result->mainExam) }}</td>
                                                    <td>
                                                        <button
                                                            class="btn btn-default">{{ \App\Http\Controllers\SystemController::getGrade($result->average) }}</button>
                                                    </td>
                                                    <td>{{ date('F d, Y H:i a', strtotime($result->updated_at)) }}</td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    @else
                                        <center>
                                            <h1 class="text-danger">No Semester TWO Results Were Found</h1>
                                        </center>
                                    @endif
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <!-- this row will not appear when printing -->
                            <div class="row no-print">
                                <div class="col-12">
                                    <a href="invoice-print.html" target="_blank" class="btn btn-primary pull-right"><i
                                            class="fa fa-print"></i> Print</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.invoice -->
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </section>
    </div>
@endsection
