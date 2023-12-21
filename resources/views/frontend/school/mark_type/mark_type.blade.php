@extends('layouts.school.master')

@section('content')
    <!--start content-->
    <main class="page-content">

        <div class="d-flex mb-4 justify-content-between">
            {{-- <h4 class="text-primary">School mark type</h4>
            <div>
                <button class="btn btn-outline-primary" data-bs-target="#newSchoolMarkType" data-bs-toggle="modal"><i class="fa fa-plus"></i>New Mark Type</button>
            </div> --}}
        </div>

        <div class="row">
            <div class="col">
                <div class="card">
                    @if (count($classes) > 0)
                        <div class="card-header d-flex justify-content-between">
                            <h5>Select your class and Mark Type</h5>
                            {{-- <button class="btn btn-dark btn-sm" data-bs-toggle="modal" data-bs-target="#markTypeModal">Add Type</button> --}}
                            @if ($result_mark_setting == 2)
                                <button class="btn btn-outline-primary" data-bs-target="#newSchoolMarkType" data-bs-toggle="modal"><i class="fa fa-plus"></i>New Mark Type</button>
                             
                            @endif
                            
                        </div>
                        <div class="card-body">
                            @if(count($markType)== 0 && $result_mark_setting == 2)
                                <center>
                                    <h2>Please Add Mark Type First.</h2>
                                </center>
                            @elseif (count($markType)> 0 && $result_mark_setting == 2)

                                <form action="{{route('maunal.mark.type.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="resultSettingId" value="{{ $resultSettingId }}">
                                    <div class="row" id="doc">
                                        @foreach ($classes as $key => $class)
                                            @php
                                                $types = $class->manualmarkTypes->pluck('mark_type', 'id')->toArray();
                                                
                                            @endphp
                        {{-- @dd($types) --}}
                                            <div class="col mb-3 a" id="customerServices">
                                                <div class="form-check in">
                                                    <input type="checkbox" name="class[]" value="{{$class['id']}}" onchange="selectSubjects('{{$key}}')" {{ $class->markTypes()->where('institute_classes_id', $class->id)->count() ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="check{{$key}}"><b>{{$class['class_name']}}</b></label>
                                                </div>
                                                
                                                {{-- <div class="ms-3"> --}}

                                                    <div class="form-check ms-3" id="apnd">
                                                        {{-- <span type="hidden" id="dataKey" data-key="{{ $key }}"></span> --}}
                                                        @foreach ($markType as $item)
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="{{$item->id}}" name="subjects[{{ $class['id'] }}][]" {{ in_array($item->id, $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">{{$item->type_name}}</label> <br>
                                                        @endforeach
                                                        
                                                    </div>

                                                {{-- </div> --}}
                                            </div>

                                            @if($key == 3 || $key == 7 || $key == 11 || $key == 15)
                                            <div class="col-12"></div>
                                            @endif

                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn-sm btn-outline-primary text-right" style="margin: 50px;">Next</button>
                                    </div>
                                </form>
                                
                            @else
                                <form action="{{route('mark.type.store')}}" method="POST">
                                    @csrf
                                    <input type="hidden" name="resultSettingId" value="{{ $resultSettingId }}">
                                    <div class="row" id="doc">
                                        @foreach ($classes as $key => $class)
                                            @php
                                                $types = $class->markTypes->pluck('mark_type', 'id')->toArray();
                                            @endphp

                                            <div class="col mb-3 a" id="customerServices">
                                                <div class="form-check in">
                                                    <input type="checkbox" name="class[]" value="{{$class['id']}}" onchange="selectSubjects('{{$key}}')" {{ $class->markTypes()->where('institute_classes_id', $class->id)->count() ? 'checked' : '' }} >
                                                    <label class="form-check-label" for="check{{$key}}"><b>{{$class['class_name']}}</b></label>
                                                </div>
                                                
                                                {{-- <div class="ms-3"> --}}

                                                    <div class="form-check ms-3" id="apnd">
                                                        {{-- <span type="hidden" id="dataKey" data-key="{{ $key }}"></span> --}}
                                                        @if ($result_mark_setting == 1)
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Attendance" name="subjects[{{ $class['id'] }}][]" {{ in_array('Attendance', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Attendance</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Assignment" name="subjects[{{ $class['id'] }}][]" {{ in_array('Assignment', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Assignment</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Class_Test" name="subjects[{{ $class['id'] }}][]" {{ in_array('Class_Test', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Class Test</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Presentation" name="subjects[{{ $class['id'] }}][]" {{ in_array('Presentation', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Presentation</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Quiz" name="subjects[{{ $class['id'] }}][]" {{ in_array('Quiz', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Quiz</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Practical" name="subjects[{{ $class['id'] }}][]" {{ in_array('Practical', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Practical</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="MCQ" name="subjects[{{ $class['id'] }}][]" {{ in_array('MCQ', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">MCQ</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Written" name="subjects[{{ $class['id'] }}][]" {{ in_array('Written', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Written</label> <br>
                                                            
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="HandWriting" name="subjects[{{ $class['id'] }}][]" {{ in_array('HandWriting', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">HandWriting</label> <br>
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Midterm" name="subjects[{{ $class['id'] }}][]" {{ in_array('Midterm', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Midterm</label> <br>
                                 
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Semester" name="subjects[{{ $class['id'] }}][]" {{ in_array('Semester', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Semester</label> <br>

                                                            <input type="checkbox" class="subject-check-{{$key}}" value="UniForm" name="subjects[{{ $class['id'] }}][]" {{ in_array('UniForm', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">UniForm</label> <br>
                                                            
                                                        
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="PayNumber" name="subjects[{{ $class['id'] }}][]" {{ in_array('PayNumber', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Pay Number</label> <br>
 
                                                            <input type="checkbox" class="subject-check-{{$key}}" value="Others" name="subjects[{{ $class['id'] }}][]" {{ in_array('Others', $types) ? "checked" : ''  }}>
                                                            <label class="form-check-label" for="subject{{$key}}">Others</label> <br>
                                                        
                                                        @endif
                                                        
                                                        
                                                    </div>

                                                {{-- </div> --}}
                                            </div>

                                            @if($key == 3 || $key == 7 || $key == 11 || $key == 15)
                                            <div class="col-12"></div>
                                            @endif

                                        @endforeach
                                    </div>
                                    <div class="d-flex justify-content-end">
                                        <button type="submit" class="btn-sm btn-outline-primary text-right" style="margin: 50px;">Next</button>
                                    </div>
                                </form>

                            @endif
                            
                        </div>
                    @else
                        <div class="card-body">
                            <div class="text-center">
                                <h3>Ensure that. First Create Class</h3>
                                <a href="{{ route("settings") }}" class="btn btn-primary">Jump to create class</a>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        
    </main>

    <div class="modal fade" id="newSchoolMarkType" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content bg-primary text-white">
                <div class="modal-header">
                    <h4 class="modal-title">Create School Mark Type</h4>
                    <button class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form onsubmit="markTypeCreate(event)" id="feesTypeCreate">
                        @csrf

                        <div class="form-group mb-3">
                            <label for="">Mark Type</label>
                            <input type="text" id="type_name" name="type_name" class="form-control">
                        </div>

                        <button class="btn btn-outline-light" id="feesTypeCreateBtn">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')

    <script>
        function selectSubjects(key)
        {
            if($(".subject-check-"+key).is(':checked'))
            {
                $(".subject-check-"+key).prop('checked', false);
            }
            else
            {
                $(".subject-check-"+key).prop('checked', true);
            }
        }
    </script>

    <script>
        let markTypeCreate = (e) => {
            // e.preventDefault();
            // alert("Hi");

            let type_name = $("#type_name").val();

            $.ajax({
                url: "{{route('school.mark.type.create')}}",
                type: "POST",
                data:{
                    '_token':'{{csrf_token()}}',
                    type_name : type_name,
                },
                
                success: (resp) => {
                    toastr.success("Record created successfully");
                },
                error: (error) => {

                    Swal.fire({
                        icon: 'error',
                        title: 'Server Error',
                        text: error.responseJSON.message,
                    });
                }
            });
        }
    </script>

@endpush
