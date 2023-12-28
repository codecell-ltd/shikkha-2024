@extends('layouts.school.master')

@section('content')
<!--start content-->
<main class="page-content">
    <div class="row">
        {{-- <div class="ms-auto">
                <button class="btn btn-success" onclick="printDiv()">Print</button>
                <button class="btn-primary btn-sm" title="{{__('app.Print')}}" onclick="printDiv()"><i class="bi bi-printer"></i></button>
    </div> --}}
    <div class="card-header py-3 bg-transparent">
        <div class="d-sm-flex align-items-center">
            <h5 class="mb-2 mb-sm-0">{{__('app.Student')}} {{__('app.Result')}}</h5>
            <div class="ms-auto">
                <button class="btn-primary btn-sm" title="{{__('app.Print')}}" onclick="printDiv()"><i class="bi bi-printer"> Print</i></button>
            </div>
        </div>
    </div>
    <div class="col-xl mx-auto">
        <div class="card text-dark">
            <div class="card-body" id="printDiv">
                <div class="border border-dark p-3 rounded">
                    <div class="d-flex justify-content-center">
                        @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                        <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:100px; height:100px;margin-right:10px;">
                        @endif
                        <div class="text-center">
                            <h3 style="margin-bottom: 0px;"> {{ strtoupper(authUser()->school_name) }} </h3>
                            <p style="margin-bottom: 0px;"> <b>{{ authUser()->slogan != null ? '('.authUser()->slogan.')': ""}}</b> </p>
                            <p style="margin-bottom: 0px;"> {{ authUser()->address }} </p>
                            <h5>{{ $term->title }}</h5>
                        </div>
                    </div>

                    <hr style="margin-top: 0px;">

                    <div class="d-flex mb-2 justify-content-between">
                        @if(File::exists(public_path($studentResults->first()->user?->image)))
                        <img src="{{asset($studentResults->first()->user?->image)}}" class="img-fluid" alt="student image" style="height: 100px; width: 80px">
                        @else
                        <img src="{{asset('d/no-img.jpg')}}" class="img-fluid" alt="student image" style="height: 60px; width: 60px">
                        @endif

                        <div class="h6 col-md-3" style="font-size: 12px;">
                            <table style="border-color: black;">
                                <tbody>
                                    <tr>
                                        <td>Student Name</td>
                                        <td>: {{ strtoupper($studentResults->first()->user?->name) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Father Name</td>
                                        <td>: {{ strtoupper($studentResults->first()->user?->father_name) }}</td>
                                    </tr>
                                    <tr>
                                        <td>Shift</td>
                                        <td>: @if($studentResults->first()->user?->shift == 1) Morning @elseif($studentResults->first()->user?->shift == 2) Day @elseif($studentResults->first()->user?->shift == 3) Evening @endif</td>
                                    </tr>
                                    <tr>
                                        <td>Roll</td>
                                        <td>: {{ $studentResults->first()->user?->roll_number }}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="h6 col-md-4" style="font-size: 12px;">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>{{__('app.class')}}</td>
                                        <td>: {{ $studentResults->first()->user?->class?->class_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>{{__('app.section')}}</td>
                                        <td>: {{ $studentResults->first()->user?->section?->section_name }}</td>
                                    </tr>
                                    <tr>
                                        <td>SID</td>
                                        <td>: {{ $studentResults->first()->user?->unique_id ?? 'none' }}</td>
                                    </tr>
                                    <tr>
                                        <td>Year</td>
                                        <td>: {{date("Y")}}</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        {{-- Performance of student --}}

                        <div class="ml-auto">
                            <table class="table table-bordered" style="font-size: 10px; border-color:black;">
                                <thead>
                                    <tr align="center">
                                        <th colspan="2">Performance In Class</th>
                                    </tr>
                                </thead>
                                            <tbody style="text-align:center">
                                    <tr>
                                        <td style="padding:1px;">Excellent</td>
                                        <td width="20%" style="padding:1px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:1px;magrin-left:2px;">Very Good</td>
                                        <td style="padding:1px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:1px;">Good</td>
                                        <td style="padding:1px;"></td>
                                    </tr>
                                    <tr>
                                        <td style="padding:1px;">Poor</td>
                                        <td style="padding:1px;"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <table class="table table-bordered text-center" style="font-size: 12px; border-color:black;">
                        <thead style="padding:0px;">
                            <tr>
                                <th width="350px;" class="text-nowrap">Subject Name</th>
                                <th scope="col">Full Mark</th>
                                <th scope="col">Pass Marks</th>
                                @foreach ($markType as $data)
                                @if ($data->mark_type == 'Class_Test')
                                <th>CT</th>
                                @else
                                <th>{{$data->mark_type}}</th>
                                @endif
                                @endforeach
                                <th scope="col">Total Marks</th>
                                <th scope="col">Grade</th>
                                <th scope="col">Grade Point</th>
                            </tr>
                        </thead>
                        <tbody style="padding:0px;">
                            @php
                            $total = 0;
                            $totalGpa = 0.000;
                            // $totalSubject = count($studentResults); //Permanent
                            $totalSubject = 0; //Temporay

                            @endphp

                            @foreach ($studentResults as $result)
                            @if ($result->absent == 1 || $result->total != 0)
                            @php
                            $totalSubject += 1; //Temporary
                            $term_id = $term->id;
                            $class_id = $result->institute_class_id;
                            $subject_id = $result->subject_id;
                            $current_pass_mark = ($term->pass_mark / 100) * subjectMark($term_id, $class_id, $subject_id);
                            $pass_mark = ($current_pass_mark * 100) / subjectMark($term_id, $class_id, $subject_id);
                            @endphp
                            <tr>
                                @if(!is_null($result?->subject))
                                @if($result?->subject?->subject_name == 'Information and Communication Technology')
                                <td width="300px;" scope="row" style="padding: 1px; color:black;">ICT</td>
                                @elseif($result->subject->subject_name == 'Bangla First Paper')
                                <td width="300px;" scope="row" style="padding: 1px; color:black;">Bangla 1st Paper</td>
                                @elseif($result->subject->subject_name == 'Bangla Second paper')
                                <td width="300px;" scope="row" style="padding: 1px; color:black;">Bangla 2nd Paper</td>
                                @elseif($result->subject->subject_name == 'English First Paper')
                                <td width="300px;" scope="row" style="padding: 1px; color:black;">English 1st Paper</td>
                                @elseif($result->subject->subject_name == 'English Second Paper')
                                <td width="300px;" scope="row" style="padding: 1px; color:black;">English 2nd Paper</td>
                                @elseif($result->subject->subject_name == 'Islam/ Other Religions')
                                <td width="300px;" scope="row" style="padding: 1px; color:black;">Islam/ Other</td>
                                @else
                                <td width="300px;" scope="row" style="padding: 1px; color:black;">{{ $result->subject->subject_name }}</td>
                                @endif


                                <td style="padding: 0px; color:black;">{{ subjectMark($term_id, $class_id, $subject_id) }}</td>
                                <td style="padding: 0px; color:black;">{{ number_format($current_pass_mark, 0) }}</td>
                                @foreach ($markType as $data)
                                @if($data->mark_type == 'Attendance')
                                <td style="padding: 0px; color:black;">{{$result->attendance}}</td>
                                @elseif($data->mark_type == 'Written')
                                <td style="padding: 0px; color:black;">{{$result->written}}</td>
                                @elseif($data->mark_type == 'MCQ')
                                <td style="padding: 0px; color:black;">{{$result->mcq}}</td>
                                @elseif($data->mark_type == 'Assignment')
                                <td style="padding: 0px; color:black;">{{$result->assignment}}</td>
                                @elseif($data->mark_type == 'Presentation')
                                <td style="padding: 0px; color:black;">{{$result->presentation}}</td>
                                @elseif($data->mark_type == 'Quiz')
                                <td style="padding: 0px; color:black;">{{$result->quiz}}</td>
                                @elseif($data->mark_type == 'Practical')
                                <td style="padding: 0px; color:black;">{{$result->practical}}</td>
                                @elseif($data->mark_type == 'HandWriting')
                                <td style="padding: 0px; color:black;">{{$result->handwriting}}</td>
                                @elseif($data->mark_type == 'Midterm')
                                <td style="padding: 0px; color:black;">{{$result->midterm}}</td>
                                @elseif($data->mark_type == 'Semester')
                                <td style="padding: 0px; color:black;">{{$result->semester}}</td>
                                @elseif($data->mark_type == 'UniForm')
                                <td style="padding: 0px; color:black;">{{$result->uniform}}</td>
                                @elseif($data->mark_type == 'PayNumber')
                                <td style="padding: 0px; color:black;">{{$result->paynumber}}</td>
                                @elseif($data->mark_type == 'Others')
                                <td style="padding: 0px; color:black;">{{$result->others}}</td>
                                @elseif ($data->mark_type == 'Class_Test')
                                <td style="padding: 0px; color:black;">{{$result->class_test}}</td>
                                @endif
                                @endforeach
                                <td style="padding: 0px; color:black;">{{ $result->total }}</td>
                                <td style="padding: 0px; color:black;">{{ $result->grade }}</td>
                                <td style="padding: 0px; color:black;">{{ $result->gpa }}</td>
                                @endif
                            </tr>
                            @php
                            $total += $result->total;
                            $totalGpa += $result->gpa;

                            if (isset($optionalSubject) && $optionalSubject != null) {
                            $optionalSubjectId = \App\Models\Subject::where('school_id', authUser()->id)?->where('class_id', $class_id)?->whereIn('subject_code', $optionalSubject)?->get()?->pluck('id')?->toArray();
                            $optionalResult = $studentResults->whereIn('subject_id', $optionalSubjectId)?->first();
                            // dd($result?->subject_id);
                            // dd($optionalResult);
                            $not = $optionalResult?->subject_id == $result?->subject_id;
                            if (!$not) {
                            if ($result->gpa == 0 && $result->grade == 'F') {
                            $resultStatus = "Fail";
                            }
                            }
                            }
                            else {
                            if ($result->gpa == 0 && $result->grade == 'F') {
                            $resultStatus = "Fail";
                            }
                            }

                            @endphp
                            @endif
                            @endforeach

                            @php
                            $optionalSubject = $studentResults->first()->user?->optional_subject;
                            if (in_array($studentResults->first()->user?->class?->class_name, classFilter()) && $optionalSubject != null) {
                            $totalSubject = $totalSubject - 1;
                            $optionalSubjectId = \App\Models\Subject::where('school_id', authUser()->id)->where('class_id', $class_id)->whereIn('subject_code', $optionalSubject)->get()->pluck('id')->toArray();
                            // @dd($optionalSubjectId);
                            $optionalResult = $studentResults->whereIn('subject_id', $optionalSubjectId)->first();

                            $totalGpa = $totalGpa - $optionalResult?->gpa;
                            $addOptionalPoint = $optionalResult?->gpa - 2;
                            $addOptionalPoint = $addOptionalPoint < 0 ? 0 : $addOptionalPoint; $totalGpa=$totalGpa + $addOptionalPoint; $averageGpa=number_format($totalGpa / $totalSubject, 2); $averageGpa=$averageGpa> 5 ? 5 : $averageGpa;
                                }
                                else {
                                $averageGpa = number_format($totalGpa / $totalSubject, 2);
                                }

                                $grading_point = array(
                                'A+' => 5, 'A' => 4, 'A-' => 3.5, 'B' => 3, 'C' => 2, 'D' => 1, 'F' => 0
                                );

                                foreach ($grading_point as $gpa => $minimum_grade) {
                                if ($averageGpa >= $minimum_grade) {
                                $gpa_point = $gpa;
                                break;
                                }
                                }

                                @endphp
                                <tr>
                                    <td colspan="{{$markTypeCount + 2 }}"><b>Total/ GPA</b> </td>
                                    <td><b>{{ $total }}</b>

                                    </td>
                                    @if (isset($resultStatus))
                                    <td colspan="2"><b>{{ $resultStatus }}</b> </td>
                                    @else
                                    <td><b>{{ $gpa_point }}</b> </td>
                                    <td><b>{{ $averageGpa }}</b> </td>
                                    @endif
                                </tr>
                        </tbody>
                    </table>

                    <br>
                    <div class="row justify-content-between">

                        <div class="ml-auto col-2">
                            <table class="table table-bordered" style="font-size: 12px; border-color:black;">
                                <thead>
                                    <tr align="center">
                                        <th colspan="3">Mark Grade</th>
                                    </tr>
                                </thead>
                                            <tbody style="text-align:center">
                                    <tr align="center">
                                        <td style="padding:1px;">80-100</td>
                                        <td width="20%" style="padding:1px;">A+</td>
                                        <td width="30%" style="padding:1px;">5.00</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="padding:1px;">70-79</td>
                                        <td width="20%" style="padding:1px;">A</td>
                                        <td width="30%" style="padding:1px;">4.00</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="padding:1px;">60-69</td>
                                        <td width="20%" style="padding:1px;">A-</td>
                                        <td width="30%" style="padding:1px;">3.50</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="padding:1px;">50-59</td>
                                        <td width="20%" style="padding:1px;">B</td>
                                        <td width="30%" style="padding:1px;">3.00</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="padding:1px;">40-49</td>
                                        <td width="20%" style="padding:1px;">C</td>
                                        <td width="30%" style="padding:1px;">2.50</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="padding:1px;">33-39</td>
                                        <td width="20%" style="padding:1px;">D</td>
                                        <td width="30%" style="padding:1px;">2.00</td>
                                    </tr>
                                    <tr align="center">
                                        <td style="padding:1px;">0-32</td>
                                        <td width="20%" style="padding:1px;">F</td>
                                        <td width="30%" style="padding:1px;">0.00</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                        <div class="col-3">
                            <div>
                                <table class=" table table-bordered text-center" style="font-size: 12px; border-color:black;">

                                    <tbody>
                                        @php
                                        $total_working_days = get_custom_attendance($studentResults->first()->user?->id);
                                        @endphp
                                        <tr class="row">
                                            <td class="col-8 border-end-0" style="border-bottom-color: white;" style="padding:2px;">Total Working Days</td>
                                            <td class="col-4" style="padding:2px;">{{ array_sum($total_working_days) }}</td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-8 border-end-0 border-top-0" style="padding:2px;">Present</td>
                                            <td class="col-4" style="padding:2px;">{{ $total_working_days['present'] }}</td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-8 border-end-0 border-top-0" style="padding:2px;">Absent</td>
                                            <td class="col-4" style="padding:2px;">{{ $total_working_days['absent'] }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                            <div>
                                <table class=" table table-bordered text-center" style="font-size: 12px; border-color:black;">

                                    <tbody>
                                        <tr class="row">
                                            <td class="col-8 border-end-0" style="padding:2px;">Position in Class</td>
                                            {{-- @dd($studentResults->first()->user?->id) --}}
                                            <td class="col-4" style="padding:2px;">{{ singleStudentRank($class_id, $term_id, $studentResults->first()->user?->id) }}</td>
                                        </tr>
                                        <tr class="row">
                                            <td class="col-8 border-end-0 border-top-0" style="padding:2px;">Position in Section</td>
                                            <td class="col-4" style="padding:2px;">{{sectionWiseSingleStudentRank($class_id, $section->section_id, $term_id, $studentResults->first()->user?->id)}}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>

                        </div>

                        <div class="col-6" style="font-size: 12px;">
                            <table class=" table table-bordered text-center" style="border-color: black;">
                                <thead>
                                    <tr>
                                        <th colspan="3">Signatures</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr style="height: 90%">
                                        <td style="height: 80px; width:150px;"></td>
                                        <td style="height: 80px; width:150px;"></td>
                                        <td style="height: 80px; width:150px;"></td>
                                    </tr>
                                    <tr>
                                        <td>Class Teacher</td>
                                        <td>Principal</td>
                                        <td>Guardian</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </div>
    {{-- <div class="col-12 d-flex justify-content-center">
                <button class="btn btn-success" onclick="printDiv()">Print</button>
            </div> --}}
    </div>
    <!--end row-->
</main>

@endsection

@push('js')
<script>
    function printDiv(printDiv) {
        var printContents = document.getElementById('printDiv').innerHTML;
        var originalContents = document.body.innerHTML;

        document.body.innerHTML = printContents;

        window.print();

        document.body.innerHTML = originalContents;
    }
</script>
@endpush