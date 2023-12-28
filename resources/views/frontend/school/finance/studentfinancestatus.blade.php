@extends('layouts.school.master')
@push('css')
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

@endpush
@section('content')
    <!--start content-->
    <main class="page-content">
        <div class="row">
            <div class="col-md-8 mx-auto mt-5">
                <h3 class="text-center mt-3 mb-3 text-primary">{{$text}}</h3>
                <div class="card " style="box-shadow:4px 3px 13px  .13px #bf52f2;border-radius:5px">
                    <div class="card-head">
                        
                    </div>
                    <div class="card-body">
                        <div class="border p-3 rounded">
                            <form class="row g-3" method="get" action="{{route('class.wise.student.finance.status')}}" enctype="multipart/form-data">
                                @csrf
                                <div class="col-md-12">
                                    @include('frontend.layouts.message')
                                </div>
                                <div class="col-md-8 mt-4 d-flex justify-content-center">
                                    <label class="select-form">{{__('app.class')}} {{__('app.Name')}}</label>
                                    <select class="form-select js-select" aria-label="Default select example" required name="class_id" id="class_id" onchange="game_chf()">
                                        <option value="" ></option>
                                        @foreach($class as $data)
                                            <option value="{{$data->id}}">{{$data->class_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                
                                <br><br>
                                
                                    <div class="col pt-2">
                                        <button type="submit" class="btn btn-primary w-100">Check Status</button>
                                    </div>
                                    
                                
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--end row-->
    </main>

    <?php
    $tutorialShow = getTutorial('student-attendance-show');
    ?>
    @include('frontend.partials.tutorial')

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
        function game_chf() {
            let class_id = $("#class_id").val();
            
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

    </script>
@endpush
