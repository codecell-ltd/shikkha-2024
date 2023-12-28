@push('css')
<link rel="stylesheet" href="https://code.jquery.com/ui/1.13.1/themes/base/jquery-ui.css">

@endpush
@section('content')
<!--start content-->
<main class="page-content">
    <div class="row">
        <div class="col-md-8 mx-auto mt-5">
            <h3 class="text-center mt-3 mb-3 text-primary"></h3>
            <div class="card " style="box-shadow:4px 3px 13px  .13px #bf52f2;border-radius:5px">
                <div class="card-head">
                    <h3>Hello!</h3>
                </div>
                <div class="card-body">
                    <div class="border p-3 rounded">
                        <p>You are receiving this email because you have a task Schedule Today</p>

                        <div class="div">
                            <h3>Reminder Message:   {{$data1['reminder_message']}}</h3>

                        </div>
                        <div class="div">
                            <h3>Task :    {{$data1['task_name']}}</h3>
                            
                        </div>
                        <p>
                            Regards,
                        </p>
                        <p><a style="color: purple;" href="https://shikkha.one/">Shikkha</a></p>

                    </div>
                </div>
            </div>
        </div>
    </div>