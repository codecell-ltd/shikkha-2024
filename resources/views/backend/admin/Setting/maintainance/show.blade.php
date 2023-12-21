@extends('layouts.master')

@section('content')
    <div class="container mt-5">
        <div class="row  border-bottom white-bg dashboard-header">
            <div class="col-md-12">

                <div class="row wrapper border-bottom white-bg page-heading">
                    <div class="col-md-10">

                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">
                                <a href="{{ route('admin') }}">Admin</a>
                            </li>
                            <li class="breadcrumb-item active">
                                <strong>Panel</strong>
                            </li>
                        </ol>
                    </div>
                </div>

                <div class="col-md-12 d-flex justify-content-center" style="margin-top:20px;">
                    <div class="col-md-8">

                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-4">
                                        <h3 style="white-space: nowrap;">Set Under Maintainance:</h3>
                                    </div>
                                    <div class="col-8">
                                        <a href="{{ Route('admin.maintenance.set') }}"><button type="submit"
                                                class="btn btn-secondary">Site Down Except Test</button></a>
                                        <a href="{{ Route('admin.maintenance.reset') }}"><button type="submit"
                                                class="btn btn-primary"> Full Site Up</button></a>
                                        <a href="{{ Route('server.down') }}"><button type="submit" class="btn btn-danger">
                                                Full Site Down</button></a>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    {{-- <div class="container">
        <h1>Log Activity Lists</h1>
        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Subject</th>
                <th>URL</th>
                <th>Method</th>
                <th>Ip</th>
                <th width="300px">User Agent</th>
                <th>School Id</th>
                <th>Action</th>
            </tr>
            @if ($logs->count())
                @foreach ($logs as $key => $log)
                    <tr>
                        <td>{{ ++$key }}</td>
                        <td>{{ $log->subject }}</td>
                        <td class="text-success">{{ $log->url }}</td>
                        <td><label class="label label-info">{{ $log->method }}</label></td>
                        <td class="text-warning">{{ $log->ip }}</td>
                        <td class="text-danger">{{ $log->agent }}</td>
                        <td>{{ $log->school_id }}</td>
                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                    </tr>
                @endforeach
            @endif
        </table>
    </div> --}}
@endsection
