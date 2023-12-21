<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Monthly Summary - School Management System</title>


    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Pacifico&family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap");

        @import url("https://fonts.googleapis.com/css2?family=Lora:wght@700&family=Open+Sans:ital,wght@0,300;0,400;0,500;0,600;0,700;0,800;1,300;1,400;1,500;1,600;1,700;1,800&family=Pacifico&family=Poppins:ital,wght@0,200;0,400;0,500;0,600;0,700;0,800;0,900;1,800&display=swap");

        /* Reset some default styles */
        body,
        h1,
        p {
            margin: 0;
            padding: 0;
        }

        /* Set the background color and text color */
        body {
            background-color: #f4f4f4;
            color: #333;
            font-family: "Pacifico", cursive;
            font-family: "Poppins", sans-serif;
        }

        /* Create a container to center the content */
        .container {
            max-width: 600px;
            margin: 0 auto;
            padding: 0px;
        }

        .container-bg {
            max-width: 650px;
            margin: 0 auto;
            padding: 0px;
            border: 2px solid #9614c4;
            background-image: url('{{ $message->embed(public_path('emailimg/bgemail.png')) }}');
            background-size: cover;
            background-repeat: no-repeat;
        }

        /* Add a header with a background color */
        .header {
            color: #000;
        }

        .v-text-align {
            font-size: 14px;
            line-height: 220%;
            text-align: left;
            word-wrap: break-word;
            padding-top: 25px;
            padding-bottom: 25px;
        }

        .btn {
            background: #9614c4;
            color: #fff;
            text-decoration: none;
            padding: 3px 4px;
            border-radius: 5px;
        }

        .list {
            margin-left: -35px;
        }

        .list li {
            display: inline;
            padding-right: 5px;
        }

        /* Style the footer */
        .footer {
            text-align: center;
            padding-top: 20px;
            color: #000;
            padding-bottom: 15px;
        }
    </style>
</head>

<body>
    <div class="container-bg">
        <div class="container">
            <div class="text-center">
                <div style="padding-top:20px">
                    <img src="{{ $message->embed(public_path('frontend/assets/img/logo/image-5.png'), 'image/jpeg', 'inline') }}"
                        alt="Shikkha Logo" width="90">
                </div>
                <div style="">
                    <h1 style="font-family:'Lora' , serif; font-size: 25px;">Monthly Summary Reports</h1>
                    <p style="font-size:15px">Hello {{ $AdminName[0] }} !</p>
                    <p style="font-size:15px">This is your update for March 2022.</p>
                </div>
                <div style="width: 25%"></div>
            </div>
        </div>

        <div class="container">
            <hr style="height:2px;background-color:#9614c4;margin-top:25px">
            <div style="display: flex">
                <div style="width:50%">
                    <p style="font-size: 15px;margin-top:15px">Lorem ipsum dolor sit amet, consec tetur adip iscing
                        elit,
                        sed do
                        eiusmod tempor incid idunt ut
                        labore et dolore magna aliqua. Quis ipsum suspend isse ultrices gravida. Risus commodo viverra
                        dolore magna ali incid idunt ut labore. </p>
                </div>
                <div style="width:50%">
                    <div style="float:right">
                        <img src="{{ $message->embed(public_path('emailimg/image-8.png'), 'image/jpeg', 'inline') }}"
                            alt="Shikkha Logo" width="220">
                    </div>
                </div>
            </div>
        </div>
        <div class="container" style="padding-top:15px">
            <h2 style="display: inline;font-weight:500">Your Growth in March</h2>
            <table width="100%" cellpadding="0" cellspacing="0">
                <tr>
                    <td width="33.33%" style="border-right: 1px solid #000; text-align: center;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 15px 0;">
                                    <h4 style="font-weight: bold; color: #9614c4;display:inline;font-size:20px">
                                        {{ $totalStudents }} Person</h4>
                                    <p style="font-size:17px">New Student</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="33.33%" style="border-right: 1px solid #000; text-align: center;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 15px 0;">
                                    <h4 style="font-weight: bold; color: #9614c4;display:inline;font-size:20px">
                                        {{ $totalTeachers }} Person</h4>
                                    <p style="font-size:17px">New Teacher</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="33.33%" style="text-align: center;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 15px 0;">
                                    <h4 style="font-weight: bold; color: #9614c4;display:inline;font-size:20px">
                                        {{ substr(strstr($percentageTeacherAttendece, '.'), 0, 3) }} %</h4>
                                    <p style="font-size:17px">Teacher Attendance</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table width="100%" cellpadding="0" cellspacing="0" style="margin-top:25px;">
                <tr>
                    <td width="33.33%" style="border-right: 1px solid #000; text-align: center;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 15px 0;">
                                    <h4 style="font-weight: bold; color: #9614c4;display:inline;font-size:20px">
                                        {{ substr(strstr($percentageStudentAttendece, '.'), 0, 3) }} %</h4>
                                    <p style="font-size:17px">Student Attendence</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="33.33%" style="border-right: 1px solid #000; text-align: center;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 15px 0;">
                                    <h4 style="font-weight: bold; color: #9614c4;display:inline;font-size:20px">
                                        {{ $expense }} ৳</h4>
                                    <p style="font-size:17px">Total Expense</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                    <td width="33.33%" style="text-align: center;">
                        <table width="100%" cellpadding="0" cellspacing="0">
                            <tr>
                                <td style="padding: 15px 0;">
                                    <h4 style="font-weight: bold; color: #9614c4;display:inline;font-size:20px">
                                        {{ $fund }} ৳</h4>
                                    <p style="font-size:17px">Total Fund</p>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>

        </div>
        <div class="container">
            <div style="margin:40px 0px">
                <a href="" class="btn">Learn more</a>
            </div>
        </div>
        <div class="container">
            <div style="margin:25px 0px">
                <p style="font-size: 14px">Phone:1(234) 456-7890</p>
                <p style="font-size: 14px">Address:2261 Market Street #4667 San Francisco, CA 94114</p>
            </div>
            <div class="list">
                <ul>
                    <li><a href=""><img
                                src="{{ $message->embed(public_path('emailimg/image-1.png'), 'image/jpeg', 'inline') }}"
                                alt="Shikkha Logo" width="30"></a></li>
                    <li><a href=""><img
                                src="{{ $message->embed(public_path('emailimg/image-2.png'), 'image/jpeg', 'inline') }}"
                                alt="Shikkha Logo" width="30"></a></li>
                    <li><a href=""><img
                                src="{{ $message->embed(public_path('emailimg/image-3.png'), 'image/jpeg', 'inline') }}"
                                alt="Shikkha Logo" width="30"></a></li>
                    <li><a href=""><img
                                src="{{ $message->embed(public_path('emailimg/image-4.png'), 'image/jpeg', 'inline') }}"
                                alt="Shikkha Logo" width="30"></a></li>
                </ul>
            </div>
        </div>
        <div class="footer">
            <p>
                Thank you for being with
                <a style="color: #9614c4; font-weight: bold;text-decoration:none;"
                    href="https://shikkha.one/">Shikkha</a>
            </p>
        </div>
    </div>

</body>

</html>
