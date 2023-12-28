<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/css/bootstrap.min.css">
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg" />
    <title>Shikkha</title>
    
    <style>
        @media print {
            .student-info {
                page-break-after: always;
            }
        }
    </style>
</head>
<body>
    <div class="student_finance">
        <br><br><br><br><br><br><br><br><br><br><br><br>
        {{-- <br><br><br><br><br><br><br><br><br><br><br><br> --}}
        <center>
            <div class="d-flex justify-content-center">
                {{-- @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                    <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:10px;">
                @endif --}}
                <div class="text-center">
                    <h4 style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 24px;"> {{ strtoupper(authUser()->school_name) }} </h4>
                    <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 19px;"> <b>{{ authUser()->slogan != null ? '('.authUser()->slogan.')': ""}}</b> </p>
                    <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 19px;"> {{ authUser()->address }} </p>                    
                    <p style="font-size: 19px;">Finance Month: {{ date('F') }}</p>
                    <br><br><br><br>
                </div>
            </div>
            <div class="buttonForPrint py-5">
                <!-- Add a button to trigger the print function for the specific div -->
                <button onclick="printDiv('student_finance')" style="width:200px; height:100px; color:blueviolet; border-radius:5px; font-famity: poppins; font-size:20px;">Print Student Financial Status</button>   
            </div>
        
        <p></p>
        </center>
        <br><br><br><br><br><br><br>
    </div>
    
    <div class="print">
        @foreach($studentList as $user)
            <div class="student_finance" id="student_finance">
                <div class="row">
                    <table>
                        <tbody>
                            <td>
                                <div class="col-md-12" style="margin-right: 20px; margin-left: 20px; color:black;">                                           

                                    {{-- School Info --}}
                                    <center>
                                        <div class="d-flex justify-content-center">
                                            {{-- @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                                                <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:10px;">
                                            @endif --}}
                                            <div class="text-center">
                                                <h4 style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 14px;"> {{ strtoupper(authUser()->school_name) }} </h4>
                                                <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 12px;white-space: nowrap;"> <b>{{ authUser()->slogan != null ? '('.authUser()->slogan.')': ""}}</b> </p>
                                                <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 12px;white-space: nowrap;"> {{ authUser()->address }} </p>
                                                
                                            </div>
                                        </div>
                                    </center>
                                    {{-- End School Info --}}
                
                                    {{-- Start Student Info --}}
                
                                    <div class="d-flex justify-content-between" >            
                                        <div class="col-md-12">
                                            <div class="row">                                                            
                                                <div class="col-12" style="font-size: 12px;">
                                                    <b> Student Name: </b>{{strtoupper($user->name)}}
                                                    
                                                    <table style="border-color: black; white-space: nowrap; margin:0px; padding: 0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-size: 12px;"><b>Class: </b>{{$user->clasRelation->class_name}}</td>                                                                            
                                                                <td style="font-size: 12px;"><b><span style="padding-left: 40px;">Section: </span></b>{{$user->sectionRelation->section_name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table style="border-color: black; white-space: nowrap; font-size: 12px; margin:0px; padding: 0px;">
                                                        <tbody>
                                                            <tr >
                                                                <td><b>Roll: </b>{{$user->roll_number}}</td> 
                                                                <td style="padding-left: 15px;"><b>ID No: </b>{{$user->unique_id}}</td>
                                                                <td style="padding-left: 15px;"><b>Date: </b>{{$date}}</td>
                                                            </tr>                                                                                                                                    
                                                        </tbody>
                                                    </table>
                                                </div>                                                        
                                            </div>
                                        </div>                                                        
                                    </div>
                
                                    {{-- end student Info --}}
                
                                    {{-- Start fees table --}}
                                    <div class="table">
                                        <table class="table table-hover table-bordered" style="font-size: 12px; border: 1px solid black;border-collapse: collapse;">
                                            <thead >
                                                <tr>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.No')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Month')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse; width:150px;">{{__('app.Description')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Paid')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Due')}}</th>                        
                                                </tr>
                                            </thead>
                
                                            <tbody>
                                                @php
                                                    $totalPaid = 0;
                                                    $totalDue = 0;
                                                @endphp
                                                @foreach ($matchedElements as $studentMonthlyFees)
                                                    
                                                    @foreach ($studentMonthlyFees as $key => $studentMonthlyFee)
                                                        @if ($user->id == $studentMonthlyFee->student_id)
                                                            <tr>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{++$key}}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{ $studentMonthlyFee->month_name }}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap; width:150px;">{{ App\Models\FeesType::find(App\Models\StudentFee::find($studentMonthlyFee->student_fees_id)?->fees_type_id)?->title }}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{ $studentMonthlyFee->paid_amount }}৳ </td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{ $studentMonthlyFee->amount - $studentMonthlyFee->paid_amount}}৳ </td>                                                                    
                                                            </tr>  
                                                            @php
                                                                $totalPaid = $totalPaid + $studentMonthlyFee->paid_amount;
                                                                $totalDue = $totalDue + ($studentMonthlyFee->amount - $studentMonthlyFee->paid_amount);
                                                            @endphp                                  
                                                        @endif
                                                    @endforeach                                    
                                                @endforeach
                                                <tr>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;"></td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;">Total :</td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;"></td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{$totalPaid}}</td> 
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{$totalDue}}৳</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                
                                    {{-- End fees table --}}
                
                                    {{-- Start Class Teacher --}}
                                    <div class="classTeacher" style="font-size: 12px; white-space: nowrap;">
                                        <div class="first">
                                            Class Teacher: {{$classTeacher}}
                                        </div>
                                        <div class="Second">
                                            <table>
                                                <tbody>                                                    
                                                    <tr>
                                                        <td style="font-size: 12px;">CT: {{$classTeacherPhone}}</td>
                                                        <td style="font-size: 12px;padding-left:20px;">Accountant: {{$accountant}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <br>
                                        <p><span style="color: red; font-size: 12px;"> ১০ তারিখের মধ্যে বেতন পরিশোধের অনুরোধ রইল এবং <br> বেতন পরিশোধের সময় রিসিটটি সঙ্গে আনতে হবে।</span></p>
                                    </div>
                
                                    {{-- End Class Teacher --}}
                
                                    {{-- signature start --}}
                                    <div class="col-12">
                                        <div class="row">
                                            <center>
                                                <div class="d-flex justify-content-center">
                                                    <div class="col" style="font-size: 12px;">
                                                        <table class="table text-center" style="border-color: black;">
                                                            
                                                            <tbody>
                                                                <tr style="height: 90%">
                                                                    <td style="height: 50px; width:150px;margin-bottom:0px;">---------------------</td>
                                                                    <td style="border: none;"></td>
                                                                    <td style="border: none;"></td>
                                                                    <td style="height: 50px; width:150px;margin-bottom:0px;">-------------------</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="table-bordered" style="font-size: 12px; border-bottom: none;white-space: nowrap;margin-top: 0px;">Accountant Sign</td>&nbsp;
                                                                    <td style="border: none;"></td>
                                                                    <td style="border: none;"></td>
                                                                    <td class="table-bordered" style="font-size: 12px; border-bottom: none;white-space: nowrap;margin-top: 0px;">Guardian Sign</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="text-center">
                                                            <span>Office Copy</span>
                                                        </div>
                                                    </div>                                                    
                                                </div> 
                                            </center>
                                               
                                        </div>
                                    </div>
                                    
                                    {{-- signature End --}}
                                                                                        
                                </div>
                            </td>
                            <td>
                                <div class="col-md-12" style="margin-right: 20px; margin-left: 20px; color:black;">                                           

                                    {{-- School Info --}}
                                    <center>
                                        <div class="d-flex justify-content-center">
                                            {{-- @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                                                <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:10px;">
                                            @endif --}}
                                            <div class="text-center">
                                                <h4 style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 14px;"> {{ strtoupper(authUser()->school_name) }} </h4>
                                                <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 12px;white-space: nowrap;"> <b>{{ authUser()->slogan != null ? '('.authUser()->slogan.')': ""}}</b> </p>
                                                <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 12px;white-space: nowrap;"> {{ authUser()->address }} </p>
                                                
                                            </div>
                                        </div>
                                    </center>
                                    {{-- End School Info --}}
                
                                    {{-- Start Student Info --}}
                
                                    <div class="d-flex justify-content-between" >            
                                        <div class="col-md-12">
                                            <div class="row">                                                            
                                                <div class="col-12" style="font-size: 12px;">
                                                    <b> Student Name: </b>{{strtoupper($user->name)}}
                                                    
                                                    <table style="border-color: black; white-space: nowrap; margin:0px; padding: 0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-size: 12px;"><b>Class: </b>{{$user->clasRelation->class_name}}</td>                                                                            
                                                                <td style="font-size: 12px;"><b><span style="padding-left: 40px;">Section: </span></b>{{$user->sectionRelation->section_name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table style="border-color: black; white-space: nowrap; font-size: 12px; margin:0px; padding: 0px;">
                                                        <tbody>
                                                            <tr >
                                                                <td><b>Roll: </b>{{$user->roll_number}}</td> 
                                                                <td style="padding-left: 15px;"><b>ID No: </b>{{$user->unique_id}}</td>
                                                                <td style="padding-left: 15px;"><b>Date: </b>{{$date}}</td>
                                                            </tr>                                                                                                                                    
                                                        </tbody>
                                                    </table>
                                                </div>                                                        
                                            </div>
                                        </div>                                                        
                                    </div>
                
                                    {{-- end student Info --}}
                
                                    {{-- Start fees table --}}
                                    <div class="table">
                                        <table class="table table-hover table-bordered" style="font-size: 12px; border: 1px solid black;border-collapse: collapse;">
                                            <thead >
                                                <tr>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.No')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Month')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse; width:150px;">{{__('app.Description')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Paid')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Due')}}</th>                        
                                                </tr>
                                            </thead>
                
                                            <tbody>
                                                @php
                                                    $totalPaid = 0;
                                                    $totalDue = 0;
                                                @endphp
                                                @foreach ($matchedElements as $studentMonthlyFees)
                                                    
                                                    @foreach ($studentMonthlyFees as $key => $studentMonthlyFee)
                                                        @if ($user->id == $studentMonthlyFee->student_id)
                                                            <tr>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{++$key}}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{ $studentMonthlyFee->month_name }}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap; width:150px;">{{ App\Models\FeesType::find(App\Models\StudentFee::find($studentMonthlyFee->student_fees_id)?->fees_type_id)?->title }}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{ $studentMonthlyFee->paid_amount }}৳ </td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{ $studentMonthlyFee->amount - $studentMonthlyFee->paid_amount}}৳ </td>                                                                    
                                                            </tr>  
                                                            @php
                                                                $totalPaid = $totalPaid + $studentMonthlyFee->paid_amount;
                                                                $totalDue = $totalDue + ($studentMonthlyFee->amount - $studentMonthlyFee->paid_amount);
                                                            @endphp                                  
                                                        @endif
                                                    @endforeach                                    
                                                @endforeach
                                                <tr>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;"></td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;">Total :</td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;"></td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{$totalPaid}}৳</td> 
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{$totalDue}}৳</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                
                                    {{-- End fees table --}}
                
                                    {{-- Start Class Teacher --}}
                                    <div class="classTeacher" style="font-size: 12px; white-space: nowrap;">
                                        <div class="first">
                                            Class Teacher: {{$classTeacher}}
                                        </div>
                                        <div class="Second">
                                            <table>
                                                <tbody>                                                    
                                                    <tr>
                                                        <td style="font-size: 12px;">CT: {{$classTeacherPhone}}</td>
                                                        <td style="font-size: 12px;padding-left:20px;">Accountant: {{$accountant}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <br>
                                        <p><span style="color: red; font-size: 12px;"> ১০ তারিখের মধ্যে বেতন পরিশোধের অনুরোধ রইল এবং <br> বেতন পরিশোধের সময় রিসিটটি সঙ্গে আনতে হবে।</span></p>
                                    </div>
                
                                    {{-- End Class Teacher --}}
                
                                    {{-- signature start --}}
                                    <div class="col-12">
                                        <div class="row">
                                            <center>
                                                <div class="d-flex justify-content-center">
                                                    <div class="col" style="font-size: 12px;">
                                                        <table class="table text-center" style="border-color: black;">
                                                            
                                                            <tbody>
                                                                <tr style="height: 90%">
                                                                    <td style="height: 50px; width:150px;margin-bottom:0px;">---------------------</td>
                                                                    <td style="border: none;"></td>
                                                                    <td style="border: none;"></td>
                                                                    <td style="height: 50px; width:150px;margin-bottom:0px;">-------------------</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="table-bordered" style="font-size: 12px; border-bottom: none;white-space: nowrap;margin-top: 0px;">Accountant Sign</td>&nbsp;
                                                                    <td style="border: none;"></td>
                                                                    <td style="border: none;"></td>
                                                                    <td class="table-bordered" style="font-size: 12px; border-bottom: none;white-space: nowrap;margin-top: 0px;">Guardian Sign</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="text-center">
                                                            <span>Class Teacher Copy</span>
                                                        </div>
                                                    </div>                                                    
                                                </div> 
                                            </center>
                                               
                                        </div>
                                    </div>
                                    
                                    {{-- signature End --}}
                                                                                        
                                </div>
                            </td>
                            <td>
                                <div class="col-md-12" style="margin-right: 20px; margin-left: 20px; color:black;">                                           

                                    {{-- School Info --}}
                                    <center>
                                        <div class="d-flex justify-content-center">
                                            {{-- @if (File::exists(public_path(authUser()->school_logo)) && !is_null(authUser()->school_logo))
                                                <img src="{{asset(authUser()->school_logo)}}" alt="school logo" class="img-fluid" width="80" style="width:80px; height:80px;margin-right:10px;">
                                            @endif --}}
                                            <div class="text-center">
                                                <h4 style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 14px;"> {{ strtoupper(authUser()->school_name) }} </h4>
                                                <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 12px;white-space: nowrap;"> <b>{{ authUser()->slogan != null ? '('.authUser()->slogan.')': ""}}</b> </p>
                                                <p style="margin-bottom: 0px;padding:0px; margin:0px;padding:0px;font-size: 12px;white-space: nowrap;"> {{ authUser()->address }} </p>
                                                
                                            </div>
                                        </div>
                                    </center>
                                    {{-- End School Info --}}
                
                                    {{-- Start Student Info --}}
                
                                    <div class="d-flex justify-content-between" >            
                                        <div class="col-md-12">
                                            <div class="row">                                                            
                                                <div class="col-12" style="font-size: 12px;">
                                                    <b> Student Name: </b>{{strtoupper($user->name)}}
                                                    
                                                    <table style="border-color: black; white-space: nowrap; margin:0px; padding: 0px;">
                                                        <tbody>
                                                            <tr>
                                                                <td style="font-size: 12px;"><b>Class: </b>{{$user->clasRelation->class_name}}</td>                                                                            
                                                                <td style="font-size: 12px;"><b><span style="padding-left: 40px;">Section: </span></b>{{$user->sectionRelation->section_name}}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                    <table style="border-color: black; white-space: nowrap; font-size: 12px; margin:0px; padding: 0px;">
                                                        <tbody>
                                                            <tr >
                                                                <td><b>Roll: </b>{{$user->roll_number}}</td> 
                                                                <td style="padding-left: 15px;"><b>ID No: </b>{{$user->unique_id}}</td>
                                                                <td style="padding-left: 15px;"><b>Date: </b>{{$date}}</td>
                                                            </tr>                                                                                                                                    
                                                        </tbody>
                                                    </table>
                                                </div>                                                        
                                            </div>
                                        </div>                                                        
                                    </div>
                
                                    {{-- end student Info --}}
                
                                    {{-- Start fees table --}}
                                    <div class="table">
                                        <table class="table table-hover table-bordered" style="font-size: 12px; border: 1px solid black;border-collapse: collapse;">
                                            <thead >
                                                <tr>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.No')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Month')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse; width:150px;">{{__('app.Description')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Paid')}}</th>
                                                    <th style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{__('app.Due')}}</th>                        
                                                </tr>
                                            </thead>
                
                                            <tbody>
                                                @php
                                                    $totalPaid = 0;
                                                    $totalDue = 0;
                                                @endphp
                                                @foreach ($matchedElements as $studentMonthlyFees)
                                                    
                                                    @foreach ($studentMonthlyFees as $key => $studentMonthlyFee)
                                                        @if ($user->id == $studentMonthlyFee->student_id)
                                                            <tr>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{++$key}}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;">{{ $studentMonthlyFee->month_name }}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap; width:150px;">{{ App\Models\FeesType::find(App\Models\StudentFee::find($studentMonthlyFee->student_fees_id)?->fees_type_id)?->title }}</td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{ $studentMonthlyFee->paid_amount }}৳ </td>
                                                                <td style="padding-top: 1px; padding-bottom: 1px;padding-left:5px; padding-right:5px; border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{ $studentMonthlyFee->amount - $studentMonthlyFee->paid_amount}}৳ </td>                                                                    
                                                            </tr>  
                                                            @php
                                                                $totalPaid = $totalPaid + $studentMonthlyFee->paid_amount;
                                                                $totalDue = $totalDue + ($studentMonthlyFee->amount - $studentMonthlyFee->paid_amount);
                                                            @endphp                                  
                                                        @endif
                                                    @endforeach                                    
                                                @endforeach
                                                <tr>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;"></td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;">Total :</td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;"></td>
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{$totalPaid}}৳</td> 
                                                    <td style="padding: 2px;border: 1px solid black;border-collapse: collapse;white-space: nowrap;">{{$totalDue}}৳</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                
                                    {{-- End fees table --}}
                
                                    {{-- Start Class Teacher --}}
                                    <div class="classTeacher" style="font-size: 12px; white-space: nowrap;">
                                        <div class="first">
                                            Class Teacher: {{$classTeacher}}
                                        </div>
                                        <div class="Second">
                                            <table>
                                                <tbody>                                                    
                                                    <tr>
                                                        <td style="font-size: 12px;">CT: {{$classTeacherPhone}}</td>
                                                        <td style="font-size: 12px; padding-left:20px;">Accountant: {{$accountant}}</td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                        
                                        <br>
                                        <p><span style="color: red; font-size: 12px;"> ১০ তারিখের মধ্যে বেতন পরিশোধের অনুরোধ রইল এবং <br> বেতন পরিশোধের সময় রিসিটটি সঙ্গে আনতে হবে।</span></p>
                                    </div>
                
                                    {{-- End Class Teacher --}}
                
                                    {{-- signature start --}}
                                    <div class="col-12">
                                        <div class="row">
                                            <center>
                                                <div class="d-flex justify-content-center">
                                                    <div class="col" style="font-size: 12px;">
                                                        <table class="table text-center" style="border-color: black;">
                                                            
                                                            <tbody>
                                                                <tr style="height: 90%">
                                                                    <td style="height: 50px; width:150px;margin-bottom:0px;">---------------------</td>
                                                                    <td style="border: none;"></td>
                                                                    <td style="border: none;"></td>
                                                                    <td style="height: 50px; width:150px;margin-bottom:0px;">-------------------</td>
                                                                </tr>
                                                                <tr>
                                                                    <td class="table-bordered" style="font-size: 12px; border-bottom: none;white-space: nowrap;margin-top: 0px;">Accountant Sign</td>&nbsp;
                                                                    <td style="border: none;"></td>
                                                                    <td style="border: none;"></td>
                                                                    <td class="table-bordered" style="font-size: 12px; border-bottom: none;white-space: nowrap;margin-top: 0px;">Guardian Sign</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="text-center">
                                                            <span>Guardian Copy</span>
                                                        </div>
                                                    </div>                                                    
                                                </div> 
                                            </center>
                                               
                                        </div>
                                    </div>
                                    
                                    {{-- signature End --}}
                                                                                        
                                </div>
                            </td>
                        </tbody>
                    </table>
                    
                </div>
            </div>                    
        @endforeach
    </div>
     

    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.4.1/dist/js/bootstrap.min.js"></script>
    <script>
        function printDiv(student_finance) {
            var style = "<style>.student_finance { page-break-after: always; }</style>";
            var printWindow = window.open('', '_blank');
            printWindow.document.write(style);
            printWindow.document.write(document.body.innerHTML);
            printWindow.document.close();
            printWindow.print();
            printWindow.close();
        }
    </script>

</body>
</html>
    