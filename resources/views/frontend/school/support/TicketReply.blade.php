@extends('layouts.school.master')
@section('content')
<main class="page-content">
    <style>
        .write-message:focus-visible {
            outline: none !important;
        }
    </style>

    <div class="container" style="padding: 0;background-color: #FFF; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
                height: 600px;">
        <div class="row">
            <section class="discussions" style="width: 35%; height: 600px; box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.20);
                overflow: scroll; background-color: #e1e2e3;  display: inline-block;padding-left: 0px;
                padding-right: 0px;">
              
                @foreach($ticket as $data)
                <div class="discussion" style="width: 100%; height: 90px;background-color: #FAFAFA; border-bottom: solid 1px #E0E0E0;display: flex;align-items: center; cursor: pointer;">
                    <div class="photo" style="margin-left: 20px;
                                    display: block;">
                        <img src="{{asset('d/shikkha.jpg')}}" alt="" width="45" height="45" style="border-radius:50px">
                        <div class="online"></div>
                    </div>
                    <div class="desc-contact" style="height: 43px;
                                width: 50%;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;">
                        <p class="name" style="margin: 0 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 11pt;
                color: #515151;" onclick="loadData('{{ $data->id }}')">
                            <strong> {{$data->token}}</strong>
                        </p>
                        <p class="message" style="margin: 6px 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 9pt;
                color: #515151;">
                        </p>
                    </div>
                    <div class="timer" style="margin-left: 10%;
                font-family: 'Open Sans', sans-serif;
                font-size: 11px;
                padding: 3px 8px;
                color: #BBB;
                background-color: #FFF;
                border: 1px solid #E5E5E5;
                border-radius: 15px;">
                        {{$data->created_at->format("h:i A")}}
                    </div>
                    <a style="padding:2%" href="" onclick="if(confirm('Are you sure? You are going to delete this record')){ location.replace( '{{route('ticket.delete',$data->id) }}' ); }"><i class="bi bi-trash"></i></a>
                </div>
                @endforeach
            </section>






            <section class="chat" style="width: 65%;padding-left: 0px;
                padding-right: 0px;">

                <div class="card">
                    <div class="card-header">
                        <div class="header-chat" style="background-color: #FFF;
                                height:auto;
                                display: flex;
                                align-items: center;
                                margin-right: 12px;">
                            <img src="{{asset('d/shikkha.jpg')}}" alt="" width="45" height="45" style="border-radius:50px;margin-left:20px">
                            <p class="name" style="margin: 0 0 0 20px;
                
                font-family: 'Montserrat', sans-serif;
                font-size: 13pt;
                color: #515151;">

                                Token: <strong><span id="token_name"></span></strong></p>
                        </div>
                    </div>
                    <div class="card-body" style="height:445px;overflow: scroll;"">
                        <div id="dataLoad">
                        </div>
                        </div>
                        <div class="card-footer">
                                <form id="myForm" enctype="multipart/form-data">
                                    @csrf
                                    <div class="row" >
                                        <div class="col-1">
                                            <label for="attachment" style="font-size: 20px;margin-top:20px" onmouseover="this.style.color = '#007bff';" onmouseout="this.style.color = '#ccc';"><i class="bi bi-plus-circle-fill"></i></label>
                                            <input type="file" name="attachment" multiple id="attachment" style="display:none;">
                                        </div>
                                        <div class="col-9">
                                            <input type="text" name="message" placeholder="Write Your Reply" class="form-control" style="border:none;width:100%;height:100%;padding:2%">
                                            <input type="hidden" id="ticket_id" name="ticket_id">

                                        </div>
                                        <div class="col-2">
                                            <button type="submit" class="" style="border: none !important;background:transparent">
                                                <i style="font-size:50px;color:#665dfe" class="bi bi-arrow-right-circle-fill"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                    ￼

            </section>
        </div>
    </div>
</main>
@endsection
@push('js')

