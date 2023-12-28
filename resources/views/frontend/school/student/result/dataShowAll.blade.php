@extends('layouts.school.master')
@section('content')
<style>
    .list-group-item-action.active {
        background-color: #7500a7 !important;
        border-color: #7500a7
    }
    input{
        text-align: center;
    }
</style>
<main class="page-content">
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif
    <div class="row">
        <div class="col-xl-12">
            <div class="">
                <div class=" pt-4">
                    <div class="row justify-content-center">
                        <ul class="nav nav-tabs" id="myTabContent" role="tablist">
                            @foreach ($subjectName as $key => $tabName)
                            <li class="nav-item" role="presentation" style="padding: 5px;">
                                <a onclick="history.pushState({}, null, `${location.origin}${location.pathname}?selected_tab_key={{$key}}`)" class="list-group-item list-group-item-action {{ $key == (request('selected_tab_key') ? request('selected_tab_key') : 0) ? 'active' : '' }}" id="list-home-list" data-bs-toggle="list" href="#list-home{{ $tabName->id }}" role="tab" aria-controls="list-home">{{ $tabName->subject_name }}</a>
                            </li>
                            @endforeach
                        </ul>
                        <div class="tab-content" id="myTabContent">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="tab-content" id="nav-tabContent">
                                            @foreach ($subjectName as $key => $tabName)
                                            
                                            @php
                                                $students = getStudent($class_id, $section_id, $tabName->group_id, $tabName->subject_code);
                                            @endphp

                                            <div class="tab-pane fade {{ $key == (request('selected_tab_key') ? request('selected_tab_key') : 0) ? 'show active' : '' }}" id="list-home{{ $tabName->id }}" role="tabpanel" aria-labelledby="list-home-list">
                                                <div class="card">
                                                    <form method="post" action="{{ route('result.create.post') }}" enctype="multipart/form-data">
                                                        @csrf
                                                        <div class="card-body">
                                                            <div class="table-responsive" id="aaa">
                                                                <table id="example" class="text-center table table-striped table-bordered" style="width:100%">
                                                                    <thead>
                                                                        <tr>
                                                                            <th>Roll</th>
                                                                            <th>Student Name</th>
                                                                            @foreach ($markTypes as $markType)
                                                                            <th style="text-align: center;">
                                                                                <div class="row">
                                                                                    <div class="col-md-4">
                                                                                        <label for="">{{ $markType->mark_type == 'Class_Test' ? 'Class Test' : $markType->mark_type }}</label>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                            @endforeach
                                                                            <th>Total</th>
                                                                            <th>Grade</th>
                                                                            <th>GPA</th>
                                                                            <th>Action</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @if (count($markTypes) > 0)
                                                                        
                                                                        @foreach ($students as $key => $student)
                                                                            @php
                                                                                $student_attendances = get_present_absent($student->class_id, $student->id);
                                                                            @endphp
                                                                        <tr id="result{{ $student->id }}">
                                                                            @php
                                                                                $result = get_result($tabName->id, $termName->id, $student->id);
                                                                                $term_and_subject_wise_result = get_term_result($tabName->id, $termName->id, $student->id);
                                                                                $total_marks = 0;
                                                                            @endphp
                                                                            <td>{{ $student->roll_number }}</td>
                                                                            <td>
                                                                                <div class="cursor-pointer">
                                                                                    @if ($student->image != null && file_exists($student->image))
                                                                                    <img src="{{ asset($student->image) }}" class="rounded-circle" width="44" height="44" alt=" "> <br>
                                                                                    @else
                                                                                    @if ($student->gender == 'Female')
                                                                                    <img src="{{ asset('d/no-img-female.png') }}" class="rounded-circle" width="44" height="44" alt=" "> <br>
                                                                                    @else
                                                                                    <img src="{{ asset('d/no-img.png') }}" class="rounded-circle" width="44" height="44" alt=" "> <br>
                                                                                    @endif
                                                                                    @endif
                                                                                    <div class="">
                                                                                        <p class="mb-0">
                                                                                            {{ $student->name }}
                                                                                        </p>
                                                                                    </div>
                                                                                </div>
                                                                            </td>
                                                                            <input type="hidden" class="form-control" name="student_id[]" value="{{ $student->id }}">
                                                                            <input type="hidden" class="form-control" name="student_roll_number[]" value="{{ $student->roll_number }}">
                                                                            <input type="hidden" class="form-control" name="subject_id" value="{{ $tabName->id }}">
                                                                            <input type="hidden" class="form-control" name="term_id" value="{{ $termName->id }}">
                                                                            <input type="hidden" class="form-control" name="class_id" value="{{ $student->class_id }}">
                                                                            <input type="hidden" class="form-control" name="section_id" value="{{ $section_id }}">
                                                                            @foreach ($markTypes as $markType)
                                                                            <td>
                                                                                <div class="col-md-12">
                                                                                    @php
                                                                                        $marks = $result?->{strtolower($markType->mark_type)};
                                                                                        if(!empty($marks)) $total_marks += $marks;
                                                                                    @endphp

                                                                                    <!-- onkeyup="markValidation('{{ $student->id }}', '{{ $tabName->id }}', '{{ $termName?->all_subject_mark }}');" -->
                                                                                    <!-- This line will compress the number query (1320) -->
                                                                                    <input {{ $term_and_subject_wise_result?->absent == 1 ? '' : '' }} type="number" step="0.01" min="0" class="form-control input-mark{{ $student->id }}{{ $tabName->id }}"
                                                                                    onfocus="this.value == 0 ? this.value = '' : this.value = this.value"
                                                                                    onkeyup="markValidation('{{ $student->id }}', '{{ $tabName->id }}', '{{ subjectMark($termName->id, $student->class_id, $tabName->id) }}');" name="{{ $markType->mark_type }}[]" value="{{ $marks ?? 0 }}">
                                                                                </div>
                                                                            </td>
                                                                            @endforeach
                                                                            <td id="total_marks{{ $student->id }}{{ $tabName->id }}">
                                                                                {{ $total_marks }}
                                                                            </td>
                                                                            <td id="total_grade{{ $student->id }}{{ $tabName->id }}">
                                                                                {{ $result?->grade }}
                                                                            </td>
                                                                            <td id="total_gpa{{ $student->id }}{{ $tabName->id }}">
                                                                                {{ $result?->gpa }}
                                                                            </td>
                                                                            <td>
                                                                                @if ($term_and_subject_wise_result?->absent == 0)
                                                                                    <button 
                                                                                        id="absentBtn{{ $student->id }}{{ $tabName->id }}"
                                                                                        type="button" 
                                                                                        onclick="studentResultAbsent(event, '{{ $student->id }}', '{{ $student->roll_number }}', '{{ $student->class_id }}', '{{ $section_id }}', '{{ $tabName->id }}', '{{ $termName->id }}');"
                                                                                        class="btn btn-primary btn-sm">Absent</button>
                                                                                        <span id="absentText{{ $student->id }}{{ $tabName->id }}" style="display: none;" class="text-danger">
                                                                                            Absent
                                                                                        </span>
                                                                                @else
                                                                                    <span class="text-danger">
                                                                                        Absent
                                                                                    </span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        @endforeach
                                                                        @else
                                                                        <h4 class="text-center text-danger">First create mark types in this subject</h4>
                                                                        @endif
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                        <div class="d-flex justify-content-between mb-2" role="group" aria-label="First group">
                                                            <a href="{{ route('result.school.admin.create.show.all') }}" class="btn btn-info text-white ms-2">Back</a>
                                                            <button type="submit" id="resultUpdate{{ $tabName->id }}" class="btn btn-success primary-btn me-2">Update</button>
                                                        </div>
                                                    </form>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
