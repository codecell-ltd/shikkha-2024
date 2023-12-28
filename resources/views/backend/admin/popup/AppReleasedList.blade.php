@extends('layouts.master')

@section('content')
<div class="container mt-5">
    <div class="row  border-bottom white-bg dashboard-header">
        <div class="col-md-12">

            <div class="row wrapper border-bottom white-bg page-heading">
                <div class="col-md-10">
                   <center> <h1>App Released</h1></center>
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{route('admin')}}">Admin</a>
                        </li>
                        <li class="breadcrumb-item active">
                            <strong>List</strong>
                        </li>
                    </ol>
                </div>
                <div class="col-md-2">
                      <a href="{{route('AppReleased')}}" class="btn btn-success">Create</a>
                </div>
            </div>

            <div class="wrapper wrapper-content animated fadeInRight">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ibox ">

                            <div class="ibox-content">
                                <div class="table-responsive">
                                    <table class="table table-striped table-bordered table-hover dataTables-example">
                                        <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Version</th>
                                            <th>Note</th>
                                            <th>Time</th>
                                            <th >Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($appreleased as $data)
                                            <tr>
                                                <td>{{$data->id}}</td>
                                                <td>{{$data->version}}</td>
                                                <td>{!!$data->note!!}</td>
                                                <td>{{$data->created_at}}</td>
                                                <td>
                                                    <a href="{{route('AppReleased.Edit',$data->id)}}" onclick="" class="btn btn-primary"><i class="bi bi-pencil-square"></i>
                                                    </a>

                                                <a href="javascript::"
                                                    onclick="if(confirm('Are your sure? Do you want to delete?')){ location.replace('{{route('AppReleased.Delete',$data->id)}}') }"
                                                    class="btn btn-danger"><i class="bi bi-trash3"></i>
                                                </a>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        // When the user clicks on <div>, open the popup
        function myFunction() {
          var popup = document.getElementById("myPopup");
          popup.classList.toggle("show");
        }
        </script>
@endsection