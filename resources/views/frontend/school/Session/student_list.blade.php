@extends('layouts.school.master')
@section('content')
<main class="page-content">
    <div class="row">
        <div class="col-xl-12 mx-auto">
            <div class="row" style="padding-top:5%">
                <div class="col-md-2"></div>
                <div class="col-md-8">
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
                                            <th scope="col">New Roll</th>
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
                <div class="col-md-2">
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