</main>
@endsection

@push('js')

<script>
    function studentResultAbsent(event, student_id, student_roll_number, class_id, section_id, subject_id, term_id) {
        event.preventDefault();
        var data = {
            'student_id': student_id,
            'roll_number': student_roll_number,
            'class_id': class_id,
            'section_id': section_id,
            'subject_id': subject_id,
            'term_id': term_id
        };

        let absentBtn = document.getElementById(`absentBtn${student_id.toString()}${subject_id.toString()}`)
        let absentText = document.getElementById(`absentText${student_id.toString()}${subject_id.toString()}`)
        let totalMarks = document.getElementById(`total_marks${student_id.toString()}${subject_id.toString()}`)
        let totalGrade = document.getElementById(`total_grade${student_id.toString()}${subject_id.toString()}`)
        let totalGPA = document.getElementById(`total_gpa${student_id.toString()}${subject_id.toString()}`)

        $.ajax({
            type: "get",
            url: "{{ route('student.result.absent') }}",
            data: data,
            success: function(response) {
                if (response.status == 'success') {
                    
                    // Hridoy
                    absentBtn.style.display = 'none'
                    absentText.style.display = 'block'
                    totalMarks.textContent = 0
                    totalGrade.innerHTML = '<span class="text-danger">F</span>'
                    totalGPA.textContent = 0

                    let marktype_wise_marks = document.querySelectorAll(`.input-mark${student_id.toString()}${subject_id.toString()}`)
                    
                    for (let i = 0; i < marktype_wise_marks.length; i++) {
                        marktype_wise_marks[i].value = 0
                        // marktype_wise_marks[i].disabled = true
                    }
                    // Hridoy

                    Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'This student is absent in this subject.',
                        showConfirmButton: false,
                        timer: 1500
                    })
                }
            }
        });
    }

    function markValidation(studentId, subjectId, subjectMark) {
        var total = [];
        var studentId = ".input-mark" + studentId.toString() + subjectId.toString();

        $(studentId).each(function() {
            var mark = parseFloat($(this).val());
            total.push(mark);
        });

        let filteredArray = total.filter(function(num) {
            return !isNaN(num);
        });

        var sum = 0;
        for (let i = 0; i < filteredArray.length; i++) {
            sum += filteredArray[i];
        }

        if (sum > subjectMark || sum < 0) {
            // $(`#resultUpdate${subjectId}`).addClass('disabled');
            Swal.fire({
                icon: 'info',
                title: 'Please kindly input the accurate mark for your record.',
                text: `The mark obtained, ${sum}, exceeds the maximum and minimum possible score of ${subjectMark} and  0.`,
            })
        } else {
            // $(`#resultUpdate${subjectId}`).removeClass('disabled');
        }
    }
</script>

@endpush