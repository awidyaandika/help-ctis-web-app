@extends('layouts.app')

@section('content')
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <!-- Small boxes (Stat box) -->
            <div class="row">
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            @foreach ($test_centre as $testcentre)
                                @if($testcentre->centre_name==Auth::user()->centre_name)
                                    <h3>{{ $testcentre->centre_name }}</h3>
                                @endif
                            @endforeach
                            <p>Test Centre</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-pin"></i>
                        </div>
                        <a href="{{ route('test-centre.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-success">
                        <div class="inner">
                            @foreach ($test_centre as $testcentre)
                                @if($testcentre->centre_name==Auth::user()->centre_name)
                                    <h3>{{ $test_kit }}</h3>
                                @endif
                            @endforeach

                            <p>Test Kit</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-medkit"></i>
                        </div>
                        <a href="{{ route('test-kit.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- ./col -->
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-warning">
                        <div class="inner">
                            @foreach ($test_centre as $testcentre)
                                @if($testcentre->centre_name==Auth::user()->centre_name)
                                    <h3>{{ $patient }}</h3>
                                @endif
                            @endforeach

                            <p>Patient</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-people"></i>
                        </div>
                        <a href="{{ route('patient.index') }}" class="small-box-footer">More info <i
                                class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <!-- small box -->
                    <div class="small-box bg-danger">
                        <div class="inner">
                            @foreach ($test_centre as $testcentre)
                                @if($testcentre->centre_name==Auth::user()->centre_name)
                                    <h3>{{ $covid_test }}</h3>
                                @endif
                            @endforeach

                            <p>Covid Test</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-android-people"></i>
                        </div>
                        @php
                            $tc = Auth::user()->centre_name;
                            $ct_patient = DB::table('users')->join('test_centres', 'users.centre_name', '=', 'test_centres.centre_name')
                                ->where( 'users.position', 'patient')
                                ->where('test_centres.centre_name', $tc)
                                ->count();
                        @endphp
                        @if($ct_patient > 0)
                            <a href="{{ route('covid-test.index') }}" class="small-box-footer">More info <i
                                    class="fas fa-arrow-circle-right"></i></a>
                        @endif
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
@endsection
