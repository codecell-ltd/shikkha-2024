@extends('layouts.school.master')

@section('content')

    <!--start content-->
    <main class="page-content">
        <h3 class="mt-5 mb-3 text-center text-primary">See Result</h3>
        <div class="row">
            <div class="col-xl-6 mx-auto">
                <div class="card" style="box-shadow:4px 3px 13px  .7px #bc53ed;border-radius:5px">
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" method="post" action="{{route('show.class.wise.result')}}" target="_blank" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    @include('frontend.layouts.message')
                                </div>

                                <div class="col-12 mb-3">
                                    <label class="select-form">Select Result Type</label>
                                    <select class="form-control js-select" name="resultType" id="resultType" onchange="showResultForm()" >
                                        <option value="" selected>Select Result Type</option>
                                        <option value="classWise">Class Wise Result</option>
                                        <option value="studentWise">Student Wise Result</option>
                                        <option value="yearlyFinalResult">Annual Result</option>
                                    </select>
                                </div>

                                <div class="d-none" id="showClassWiseForm">
                                    <div class="col-12 mb-3">
                                        <label class="select-form">{{__('app.class')}}</label>
                                        <select class="form-control mb-3 js-select" name="class_wise_class_id" id="class_wise_class_id">
                                            <option value="" selected>Select Class</option>
                                            @foreach($class as $data)
                                                <option value="{{$data->id}}">{{$data->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="select-form">Term Name</label>
                                        <select class="form-control mb-3 js-select" id="class_wise_term_id" name="class_wise_term_id">
                                            <option value="" selected>Select Term</option>
                                            @foreach($terms as $term)
                                                {{-- <option value="{{$term->id}}">{{$term->term_name}}</option> --}}
                                                <option value="{{$term->id}}">{{$term->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="d-none" id="showstudentWiseForm">
                                    <div class="col-12 mb-3">
                                        <label class="select-form">Term Name</label>
                                        <select class="form-control mb-3 js-select" id="student_wise_term_id" name="student_wise_term_id">
                                            <option value="" selected>Select Term</option>
                                            @foreach($terms as $term)
                                                {{-- <option value="{{$term->id}}">{{$term->term_name}}</option> --}}
                                                <option value="{{$term->id}}">{{$term->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-3">
                                        <label class="select-form">{{__('app.class')}}</label>
                                        <select class="form-control mb-3 js-select" name="student_wise_class_id" id="student_wise_class_id" onchange="classLoadSection()">
                                            <option value="" selected>Select Class</option>
                                            @foreach($class as $data)
                                                <option value="{{$data->id}}">{{$data->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    {{-- <div class="col-12 mb-3">
                                        <label>{{__('app.Section')}} {{__('app.Name')}} <span style="color:red;"></span></label>
                                        <select class="form-control mb-3 js-select"id="student_wise_section_id" name="section_id">
                                            <option selected>Select one</option>
                                         </select>
                                    </div> --}}

                                    <div class="col-12 mb-3">
                                        <label class="select-form">Student Name</label>
                                        <select class="form-control js-select" onload="showNoticeModal($(this).val());" id="student_wise_student_id" name="student_wise_student_id" >
                                            <option value="" selected>Select Student</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="d-none" id="showFinalResultForm">
                                    <div class="col-12 mb-3">
                                        <label class="select-form">Class Name</label>
                                        <select class="form-control js-select" name="final_wise_class_id" id="final_wise_class_id" onchange="finalclassLoadSection()">
                                            <option value="" selected>Select Class</option>
                                            @foreach($class as $data)
                                                <option value="{{$data->id}}">{{$data->class_name}}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="col-12 mb-4">
                                        <label class="">Select Term</label> <br>
                                        @foreach ($terms as $term)
                                        <div class="form-check form-check-inline">
                                            <input checked class="form-check-input" type="checkbox" name="resultSetting[]" id="resultSetting{{ $term->id }}" value="{{ $term->id }}">
                                            <label class="form-check-label" for="resultSetting{{ $term->id }}">{{ $term->title }}</label>
                                        </div>
                                        @endforeach
                                    </div>

                                    <div class="col-12 mb-4 d-none" id="resultPrintType" onchange="tryToPrintAll(this)">
                                        <label>Select Type: </label>
                                        <div class="form-check form-check-inline">
                                            <input type="radio" name="result_type" checked value="student_wise"> Student wise
                                            <input type="radio" name="result_type" value="all_student"> All Student
                                        </div>
                                    </div>

                                    <div class="col-12 mb-3" id="studentSelectPart">
                                        <label class="select-form">Student Name</label>
                                        <select class="form-control js-select" id="final_student_wise_student_id"  name="final_student_wise_student_id">
                                            <option value="" selected>Select Student</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Show Result</button>
                                    </div>
                                </div>

                                {{-- <div class="col-12">
                                    <div class="d-grid">
                                        <button type="button" class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="lni lni-youtube"></i> Tutorial</button>
                                    </div>
                                </div> --}}
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </main>
    <?php
    $tutorialShow = getTutorial('assign-teacher');
    ?>
    @include('frontend.partials.tutorial')

{{-- Attendance Notice Modal Start --}}
    <div class="modal fade" id="attendanceUpdateNotice" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Attendance Update</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <h4>Please update this student working, present, absent days. Otherwise this student don't get proper position.</h4>
                <h5>How To Update Student Information:</h5>
                <ol type="1">
                    <li>Go to custom attendance. <a href="{{ route('input.attendance') }}">Custom Attendance{{ "(Click Here)" }}</a></li>
                    <li>Click pencil icon button.</li>
                    <li>Select Term.</li>
                    <li>Input working, present, absent days. Then click save button</li>
                </ol>
            </div>
        </div>
        </div>
    </div>
{{-- Attendance Notice Modal End --}}
@endsection

@push('js')
     <script>
        function showResultForm()
        {   
           var formType = $("#resultType").val();

            // Hridoy
            $("#resultPrintType").addClass('d-none');

            if (formType == "classWise") {
                $("#showClassWiseForm").removeClass('d-none');
                $("#showstudentWiseForm").addClass('d-none');
                $("#showFinalResultForm").addClass('d-none');
            } else if (formType == 'yearlyFinalResult') {
                $("#showClassWiseForm").addClass('d-none');
                $("#showFinalResultForm").removeClass('d-none');
                    $("#showstudentWiseForm").addClass('d-none');
            }
            else {
                $("#showClassWiseForm").addClass('d-none');
                $("#showFinalResultForm").addClass('d-none');
                    $("#showstudentWiseForm").removeClass('d-none');
            }
        }

        function classLoadSection()
        {
            var class_id = $("#student_wise_class_id").val();

            $.ajax({
                url:'{{route('class.wise.user')}}',
                method:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    class_id:class_id
                },

                success: function (data) {
                    $("#student_wise_student_id").empty();
                    $.each(data, function (section_name, students) {
                        var option = `<optgroup label="${section_name}">`;
                            $.each(students, function (student_id, student_name){
                                option += `<option value="${student_id}">${student_name}</option>`;
                            });
                         $("#student_wise_student_id").append(option);
                            option += "</optgroup>";
                    });
                }
            });

            $.ajax({
                url:'{{route('admin.show.section')}}',
                method:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    class_id:class_id
                },

                success: function (response) {

                    $('#section_id').html(response.html);

                }
            });

        }
        function finalclassLoadSection()
        {
            var class_id = $("#final_wise_class_id").val();

            $.ajax({
                url:'{{route('class.wise.user')}}',
                method:'POST',
                data:{
                    '_token':'{{csrf_token()}}',
                    class_id:class_id
                },

                success: function (data) {
                    
                    // Hridoy
                    $("#resultPrintType").removeClass('d-none');

                    $("#final_student_wise_student_id").empty();
                    $.each(data, function (section_name, students) {
                        var option = `<optgroup label="${section_name}">`;
                            $.each(students, function(student_id, student_name){
                                option += `<option value="${student_id}">${student_name}</option>`;
                            });
                         $("#final_student_wise_student_id").append(option);
                            option += "</optgroup>";
                    });
                }
            });
        }

        // Hridoy
        function tryToPrintAll(current) {
            if(document.querySelector("input[type='radio'][name=result_type]:checked").value == 'all_student') $("#studentSelectPart").addClass('d-none')
            else $("#studentSelectPart").removeClass('d-none')
        }
    </script>
@endpush
