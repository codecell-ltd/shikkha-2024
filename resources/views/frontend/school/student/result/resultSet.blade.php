@extends('layouts.school.master')

@section('content')
<!--start content-->
<style>
.list-group-item-action.active{
    background-color: #7500a7 !important;
    border-color: #7500a7
}
.list-group-item{
    border-radius: 4px;
    
}
</style>
<main class="page-content">
    <div class="row">
        <div class="col-3">
            <div class="list-group" id="list-tab" role="tablist" style="border: 12px solid #fffff">
                <div>
                    <h3>
                        <center>All Classes</center>
                    </h3>
                </div>
                @foreach($class as $key=>$data)
                    <a class="list-group-item list-group-item-action" data-bs-toggle="list" href="#list-profile" onclick="loadSubject('{{$data->id}}')" role="tab" aria-controls="list-profile">{{$data->class_name}}</a>
                @endforeach
            </div>
        </div>
        <input type="hidden" name="resultSettingId" id="resultSettingId" value="{{ $resultSettingId }}">
        <div class="col-8">
            <div class="text-center">
                <h3>Mark Distribution</h3>
            </div>
            <div class="card" style="background: #7500a7;color:white;border:12px solid #7500a7">
                <div class="card-body " >
                    <div class="row d-none text-center checkbox-selected-row">
                        <div class="col-md">
                            <input type="checkbox" value="1" id="mcq"/>
                            <label>MCQ</label>
                        </div>

                        <div class="col-md">
                            <input type="checkbox" value="2" id="written"/>
                            <label>Written</label>
                        </div>

                        <div class="col-md">
                            <input type="checkbox" value="3" id="practical"/>
                            <label>Practical</label>
                        </div>
                    </div>
                    <hr/>
                    <form id="formData" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade" id="list-profile" role="tabpanel" aria-labelledby="list-messages-list">
                                <header>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">
                                            
                                        </div>
                                    </div>
                                </header>
                                
                                <div id="subject_id">

                                </div>

                                <footer>
                                    <div class="mb-3 row">
                                        <div class="col-sm-10">

                                        </div>
                                        <div class="col-sm-2 mt-2">
                                            <button type="button" onclick="saveMark()" id="validate-btn" class="btn btn-outline-light btn-sm">Save</button>
                                        </div>
                                    </div>
                                </footer>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <div class="d-flex justify-content-end">
                <a href="{{ route("result.up.first.step", ['id' => $resultSettingId]) }}" id="markInputBtn" class="btn btn-primary disabled">Input Result</a>
            </div>
        </div>
        <div class="col-1"></div>
        </div>
    </div>
</main>
@endsection

@push('js')
<script>
    function loadSubject(class_id)
    {
        var resultInputBtn = document.getElementById("markInputBtn");
        var resultSettingId = $("#resultSettingId").val();
        $.ajax({
            url: '{{ route('ajax.load.result.subject')}}',
            type: "GET",
            data: {
                class_id: class_id, resultSettingId
            },
            success: function(res) {
                resultInputBtn.classList.add("disabled");
                if(res == ' ') {
                    Swal.fire({
                       icon: 'info', 
                       title: 'Do not have any subject in this class',
                    })
                }else {
                    $('.checkbox-selected-row').removeClass("d-none");
                    $("#mcq, #written, #practical").parent().removeClass("d-none");
                    $("#mcq, #written, #practical").prop("checked", false);
                    $("#subject_id").html(res);
                }
            }
        })
    };

    function saveMark()
    {
        var isValid = true;
        $('.input-field').each(function() {
            var value = $(this).val();
            var min = parseInt($(this).attr('min'), 10);
            if (value !== '' && parseInt(value, 10) < min || value < 1 || value > 100) {
                isValid = false;
                return false; // Exit the loop if one input is invalid
            }
        });

        if (isValid) {
            var resultInputBtn = document.getElementById("markInputBtn");
            $.ajax({
                url: "{{ route('store.subject.mark') }}",
                type: "post",
                data: $("#formData").serialize(),
                success: function(data) {
                    if(data.status == "success"){
                        resultInputBtn.classList.remove("disabled");
                        Swal.fire({
                        position: 'top-end',
                        icon: 'success',
                        title: 'Subject Mark Save Successfuly',
                        showConfirmButton: false,
                        timer: 1500
                        });
                    };
                },
                error: function(error){
                    Swal.fire({
                        title: "Try Later",
                        icon: 'error',
                        text: 'Have Some Problem. Please Try Again Later.',
                        inputPlaceholder: 'Nombre',
                    });
                }
            });
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Input Your Perfect Numbe',
                showConfirmButton: false,
                timer: 1500
            });
        }
          
    };

    function keyUpDistributionMarkSave(resultSettingId, class_id, subject_id)
    {
        var markId = "#mark" + subject_id;
        var mcqId = "#mcq" + subject_id;
        var writtenId = "#written" + subject_id;
        var practicalId = "#practical" + subject_id;

        var mark = $(markId).val();
        var mcq = $(mcqId).val();
        var written = $(writtenId).val();
        var practical = $(practicalId).val();
        
        var isValid = true;
        var min = parseInt($(markId).attr('min'), 10);
        
        if (mark != '' && parseInt(mark, 10) < min || mark < 1) {
            isValid = false;
            return false; // Exit the loop if one input is invalid
        }
        if(mark > 100 || mark == '') {
            isValid = false;
        }
        
        if (isValid) {
            $.ajax({
                url: "{{ route('store.single.subject.mark') }}" ,
                type: "get",
                data: {'resultSettingId':resultSettingId, 'class_id':class_id, 'subject_id':subject_id, 'mark':mark, 'mcq':mcq, 'written':written, 'practical':practical},
                success: function(data) {
                   
                },
                error: function(error){
                    Swal.fire({
                        title: "Try Later",
                        icon: 'error',
                        text: 'Have Some Problem. Please Try Again Later.',
                        inputPlaceholder: 'Nombre',
                    });
                }
            });
        } else {
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Input Your Perfect Numbe',
                showConfirmButton: false,
                timer: 1500
            });
        }
    }
</script>

<script>
    $(document).ready(function () {
        $("#mcq, #written, #practical").on("click", function() {
            $value = $(this).val();
            if ($value == 1) {
                $(".mcq").removeClass("d-none");
                $("#mcq").parent().addClass("d-none");
            }else if ($value == 2) {
                $(".written").removeClass("d-none");
                $("#written").parent().addClass("d-none");
            } else {
                $(".practical").removeClass("d-none");
                $("#practical").parent().addClass("d-none");
            }
        });
    });
</script>
@endpush
