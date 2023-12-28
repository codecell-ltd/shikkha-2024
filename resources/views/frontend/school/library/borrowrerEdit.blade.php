@extends('layouts.school.master')

@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">
@endpush 

@section('content')

<main class="page-content">
    <div class="row">
        <div class="col-xl-6 mx-auto">
            <div class="card">
                <h2 style="margin:10px; text-align:center; ">Borrowrer Entry </h2>
                @if(\Session::has('insert'))
                <div id="" class="alert alert-success">
                    {!!Session::get('insert')!!}
                </div>
                @endif
                <!-- error message -->
                @if(\Session::has('error'))
                <div id="" class="alert alert-danger">
                    {!!Session::get('error')!!}
                </div>
                @endif


                <div class="row">

                    <div class="col-xl-12">


                        <div style="margin: 20px;">
                            <form class="row g-3" method="post" action="{{route('borrower.Update',$borrowrer->id)}}" enctype="multipart/form-data">
                                @method('PUT')
                                @csrf


                                <!-- relation of book and Subject -->
                                <div class="col-12">
                                    <div class="row">

                                        <div class="col-md-6">
                                            <label>Book</label>
                                            <select class="form-control mb-3 js-select" id="" name="book_id" required>
                                                @foreach($books as $book)
                                                    <option value="{{$book->id}}" @if($book->id == $borrowrer->bookRelation?->id) selected @endif>{{$book->book_name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                        <div class="col-md-6" id="group-select">
                                            <label>Student Name</label>
                                            <select class="form-control mb-3 js-select" id="Student_id" name="Student_id" required>
                                                <option selected>{{$borrowrer->studentRelation->name}}</option>
                                                @foreach($students as $student)
                                                    <option value="{{$student->id}}" @if($student->id==$borrowrer->studentRelation?->id) selected @endif>{{$student->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="row">
                                        <div class="col-md-6">
                                            <label>borrow date</label>
                                            <input type="text"  value="{{$borrowrer->borrow_date}}" id="datepicker" class="form-control" placeholder="" name="borrow_date" required>
                                            @error('borrow_date')<div class="alert alert-danger">{{$message}}</div>@enderror
                                        </div>                                           
                                        
                                        <div class="col-md-6">
                                            <label>Possible return date</label>
                                            <input type="text" id="datepicker2" value="{{$borrowrer->possible_borrow_date}}" class="form-control" placeholder="" name="possible_borrow_date">
                                        </div>                                        
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="col-md-6">
                                        <label>Return date</label>
                                        <input type="text" id="return_date" value="{{ $defaultDate }}" class="form-control" placeholder="" name="return_date">
                                        @error('return_date')<div class="alert alert-danger">{{$message}}</div>@enderror
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="d-grid">
                                        <button type="submit" class="btn btn-primary">Submit</button>
                                    </div>
                                </div>
                            </form>
                        </div>


                    </div>


                </div>

            </div>
        </div>
    </div>

</main>
@endsection
@push('js')

    <script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script>
    <script>
        $(document).ready(function(){
            $("#datepicker").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
            });
        })
    </script>

    <script>
        $(document).ready(function(){
            $("#datepicker2").datepicker({
                dateFormat: "yy-mm-dd",
                changeMonth: true,
                changeYear: true,
            });
        })
    </script>

<script>
    $(document).ready(function(){
        $("#return_date").datepicker({
            dateFormat: "yy-mm-dd",
            changeMonth: true,
            changeYear: true,
        });
    })
</script>

    <script type="text/javascript">
    
        $(function() {
            var dtToday = new Date();

            var month = dtToday.getMonth() + 1;
            var day = dtToday.getDate();
            var year = dtToday.getFullYear();
            if (month < 10)
                month = '0' + month.toString();
            if (day < 10)
                day = '0' + day.toString();
            var maxDate = year + '-' + month + '-' + day;
            $('#return_date').attr('min', maxDate);
        });
    </script>
@endpush