@extends('layouts.school.master')
@section('content')


<main class="page-content">
    <a class="btn btn-primary" style="float: right;margin-right:2%" href="{{route('token.reply.page')}}">Ticket List</a>
    <div class="container mt-5">
        <form action="{{route('token.create.post')}}" method="post" enctype="multipart/form-data">
            @csrf
            <h4 style="text-align: center;">Ticket information
            </h4>

            <div style="background-color:#9E00DE">
                <div class="row" style="padding: 1%;">

                    <div class="col-3">
                        <div style="background-color:white;margin-top: 15px;height:100%">
                            <h5 style="text-align: center;border-bottom: 1px solid gray;color:purple">Name</h5>
                            <h6 style="padding: 5%;"> {{$data1->school_name}}</h6>

                        </div>
                    </div>

                    <div class="col-3">
                        <div style="background-color:white;margin-top: 15px;height:100%">
                            <h5 style="text-align: center;border-bottom: 1px solid gray;color:purple">Email</h5>
                            <h6 style="padding: 5%;"> {{$data1->email}}</h6>

                        </div>
                    </div>




                    <div class="col-3">
                        <div style="background-color:white;margin-top: 15px;height:100%">
                            <h5 style="text-align: center;border-bottom: 1px solid gray;color:purple">Priority</h5>
                            <select class="form-control" name="priority" id="">
                                <option value="high">High</option>
                                <option value="medium">Medium</option>
                                <option value="low">Low</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-3">
                        <div style="background-color:white;margin-top: 15px;height:100%">
                            <h5 style="text-align: center;border-bottom: 1px solid gray;color:purple">Department</h5>

                            <select name="department_id" id="" class="form-control">
                                @foreach($data as $item)
                                <option value="{{$item->id}}">{{$item->department}}</option>

                                @endforeach
                            </select>

                        </div>
                    </div>

                </div>

                <h4 style="text-align: center; margin-top:30px;color:#ffffff">Message</h4>

                <div class=" card" style="border-radius:10px;background-color: #9E00DE;margin-right:15px;padding:2%">
                    <div class="card-body" style="color: #ffffff;">
                        <input style="margin-left:0%; margin-top:0px" class="form-control" placeholder="Subject" name="subject" type="text">

                        <label style="margin-top:20px" for="">Message</label>
                        <textarea name=" message" id="" style=" margin-top:10px" class="form-control" cols="30" rows="10"></textarea>
                    </div>
                </div>
            </div>
            <div class=" card" style="width:auto;height:auto;border-radius:10px;background-color: #9E00DE;margin-right:15px;margin-top:20px">
                <div class="card-body" style="color: #ffffff;">
                    <div class="row">
                        <div class="col-10">
                            <label for="">Attachement</label>
                            <input type="file" class="form-control" name="attachment" multiple>
                        </div>
                        <div class="col-2"> <button style="margin-top:20%;width:90%" class="btn btn-white" type="submit">Send</button>
                        </div>
                    </div>
                    <p style="margin-top: 10px;">Allowed File Extensions: .jpg, .gif, .jpeg, .png (Max file size: 128MB)</p>

                </div>
            </div>
    </div>
    </div>
    </div>
    <center>
        </form>

        </div>
        </div>



    







        @endsection