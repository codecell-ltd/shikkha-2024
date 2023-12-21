<div class="container-fluid">
    <div class="row m-0">
        <div class="col-12 m-0">
            <div class="mb-1 border-bottom pb-1" id="schoolInfo">
                <div class="text-center">
                    <h5 class="m-0 text-uppercase">{{ $school->school_name }} </h5>
                    <small class="m-0">{{ $school->slogan }}</small> <br/>
                    <small class="m-0"> {{ $school->address }} </small>
                </div>
            </div>
            {{-- <div class="border border-secondary m-1"></div> --}}
            <div style="font-size: 12px" class="border-bottom mb-3 pb-3">
                <table style="width: 100%">
                    <tr>
                        <td>Student Name</td>
                        <td>: {{$student->name}}</td>
                        <td>Roll</td>
                        <td>: {{$student->roll_number}}</td>
                    </tr>
                    <tr>
                        <td>Father Name</td>
                        <td>: {{$student->father_name}}</td>
                        <td>Class</td>
                        <td>: {{$student->class?->class_name}}</td>
                    </tr>
                    <tr>
                        <td>Mother Name</td>
                        <td>: {{$student->mother_name}}</td>
                        <td>Section</td>
                        <td>: {{$student->section?->section_name}}</td>
                    </tr>

                    <tr>
                        <td>Date</td>
                        <td>: {{date("d-M-Y")}}</td>
                        <td>Time</td>
                        <td>: {{date("g:i:s A")}}</td>
                    </tr>
                </table>
            </div>
        </div>
        
        <div class="col-12 m-0" style="font-size: 12px">
            {!! $feesTable !!}
        </div>

        <div class="col-12 mt-5 pt-5 text-center d-flex justify-content-between">
            <p class="m-0" style="font-size: 10px">This is auto generated receipt.</p>
            <p class="m-0" style="font-size: 10px">Powered by {{env('APP_NAME')}}</p>
        </div>
    </div>
</div>