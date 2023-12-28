@extends('layouts.master')

@section('content')
    <style>
        .message-text {
            position: relative;
            background: #8a2be2;
            color: white;
            font-size: 15px;
            border-radius: 1.25rem;
            padding: 1rem 2.25rem;
            text-align: left;
            display: inline-block;
            max-width: 25rem;
        }

        .message-option {

            vertical-align: bottom;
            margin-top: -1.25rem;
            position: absolute;
        }

        .imgview {
            display: inline-block;
            vertical-align: top;
            margin-top: -1.25rem;
            margin-left: -20px;
        }

        .chat-footer {
            position: relative;
        }
    </style>
    <div class="container">
        <h1>School Activity Lists</h1>


        {{-- <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Subject</th>
                <th>URL</th>
                <th>Method</th>
                <th>Ip</th>
                <th width="300px">User Agent</th>
                <th>School Id</th>
                <th>Count</th>
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
                        <td>{{ $log->count }}</td>
                        <td><button class="btn btn-danger btn-sm">Delete</button></td>
                    </tr>
                @endforeach
            @endif
        </table> --}}

        <section style="background: #f5f5f5;padding-bottom:80px">
            <div class="container">

                <div class="col-4">
                    <div class="box">
                        <div class="card message-text" style="">
                            <p>fjl;dssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssssk</p>
                        </div>
                        <div class="message-option"style="">
                            <img src="\SchoolLogo\23574957.png" alt="" width="60" height="50"
                                style="border:6px solid #ffffff;border-radius:50%" class="imgview">
                            <p class="msg-time">9.10pm</p>
                        </div>

                    </div>

                </div>
                <div class="chat-footer">

                </div>
            </div>
        </section>


    </div>
@endsection
