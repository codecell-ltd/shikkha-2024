@extends('layouts.school.master')

@section('content')
<!--start content-->
<style>
    /* Style the modal container */
    .modal {
        display: none;
        position: fixed;
        z-index: 1;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        overflow: auto;
    }

    /* Style the modal content */
    .modal-content {
        background-color: white;
        margin: 15% auto;
        padding: 20px;
        border: 1px solid #888;
        width: 80%;
        max-width: 600px;
    }

    /* Style the close button (x) */
    .close {
        float: right;
        font-size: 20px;
    }

    .close:hover,
    .close:focus {
        color: #000;
        text-decoration: none;
        cursor: pointer;
    }
</style>
<style>
    .calendar {
        padding: 5px;
        background-color: #f8f9fa;
    }

    .calendar th,
    .calendar td {
        text-align: center;
    }

    .calendar .today {
        background-color: #007bff;
        color: #fff;
    }

    .calendar .selected-date {
        background-color: #28a745;
        color: #fff;
    }
</style>
<style>
    .hour-list {
        font-family: Arial, sans-serif;
        margin-top: 20px;
    }

    .hour-list h2 {
        font-size: 24px;
    }

    .hour-list ul {
        list-style-type: none;
        padding: 0;
    }

    .hour-list li {
        margin-bottom: 10px;
    }
</style>
<style>
    .scrollable-div {
        height: 500px;
        overflow: auto;
    }

    #div1::-webkit-scrollbar {
        width: 8px;
    }

    #div1::-webkit-scrollbar-thumb {
        background-color: #888;
    }

    #div2::-webkit-scrollbar {
        width: 12px;
    }

    #div2::-webkit-scrollbar-thumb {
        background-color: #ccc;
    }
</style>
<main class="page-content" id="updated-content">

    <div class="row">
        <div class="col-md-8 scrollable-div" id="div1">
            <h4>My Work</h4>
            <div style="background-color:white">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-home-tab" data-bs-toggle="pill" data-bs-target="#pills-home" type="button" role="tab" aria-controls="pills-home" aria-selected="true">To do</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-comment-tab" data-bs-toggle="pill" data-bs-target="#pills-comment" type="button" role="tab" aria-controls="pills-comment" aria-selected="false">Comments</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-contact-tab" data-bs-toggle="pill" data-bs-target="#pills-contact" type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Done</button>
                    </li>
                </ul>
            </div>
            <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab" tabindex="0">

                    <div style="margin-top: 30px;" class="dropdown">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="">
                            Today </a>
                        <div class="dropdown-menu" id="dropdown-container">
                            <div id="item-dropdown1"></div>
                        </div>
                    </div>



                    <div style="margin-top: 30px;" class="dropdown">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="">
                            OverDue </a>
                        <div class="dropdown-menu" id="dropdown-container">
                            <div id="item-dropdown2"></div>
                        </div>
                    </div>
                    <div style="margin-top: 30px;" class="dropdown">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="">
                            Next </a>
                        <div class="dropdown-menu" id="dropdown-container">
                            <div id="item-dropdown3"></div>
                        </div>
                    </div>
                    <div style="margin-top: 30px;" class="dropdown">
                        <a class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false" href="">
                            Unschedul </a>
                        <div class="dropdown-menu" id="dropdown-container">
                            <div id="item-dropdown4"></div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-comment" role="tabpanel" aria-labelledby="pills-comment-tab" tabindex="0">
                    <div style="height: 400px;width:585px;background-color:#f8f9fa;border-color:#888">
                        <center>
                            <img style="height: 250px;width: 300px;margin-top: 50px;margin-bottom:20px" src="{{asset('frontend/assets/img/page-title/todo.png')}}" alt="">
                        </center>
                        <center>
                            <h4>Woohoo, you're all done!</h4>
                            <p>Tasks and Reminders that are scheduled for Today will appear here.</p>
                        </center>
                    </div>
                </div>
                <div class="tab-pane fade" id="pills-contact" role="tabpanel" aria-labelledby="pills-contact-tab" tabindex="0">


                    <div id="data-container">
                    </div>


                </div>
            </div>
        </div>
        <div class="col-md-4" id="calendar">








        </div>

        <div><button class="btn btn-primary" style="float:right" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">+ task</button>
            <div class="offcanvas offcanvas-end" style="width: 550px;height:430px;margin-top:50px;margin-left:10px" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
                <div class="offcanvas-header">
                    <div class="offcanvas-body">

                        <form id="myForm" enctype="multipart/form-data">
                            @csrf
                            <input style="width: 480px;margin-top:20px;margin-bottom:20px" required class="form-control" name="task_name" id="task_name" type="text" placeholder="Task Name…">
                            <label for="">Assgn Teacher(If Want)</label>
                            <select class="form-control" name="assign_teacher_id" id="assign_teacher_id" placeholder="" style="text-align:center; width: 150px;border-radius:10px;margin-bottom:25px;background-color:#7a00a7;color:#f8f9fa">
                                <option value="">Select</option>

                                @foreach($teacher as $data)
                                <option style="color: white;background-color:#7a00a7" value="{{$data->id}}">{{$data->full_name}}</option>

                                @endforeach
                            </select>
                            <textarea class="form-control" style="margin-bottom: 20px;" placeholder="Write Someting for command" name="command"></textarea>
                            <div class="row">
                                <div class="col-6">

                                    <label for="">Attachment : </label>
                                    <input type="file" id="attachment" name="attachment" class="form-control" accept="attachment/*">

                                </div>
                                <div class="col-6"> <label for="">set Date</label> <input type="date" name="date" id="dateInput" class="form-control">
                                </div>
                            </div>

                            <button type="submit" style="transform: translateX(110%);margin-top:30px;width: 150px;" class="btn btn-primary">Create task</button>
                        </form>

                    </div>
                </div>
            </div>
        </div>
        <div id="modalContainer" class="modal">
            <div class="modal-content">
                <form id="reminder">
                    @csrf
                    <input type="text" name="reminder_message" class="form-control" placeholder="Reminder Message "><br>
                    <div class="row">
                        <div class="col-6"> <label for="">Reminder Date</label>
                            <input type="date" name="reminder_date" class="form-control">
                        </div>

                        <div class="col-6"> <label for="">Reminder Time</label>
                            <input type="time" name="reminder_time" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="id" id="taskId">
                    <input type="submit" style="margin-top: 20px;transform: translateX(120%);margin-top:30px;width: 150px;" class="btn btn-primary" value="Update">
                </form>
            </div>
        </div>
    </div>
    </div>
