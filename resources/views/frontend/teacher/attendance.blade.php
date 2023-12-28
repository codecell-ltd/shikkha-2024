@extends('layouts.school.master')

@section('content')

    <main class="page-content">
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card">
                </div>
            </div>
        </div>
        @if(count($dataAtt) == count($dataUser))
            <div class="row">
                <div class="col-xl-12">

                    <div class="card">
                        <form method="post" action="{{route('teacher.result.create.post')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Roll</th>
                                            <th>Student Name</th>                                            
                                            <th>Attendance</th>
                                            <th>Comment</th>
                                            <th>Action</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($dataAtt as $key => $data)
                                            <tr>
                                                <td>{{getUserNameForAll($data->student_id)->roll_number}}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                        <img src="{{asset(getUserNameForAll($data->student_id)->image )}}" class="rounded-circle" width="44" height="44" alt="">
                                                        <div class="">
                                                            <p class="mb-0">{{getUserNameForAll($data->student_id)->name}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>{{($data->attendance == 0) ? 'Absent' : 'Present'}}</td>
                                                <td>{{ $data->comment }}</td>
                                                <td><form method="post" action="{{route('teacher.confirm.absent.present',$data->id)}}" enctype="multipart/form-data">
                                                        @csrf
                                                        @if($data->attendance == 1)
                                                            <input type="hidden" name="attendance" value="0">
                                                            <button type="submit" class="btn btn-primary">Make It Absent</button>
                                                        @else
                                                            <input type="hidden" name="attendance" value="1">
                                                            <button type="submit" class="btn btn-danger">Make It Present</button>
                                                        @endif
                                                    </form></td>
                                            </tr>


                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
        @else
            <div class="row">
                <div class="col-xl-12">

                    <div class="card">
                        <form method="post" action="{{route('teacher.attendance.create.post')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">

                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                                        <thead>
                                        <tr>
                                            <th>Roll</th>
                                            <th>Student Name</th>
                                            {{-- <th>Student Roll Number</th> --}}
                                            <th>Attendance</th>
                                            {{-- <th>Comment</th> --}}
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @foreach($dataUser as $key => $data)
                                            <tr>
                                                {{-- <td>{{$key++ +1}}</td> --}}
                                                <td>{{$data->roll_number}}</td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-3 cursor-pointer">
                                                        <img src="{{asset( $data->image) }}" class="rounded-circle" width="44" height="44" alt="">
                                                        <div class="">
                                                            <p class="mb-0">{{$data->name}}</p>
                                                        </div>
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    @php
                                                        $hasPresent = getAttendance($data->id, $data->class_id, $data->section_id, date('Y-m-d'));
                                                    @endphp
                                                    <input class="form-check-input" type="radio" id="present-{{$data->id}}" name="attendance[{{$data->id}}][]" value="1" @if($hasPresent == 1 || $hasPresent == "NO") checked @endif />
                                                    <label class="form-check-label" for="present-{{$data->id}}">
                                                        Present
                                                    </label>
                                                    <input class="form-check-input" type="radio" id="absent-{{$data->id}}" name="attendance[{{$data->id}}][]" value="0" @if($hasPresent == 0) checked @endif>
                                                    <label class="form-check-label" for="absent-{{$data->id}}">
                                                        Absent
                                                    </label>
                                                    <input class="form-check-input" type="radio" id="late-{{$data->id}}" name="attendance[{{$data->id}}][]" value="2" @if($hasPresent == 2) checked @endif>
                                                    <label class="form-check-label" for="late-{{$data->id}}">
                                                        late
                                                    </label>
                                                    <input type="hidden" name="student_id[]" value="{{$data->id}}">
                                                </td>
                                                {{-- <td><input class="form-control" name="comment[]" placeholder="Give a Comment"></td> --}}
                                            </tr>


                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <div class="btn-group mr-2" role="group" aria-label="First group" style="margin-top: -60px;">
                                    <button  type="submit" class="btn btn-success">update</button>
                                </div>
                            </div>
                            
                        </form>
                    </div>

                </div>
            </div>
        @endif

    </main>

@endsection
