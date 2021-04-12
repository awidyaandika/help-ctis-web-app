@extends('layouts.app')

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Dashboard</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Centre Officer</a></li>
                        <li class="breadcrumb-item active">View Centre Officer</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            @if ($message = Session::get('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ $message }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            @endif
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between flex-wrap align-items-center">
                        <h3 class="card-title">List of Centre Officer</h3>
                        <a href="{{ route('centre-officer.create') }}" class="btn btn-sm btn-primary">Add Data</a>
                    </div>
                </div>

                <!-- /.card-header -->
                <div class="card-body">
                    <table id="example1" class="table table-bordered table-striped">
                        <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($centreofficers as $centreofficer)
                            @if($centreofficer->centre_name==Auth::user()->centre_name)
                                <tr>
                                    <td>{{ ++$i }}</td>
                                    <td>{{ $centreofficer->username}}</td>
                                    <td>{{ $centreofficer->name}}</td>
                                    <td>{{ $centreofficer->email}}</td>
                                    <td>{{ $centreofficer->phone}}</td>
                                    <td>
                                        <form action="{{route('centre-officer.destroy', $centreofficer->id)}}" method="POST">
                                            <input name="_method" type="hidden" value="DELETE">
                                            <a class="btn btn-info btn-sm" href="{{ route('centre-officer.show', $centreofficer->id) }}"><i class="nav-icon fas fa-eye"></i></a>
                                            <a class="btn btn-warning btn-sm" href="{{ route('centre-officer.edit', $centreofficer->id) }}"><i class="nav-icon fas fa-edit"></i></a>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')"><i class="nav-icon fas fa-trash-alt"></i></button>
                                        </form>
                                    </td>
                                </tr>
                            @endif
                        @endforeach
                        </tbody>
                        <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Action</th>
                        </tr>
                        </tfoot>
                    </table>
                    {!! $centreofficers->links() !!}
                </div>
            </div>
        </div>
    </section>

@endsection