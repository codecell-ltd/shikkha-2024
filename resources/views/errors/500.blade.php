<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Shikkha</title>
        <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg" />
        <style>
        @import url('https://fonts.googleapis.com/css2?family=Pacifico&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap');

            body {
                font-size: 14px;
                color: #4c5258;
                letter-spacing: .5px;
                font-family: 'Pacifico', cursive;
                font-family: 'Poppins', sans-serif;
                background-color: #fff;
                overflow-x: hidden;
            }
        </style>
    </head>
    <body>
        <center>
            <div class="card">
                <div class="card-body">
                    <img src="{{asset('frontend/assets/img/error/500-cb.gif')}}" alt="" width="600px;" height="400px;" srcset="">
                    <h1 style="padding: 0px;margin: 0px;">Somthing went wrong.</h1>
                    <p>Please contact to our support team.</p>
                </div>
                <div class="card-body">
                    
                </div>
            </div>
        
            <div class="card">
                <div class="card-body" >
                    
                    <a href="javascript:void(0);" onclick="goBack()"><button style="border-radius: 10px; height:50px; width:150px; font-size:18px; background-color: blueviolet; color:#ffffff;">Go Back</button></a>
                </div>
            </div>
        </center>
        
        
        <script>
        function goBack() {
            window.history.back();
        }
        </script>
    </body>
</html>




