@extends('layouts.school.master')
@section('content')
<main class="page-content">
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="row" style="padding-top:5%">
                <div class="col-md-1">
                </div>
                <div class="col-md-10">
                    <div class="card">
                        <div class="card-header text-center h3">
                            <b>{{ $class->class_name }}</b>
                            to
                            <b>{{ $next_class->class_name }}</b>
                        </div>
                        <div class="card-body">
                            <form id="myForm" action="{{ route('session.create') }}" method="get">
                                <input type="hidden" name="class_id" value="{{ $class->id }}">
                                <input type="hidden" name="update_session" value="1">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th scope="col">SL</th>
                                            <th scope="col">Check</th>
                                            <th scope="col">Student Name</th>
                                            <th scope="col">Old Roll</th>
                                            <th scope="col">New Roll <sup class="text-danger">*</sup></th>
                                            <th scope="col">New Section <sup class="text-danger">*</sup></th>
                                            @if ($has_group)
                                                <th scope="col">Group</th>
                                            @endif
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($students as $student)
                                            <tr>
                                                <th scope="row">{{ $loop->iteration }}</th>
                                                <td>
                                                    <input type="checkbox" name="passed_students[]" value="{{ $student->id }}" checked>
                                                </td>
                                                <td>{{ $student->name }}</td>
                                                <td>{{ $student->roll_number }}</td>
                                                <td>
                                                    <input type="hidden" name="student_id[]" value="{{ $student->id }}">
                                                    <input type="number" onkeyup="" class="form-control" name="new_role_number[]" min="0" value="0">
                                                </td>
                                                <td>
                                                    <select name="section_id" class="form-control">
                                                        <option value="" disabled selected>--------------</option>
                                                        @foreach ($next_class->section as $section)
                                                        <option value="{{ $section->id }}">{{ $section->section_name }}</option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                @if ($has_group)
                                                    <td>
                                                        <select class="form-control" onchange="subjectShow()" name="group_id">
                                                            <option value="" disabled selected>--------------</option>
                                                            <option value="1" @if (isset($studentEdit)) @if ($studentEdit->group_id == 1){{ 'selected' }} @endif @endif > Science </option>
                                                            <option value="2" @if (isset($studentEdit)) @if ($studentEdit->group_id == 2){{ 'selected' }} @endif @endif> Commerce </option>
                                                            <option value="3" @if (isset($studentEdit)) @if ($studentEdit->group_id == 3){{ 'selected' }} @endif @endif> Humanities </option>
                                                        </select>
                                                    </td>
                                                @endif
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Update Session</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="col-md-1">
                </div>
            </div>
        </div>
    </div>
</main>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Prevent form submission on Enter key press
        document.getElementById('myForm').addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
            }
        });
    });
</script>
@endsection