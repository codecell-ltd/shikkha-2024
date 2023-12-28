<script>

    window.onload = () => {
        updateDeviceConnectedUsers();
    }

    /** -------------   Update connected Users
     * =================================================== **/
    const updateDeviceConnectedUsers = () => {
        // $("#loader").modal('show');

        $.ajax({
            url: "/v2/update/device-conected-users",
            type: "POST",
            data: {
                "_token": "{{csrf_token()}}",
            },
            beforeSend: () => {
                $("#loader").modal('show');
            },
            success: (resp) => {
                $("#loader").modal('hide');
                console.log(resp);
                initDataTable();
            },
            error: (error) => {
                $("#loader").modal('hide');
                initDataTable();
                console.log(error.responseJSON.message);
            }
        });
    }


    
    /** -------------   Load Data table
     * =================================================== **/
    let loadDataTable = (data) => {
        let users = ``;
        var connectedUser = 0;
        var totalUser = data.length;
        var connectedArray = [];
        var disConnectedArray = [];

        if(data.length > 0)
        {
            data.forEach((item, index) => {
                let shift,image;
                let connected = `<span class="badge bg-danger text-uppercase">NONE</span>`;

                if(item['shift'] == 1)
                {
                    shift = "Morning";
                }
                else if(item['shift'] == 2)
                {
                    shift = "Day";
                }
                else if(item['shift'] == 3)
                {
                    shift = "Evening";
                }
                else
                {
                    shift = "Not Defined";
                }

                if(item['image'] == null)
                {
                    image = 'd/no-img.png';
                }
                else
                {
                    image = item['image'];
                }

                if(item['device_connected'])
                {
                    ++connectedUser;
                    connected = '<span class="badge bg-success text-uppercase">connected</span>'
                }
                else
                {
                    connectedArray.push()
                }
                
                users += `<tr>
                        <td>${++index}</td>
                        <td>
                            <div class="d-flex gap-3 align-items-center">
                                <img src="${image}" alt="${item['full_name']}" style="height: 50px; width: 50px">
                                
                                <div>
                                    <p class="m-0">Name: ${item['full_name']}</p>
                                    <p class="m-0">Phone: ${item['phone']}</p>
                                    <p class="m-0">UID: ${item['unique_id']}</p>
                                </div>
                            </div>
                        </td>
                        <td>
                            <span class="badge bg-primary text-uppercase">${shift}</span>
                        </td>
                        
                        <td>
                            ${connected}
                        </td>
                    </tr>`;
            });
        }
        else
        {
            users = `<tr align="center">
                    <td colspan="6" class="text-muted">No Record Found</td>
                </tr>`;
        }

        $("#userListId").html(users);
        $("#connected_user_card").text(connectedUser);
        $("#disconnected_user_card").text(totalUser - connectedUser);
    }


    /** -------------   INIT DATATABLE
     * =================================================== **/
    let initDataTable = () => {
        $.ajax({
            url: "{{url()->current()}}",
            type: "GET",
            data: {},
            beforeSend: () => {
                $("#loader").modal('show');
            },
            success: (resp) => {
                // console.log(resp.data.users);
                loadDataTable(resp.data.users);
                $("#loader").modal('hide');
            },
            error: (error) => {
                $("#loader").modal('hide');
                Swal.fire({
                    icon: 'error',
                    title: 'Server Error',
                    text: error.responseJSON.message,
                });
            }
        });
    }
    

</script>