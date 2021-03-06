@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Covid Test</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('covid-test.index') }}">Covid Test</a></li>
                        <li class="breadcrumb-item active">Add Data</li>
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
            <div class="row justify-content-center">
                <div class="col-6">
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Add Data</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            @if ($errors->any())
                                <div class="alert alert-danger alert-dismissible fade show">
                                    <strong>Whoops!</strong> There were some problems with your input.<br><br>
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            @endif
                            @if ($message = Session::get('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    {{ $message }}
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                            @endif
                            <form action="{{ route('covid-test.store') }}" method="POST">
                                @csrf
                                @foreach ($testcentres as $testcentre)
                                    @if($testcentre->centre_name==Auth::user()->centre_name)
                                        <input type="hidden" class="form-control" name="officer_name" id="officer_name" value="{{Auth::user()->name}}" required>
                                    @endif
                                @endforeach
                                <input type="hidden" class="form-control" name="test_date" id="test_date" value="{{ date('Y-m-d') }}" required>

                                <div class="form-group">
                                    <label for="patient_name">Patient <span class="text-danger">*</span></label>
                                    <select class="form-control" name="patient_name" id="patient_name" required>
                                        <option selected disabled value="">-- Patient Name --</option>
                                        @foreach ($user as $testcentres)
                                            @if($testcentres->centre_name==Auth::user()->centre_name)
                                                <option value="{{ $testcentres->name }}">{{ $testcentres->name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Test Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="" id="" value="{{ date('Y-m-d') }}" disabled>
                                </div>
                                <div class="form-group">
                                    <label for="test_name">Type Test <span class="text-danger">*</span></label>
                                    <select class="form-control" name="test_name" id="test_name" required>
                                        <option selected disabled value="">-- Type Test --</option>
                                        @foreach ($data as $testcentres)
                                            @if($testcentres->centre_name==Auth::user()->centre_name)
                                                <option value="{{ $testcentres->test_name }}">{{ $testcentres->test_name }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="symptoms">Symptoms <span class="text-danger">*</span></label>
                                    <textarea class="form-control @error('symptoms') is-invalid @enderror" name="symptoms" id="symptoms" required></textarea>
                                    @error('symptoms')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="result_date">Result Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control" name="result_date" id="resultdate" required>
                                </div>
                                <div class="form-group d-flex justify-content-between">
                                    <div>
                                        <a href="{{ route('covid-test.index') }}" class="btn btn-sm btn-default">Back</a>
                                    </div>
                                    <div>
                                        <button type="reset" class="btn btn-sm btn-default">Reset</button>
                                        <button type="submit" class="btn btn-sm btn-success">Save</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
@endsection