<script>
    $(document).ready(function() {
        $('#myForm').submit(function(e) {
            e.preventDefault();
            var formData = new FormData(this);
            $.ajax({
                url: "{{ route('tokenReply.create.post') }}",
                type: "POST",
                data: formData,
                contentType: false,
                processData: false,
                success: function(response) {
                    console.log(response.message);

                    $('#myForm')[0].reset();
                    loadData($("#ticket_id").val());
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });



    function loadData(para) {
        $("#ticket_id").val(para);

        $.ajax({
            url: "{{ route('ticketmessage.load.show', ':id') }}".replace(':id', para),
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                console.log(response);
                var html = '';
                response.forEach(function(item) {
                    $("#token_name").text(item.ticket.token);



                    if (item.attachment == null) {
                        if (item.assign_id_user == null) {
                            var createdAt = new Date(item.created_at);
                            var formattedDate = createdAt.toLocaleString();
                            html +=
                                '<div style="display: flex; align-items: flex-start; margin-bottom: 10px;">' +
                                '<img src="' + item.assign_admin.admin_logo + '"  style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">' +
                                ' <p style="max-width:60%;background-color: #e1f5fe; padding: 10px; border-radius: 10px;">' + item.message + '</p>' +
                                '</div>'
                        } else {
                            var createdAt = new Date(item.created_at);
                            var formattedDate = createdAt.toLocaleString();
                            html +=
                                '<div style="display: flex; align-items: flex-start; margin-bottom: 10px;">' +
                                '<p style="max-width:60%;background-color: #dcf8c6; padding: 10px; border-radius: 10px; margin-left: auto;">' + item.message + '</p>' +
                                '<img src="' + item.assign_user.school_logo + '" alt="Profile Image" style="width: 40px; height: 40px; border-radius: 50%; margin-left: 10px;">' +
                                '</div>'
                        }
                    } else {
                        if (item.assign_id_user == null) {
                            var createdAt = new Date(item.created_at);
                            var formattedDate = createdAt.toLocaleString();
                            if (item.message == null) {
                                html +=
                                    '<div>' +
                                    '<div style="display: flex; align-items: flex-start; margin-bottom: 10px;">' +
                                    '<img src="' + item.assign_admin.admin_logo + '" alt="Profile Image" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">' +
                                    '<div>' + '<img style="width:120px; height:100px" src=" ' + item.attachment + '">' + '</div>' +
                                    '</div>'
                            } else {
                                html +=
                                    '<div>' +
                                    '<div style="display: flex; align-items: flex-start; margin-bottom: 10px;">' +
                                    '<img src="' + item.assign_admin.admin_logo + '" alt="Profile Image" style="width: 40px; height: 40px; border-radius: 50%; margin-right: 10px;">' +
                                    ' <p style="max-width:60%;background-color: #e1f5fe; padding: 10px; border-radius: 10px;">' + item.message + '</p>' +
                                    '</div>' +
                                    '<div>' + '<img style="width:120px; height:100px;margin-bottom:10px; margin-left: 10%;" src=" ' + item.attachment + '">' + '</div>' +
                                    '</div>'
                            }
                        } else {
                            var createdAt = new Date(item.created_at);
                            var formattedDate = createdAt.toLocaleString();
                            if (item.message == null) {
                                html += '<div>' +
                                    '<div style="display: flex; align-items: flex-start; margin-bottom: 10px;">' +
                                    '<p style="max-width:60%;background-color:white; padding: 10px; border-radius: 10px; margin-left: auto;">' + '</p>' +
                                    '<img  src="' + item.assign_user.school_logo + '" style="width: 40px; height: 40px; border-radius: 50%; margin-left: 10px;">' +
                                    '</div>' +
                                    '<div>' +
                                    '<div>' + '<img style="width:120px;margin-bottom:5px; height:100px; margin-left: 60%;" src=" ' + item.attachment + '">' + '</div>' +
                                    '</div>'
                            } else {
                                html += '<div>' +
                                    '<div style="display: flex; align-items: flex-start; margin-bottom: 10px;">' +
                                    '<p style="max-width:60%;background-color: #dcf8c6; padding: 10px; border-radius: 10px; margin-left: auto;">' + item.message + '</p>' +
                                    '<img  src="' + item.assign_user.school_logo + '" style="width: 40px; height: 40px; border-radius: 50%; margin-left: 10px;">' +
                                    '</div>' +
                                    '<div>' +
                                    '<div>' + '<img style="width:120px;margin-bottom:5px; height:100px; margin-left: 60%;" src=" ' + item.attachment + '">' + '</div>' +
                                    '</div>'
                            }
                        }
                    }
                });
                $('#dataLoad').html(html);
            }
        });

    }


    setInterval(() => {
        loadData($("#ticket_id").val());
    }, 1000)


   
</script>
@endpush