</main>
@endsection
@push('js')




<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
//for set todays date in input field
<script>
    const dateInput = document.getElementById('dateInput');
    const today = new Date().toISOString().slice(0, 10);
    dateInput.value = today;

//save data in databse

function hideOffCanvas() {
    $('#offcanvasRight').fadeOut();
} 
    
    $('#myForm').on('submit', function(event) {
        event.preventDefault();
        saveFormData();
    });
    function saveFormData() {
        var formData = $('#myForm').serialize();
            $.ajax({
                url: "{{route('todoList.post')}}",
                type: 'POST',
                data: formData,
                success: function(response) {
                    console.log(response);
                
                    $('#myForm')[0].reset();
                    $('#offcanvasRight').hide();

               hideOffCanvas();
                },
                error: function(error) {
                    console.log(error);
                }
            });
    }
    
  


    //for show reminder modal and save in database
    function reminder(id) {
        var modalContainer = document.getElementById("modalContainer");
        modalContainer.style.display = "block";
        $('#taskId').val(id);
    }
    $('#reminder').on('submit', function(event) {
        event.preventDefault();
        saveFormReminder();
    });
    function saveFormReminder() {
        var formData = $('#reminder').serialize();
            $.ajax({
            url: "/school/todoListreminder/post",
            type: 'POST',
            data: formData,
            success: function(response) {
                console.log(response);
                $('#modalContainer').hide();

            },
            error: function(error) {
                console.log(error);
            }
        });

 
    }


    //for interval
    $(document).ready(function() {
        loadDataFromServer();
    });

    //for loaddata from database
    function loadDataFromServer() {
        $.ajax({
            url: "{{route('loadData.show')}}", // This URL matches the route defined in web.php
            type: "GET",
            dataType: "json",

            success: function(Showdata) {
                displayData(Showdata);
            },
            error: function(xhr, status, error) {
                console.error("Error loading data:", error);
            }
        });
    }
    //display data using lopp
    function displayData(Showdata) {
        var $dataContainer = $("#data-container");
        $.each(Showdata, function(index, user) {
            html = '<div class="card" style="height:40px">' + '<p style="margin-top:10px;margin-left:10px">' + user.task_name + '</p>' + '<button style=" color:purple;position: absolute; right: 0px;" class="btn btn-none"  onclick="deleteTask(' + user.id + ')"><i class="bi bi-trash3-fill"></i> </button> ' + '</div>';
        });
        $dataContainer.html(html);
    }

    loadDataFromServer();
    setInterval(loadDataFromServer, 5000);







    //fetch data with dropdown
    function fetchItems() {
        $.ajax({
            url: '{{route('todo.show')}}',
            type: 'GET',
            dataType: 'json',
            success: function(items) {
                updateDropdown1(items.today);
                updateDropdown2(items.DueDay);
                updateDropdown3(items.next);
                updateDropdown4(items.unschedul);
            },
            error: function(xhr, status, error) {
                console.error('Error fetching items:', status, error);
            }
        });
    }
    //for dropdown
    function updateDropdown1(items) {
        var dropdown = $('#item-dropdown1');
        dropdown.empty();
        if (items.today == null) {
            $.each(items, function(index, item) {
                dropdown.append(
                    html = '<div class="card">' +
                    '<div class="card-body">' +
                    '<div style = "height:10px;width:550px;margin-top:3px >' +
                    '<option value="' + item.command + '">' + item.task_name +
                    '<button style=" color:purple;position: absolute;top: 10px; right: 0px;" class="btn btn-none"  onclick="deleteTask(' + item.id + ')"><i class="bi bi-trash3-fill"></i> </button>       <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 30px;" class="btn btn-none" onclick="status(' + item.id + ')"><i class="bi bi-check2"></i></button>     <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 60px;" onclick="reminder(' + item.id + ')" class="btn btn-none"><i class="bi bi-bell"></i></button></option>' + '</div></div></div>');
            });
        } else {
            dropdown.append(
                html = '<div style="width:600px;height:12px">' + '<p style="margin-left:10px;text-align:center;color:gray">' + 'No Next tasks or Reminders scheduled.' + '</p>' + '</div>');
        }
    }
    //for dropdown
    function updateDropdown4(items) {
        var dropdown = $('#item-dropdown4');
        dropdown.empty();
        if (items.unschedul == null) {
            $.each(items, function(index, item) {
                dropdown.append(
                    html = '<div class="card">' +
                    '<div class="card-body">' +
                    '<div style = "height:10px;width:550px;margin-top:3px >' +
                    '<option value="' + item.command + '">' + item.task_name +
                    '<button style=" color:purple;position: absolute;top: 10px; right: 0px;" class="btn btn-none"  onclick="deleteTask(' + item.id + ')"><i class="bi bi-trash3-fill"></i> </button>       <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 30px;" class="btn btn-none" onclick="status(' + item.id + ')"><i class="bi bi-check2"></i></button>     <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 60px;" onclick="reminder(' + item.id + ')" class="btn btn-none"><i class="bi bi-bell"></i></button></option>' + '</div></div></div>');
            });
        } else {
            dropdown.append(
                html = '<div style="width:600px;height:12px">' + '<p style="margin-left:10px;text-align:center;color:gray">' + 'No Next tasks or Reminders scheduled.' + '</p>' + '</div>');
        }
    }

    function updateDropdown2(items) {
        var dropdown = $('#item-dropdown2');
        dropdown.empty();
        if (items.DueDay == null) {
            $.each(items, function(index, item) {
                dropdown.append(
                    html = '<div class="card">' +
                    '<div class="card-body">' +
                    '<div style = "height:10px;width:550px;margin-top:3px >' +
                    '<option value="' + item.command + '">' + item.task_name +
                    '<button style=" color:purple;position: absolute;top: 10px; right: 0px;" class="btn btn-none"  onclick="deleteTask(' + item.id + ')"><i class="bi bi-trash3-fill"></i> </button>       <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 30px;" class="btn btn-none" onclick="status(' + item.id + ')"><i class="bi bi-check2"></i></button>     <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 60px;" onclick="reminder(' + item.id + ')" class="btn btn-none"><i class="bi bi-bell"></i></button></option>' + '</div></div></div>');
            });
        } else {
            dropdown.append(
                html = '<div style="width:600px;height:12px">' + '<p style="margin-left:10px;text-align:center;color:gray">' + 'No Next tasks or Reminders scheduled.' + '</p>' + '</div>');
        }
    }

    function updateDropdown3(items) {
        var dropdown = $('#item-dropdown3');
        dropdown.empty();
        if (items.next == null) {
            $.each(items, function(index, item) {
                dropdown.append(
                    html = '<div class="card">' +
                    '<div class="card-body">' +
                    '<div style = "height:10px;width:550px;margin-top:3px >' +
                    '<option value="' + item.command + '">' + item.task_name +
                    '<button style=" color:purple;position: absolute;top: 10px; right: 0px;" class="btn btn-none"  onclick="deleteTask(' + item.id + ')"><i class="bi bi-trash3-fill"></i> </button>       <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 30px;" class="btn btn-none" onclick="status(' + item.id + ')"><i class="bi bi-check2"></i></button>     <button style="color:purple;margin-right:0px;position: absolute;top: 10px; right: 60px;" onclick="reminder(' + item.id + ')" class="btn btn-none"><i class="bi bi-bell"></i></button></option>' + '</div></div></div>');
            });
        } else {
            dropdown.append(
                html = '<div style="width:600px;height:12px">' + '<p style="margin-left:10px;text-align:center;color:gray">' + 'No Next tasks or Reminders scheduled.' + '</p>' + '</div>');
        }
    }

    //for delete data 
    function deleteTask(id) {
        $.ajax({
            url: '/school/deletes/task/' + id,
            method: 'GET',
            success: function(response) {
                console.log(response);
                loadItems();
            }
        });
    }
    //for view
    function showData(id) {
        $.ajax({
            url: '/school/show/task/' + id,
            method: 'GET',
            success: function(response) {
                console.log(response);
                loadItems();
            }
        });
    }

    //for update data
    function status(id) {
        $.ajax({
            url: '/school/update/task/' + id,
            method: 'POST',
            data: {
                '_token': "{{csrf_token()}}",
            },
            success: function(response) {
                console.log(response);
                loadItems();
            }
        });
    }
    fetchItems();
    setInterval(fetchItems, 5000);

    //generate calender
    function generateCalendar(year, month, selectedDate) {
        const calendarDiv = document.getElementById('calendar');
        const monthNames = [
            "January", "February", "March", "April", "May", "June",
            "July", "August", "September", "October", "November", "December"
        ];
        const weekdays = ["Sun", "Mon", "Tue", "Wed", "Thu", "Fri", "Sat"];

        const firstDay = new Date(year, month, 1);
        const lastDay = new Date(year, month + 1, 0);
        const totalDays = lastDay.getDate();

        let calendarHTML = `
        <h5>${monthNames[month]} ${year}</h5>
        <table class="table table-bordered">
          <thead>
            <tr>
              ${weekdays.map(day => `<th>${day}</th>`).join('')}
            </tr>
          </thead>
          <tbody>
      `;

        let currentDate = 1;
        for (let week = 0; week < 6; week++) {
            calendarHTML += "<tr>";
            for (let day = 0; day < 7; day++) {
                if ((week === 0 && day < firstDay.getDay()) || currentDate > totalDays) {
                    calendarHTML += "<td></td>";
                } else {
                    const date = new Date(year, month, currentDate);
                    const isToday = date.toDateString() === new Date().toDateString();
                    const isSelected = date.toDateString() === selectedDate.toDateString();
                    const dayClass = isToday ? "today" : isSelected ? "selected-date" : "";

                    calendarHTML += `<td class="${dayClass}" data-date="${year}-${month + 1}-${currentDate}">${currentDate}</td>`;
                    currentDate++;
                }
            }
            calendarHTML += "</tr>";
        }

        calendarHTML += `
          </tbody>
        </table>
      `;

        calendarDiv.innerHTML = calendarHTML;

        // Add click event listener to each date cell
        const dateCells = calendarDiv.querySelectorAll('td');
        dateCells.forEach(cell => {
            cell.addEventListener('click', (event) => {
                const selectedDate = new Date(event.target.dataset.date);
                console.log("Selected date:", selectedDate);
            });
        });
    }

    // Get the current date
    const currentDate = new Date();
    const currentYear = currentDate.getFullYear();
    const currentMonth = currentDate.getMonth();

    // Display the current month's calendar
    generateCalendar(currentYear, currentMonth, currentDate);

</script>



<script>
  $(document).ready(function() {
    function performAjaxRequest() {
      $.ajax({
        url: "{{route('loadData.show')}}",
        data: {
        },
        success: function(data) {
          window.location.reload();
        },
        error: function(xhr, status, error) {
          console.error(error);
        }
      });
    }

    $("#your-button-id").on("click", function() {
      performAjaxRequest();
    });
  });
</script>

<script src="https://unpkg.com/clndr@latest/src/clndr.js"></script>
<script src="js/moment.js" type="text/javascript"></script>
<script src="js/underscore.js" type="text/javascript"></script>
@endpush