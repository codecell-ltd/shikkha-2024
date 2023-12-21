@extends('layouts.school.master')
@section('content')
    <main class="page-content">
        <style>
            .write-message:focus-visible {
                outline: none !important;
            }
        </style>

        <div class="container"
            style="padding: 0;background-color: #FFF; box-shadow: 0 10px 20px rgba(0, 0, 0, 0.19), 0 6px 6px rgba(0, 0, 0, 0.23);
                height: 700px;">
            <div class="row" style="">

                <section class="discussions"
                    style="width: 35%; height: 700px; box-shadow: 0px 8px 10px rgba(0, 0, 0, 0.20);
                overflow: hidden; background-color: #e1e2e3;  display: inline-block;padding-left: 0px;
                padding-right: 0px;">
                    <div class="discussion search"
                        style="width: 100%;
                height: 90px;
                background-color: #FAFAFA;
                border-bottom: solid 1px #E0E0E0;
                display: flex;
                align-items: center;
                cursor: pointer;">
                        {{-- <div class="searchbar">
                            <i class="fa fa-search" aria-hidden="true"></i>
                            <input type="text" placeholder="Search..."></input>
                        </div> --}}
                    </div>
                    <div class="discussion message-active"
                        style="width: 100%; height: 90px;background-color: #ffffff; border-bottom: solid 1px #E0E0E0;display: flex;align-items: center; cursor: pointer;">
                        <div class="photo" style="margin-left: 20px;
                                    display: block;">
                            <img src="https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg"
                                alt="" width="45" height="45" style="border-radius:50px">

                        </div>
                        <div class="desc-contact"
                            style="height: 43px;
                                width: 50%;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;">
                            <p class="name"
                                style="margin: 0 0 0 20px;
                                        font-family: 'Montserrat', sans-serif;
                                        font-size: 11pt;
                                        color: #515151;">
                                Megan Leib</p>
                            <p class="message"
                                style="margin: 6px 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 9pt;
                color: #515151;">
                                9 pm at the bar if possible 😳</p>
                        </div>
                        <div class="timer"
                            style="margin-left: 15%;
                font-family: 'Open Sans', sans-serif;
                font-size: 11px;
                padding: 3px 8px;
                color: #BBB;
                background-color: #FFF;
                border: 1px solid #E5E5E5;
                border-radius: 15px;">
                            12 sec</div>
                    </div>

                    <div class="discussion"
                        style="width: 100%; height: 90px;background-color: #FAFAFA; border-bottom: solid 1px #E0E0E0;display: flex;align-items: center; cursor: pointer;">
                        <div class="photo" style="margin-left: 20px;
                                    display: block;">
                            <img src="https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg"
                                alt="" width="45" height="45" style="border-radius:50px">

                        </div>
                        <div class="desc-contact"
                            style="height: 43px;
                                    width: 50%;
                                    white-space: nowrap;
                                    overflow: hidden;
                                    text-overflow: ellipsis;">
                            <p class="name"
                                style="margin: 0 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 11pt;
                color: #515151;">
                                Dave Corlew</p>
                            <p class="message"
                                style="margin: 6px 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 9pt;
                color: #515151;">
                                Let's meet for a coffee or something today ?</p>
                        </div>
                        <div class="timer"
                            style="margin-left: 15%;
                font-family: 'Open Sans', sans-serif;
                font-size: 11px;
                padding: 3px 8px;
                color: #BBB;
                background-color: #FFF;
                border: 1px solid #E5E5E5;
                border-radius: 15px;">
                            3 min</div>
                    </div>



                    <div class="discussion"
                        style="width: 100%; height: 90px;background-color: #FAFAFA; border-bottom: solid 1px #E0E0E0;display: flex;align-items: center; cursor: pointer;">
                        <div class="photo" style=" margin-left: 20px;
                                    display: block;">
                        </div>

                        <img src="https://images.unsplash.com/photo-1541747157478-3222166cf342?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=967&q=80"
                            alt="" width="45" height="45" style="border-radius:50px">
                        <div class="desc-contact"
                            style="height: 43px;
                                width: 50%;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;">
                            <p class="name"
                                style="margin: 0 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 11pt;
                color: #515151;">
                                Billy Southard</p>
                            <p class="message"
                                style="margin: 6px 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 9pt;
                color: #515151;">
                                Ahahah 😂</p>
                        </div>
                        <div class="timer"
                            style="margin-left: 15%;
                font-family: 'Open Sans', sans-serif;
                font-size: 11px;
                padding: 3px 8px;
                color: #BBB;
                background-color: #FFF;
                border: 1px solid #E5E5E5;
                border-radius: 15px;">
                            4 days</div>
                    </div>

                    <div class="discussion"
                        style="width: 100%; height: 90px;background-color: #FAFAFA; border-bottom: solid 1px #E0E0E0;display: flex;align-items: center; cursor: pointer;">
                        <div class="photo" style="margin-left: 20px;
                                    display: block;">
                            <img src="https://images.unsplash.com/photo-1435348773030-a1d74f568bc2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80"
                                alt="" width="45" height="45" style="border-radius:50px">
                            <div class="online"></div>
                        </div>
                        <div class="desc-contact"
                            style="height: 43px;
                                width: 50%;
                                white-space: nowrap;
                                overflow: hidden;
                                text-overflow: ellipsis;">
                            <p class="name"
                                style="margin: 0 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 11pt;
                color: #515151;">
                                Paul Walker</p>
                            <p class="message"
                                style="margin: 6px 0 0 20px;
                font-family: 'Montserrat', sans-serif;
                font-size: 9pt;
                color: #515151;">
                                You can't see me</p>
                        </div>
                        <div class="timer"
                            style="margin-left: 15%;
                font-family: 'Open Sans', sans-serif;
                font-size: 11px;
                padding: 3px 8px;
                color: #BBB;
                background-color: #FFF;
                border: 1px solid #E5E5E5;
                border-radius: 15px;">
                            7 days</div>
                    </div>
                </section>
                <section class="chat" style="width: 65%;padding-left: 0px;
                padding-right: 0px;">
                    <div class="header-chat"
                        style="background-color: #FFF;
                                height: 90px;
                                display: flex;
                                align-items: center;
                                border-bottom: 1px solid #ddd;
                                margin-right: 12px;">
                        <img src="https://images.unsplash.com/photo-1435348773030-a1d74f568bc2?ixlib=rb-1.2.1&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1050&q=80"
                            alt="" width="45" height="45" style="border-radius:50px;margin-left:20px">
                        <p class="name"
                            style="margin: 0 0 0 20px;
                text-transform: uppercase;
                font-family: 'Montserrat', sans-serif;
                font-size: 13pt;
                color: #515151;">
                            Megan Leib</p>
                    </div>
                    <div class="messages-chat" style="padding: 25px 35px;">
                        <div class="message" style="display:flex;align-items: center;margin-bottom: 8px;">
                            <div class="photo" style="display: block;">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"
                                    alt="" width="45" height="45" style="border-radius:50px;">
                                <div class="online"></div>
                            </div>
                            <p class="text"
                                style="margin: 0 35px;background-color: #f6f6f6;padding: 15px;border-radius: 12px"> Hi,
                                how are you ? </p>
                        </div>
                        <div class="message text-only" style=" margin-left: 45px;">
                            <p class="text"
                                style="margin: 0 35px;background-color: #f6f6f6;padding: 15px;border-radius: 12px"> What
                                are you doing tonight ? Want to go take a drink ?</p>
                        </div>
                        <p class="time"
                            style="font-size: 10px;
                            color: lightgrey;
                            margin-bottom: 10px;
                            margin-left: 85px;">
                            14h58</p>
                        <div class="message text-only" style="display:flex;align-items: center;margin-bottom: 8px;">
                            <div class="response"
                                style="float: right;
                margin-right: 0px !important;
                margin-left: auto;">
                                <div class="photo" style="display: block;">
                                    <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"
                                        alt="" width="45" height="45" style="border-radius:50px;">
                                </div>
                                <p class="text"
                                    style="margin: 0 35px;background-color: #f6f6f6;padding: 15px;border-radius: 12px;background-color: #f8bafd !important;">
                                    Hey
                                    Megan ! It's been a while 😃</p>
                            </div>
                        </div>
                        <div class="message text-only" style="display:flex;align-items: center;margin-bottom: 8px;">
                            <div class="response"
                                style="float: right;
                margin-right: 0px !important;
                margin-left: auto;">
                                <p class="text"
                                    style="margin: 0 35px;background-color: #f6f6f6;padding: 15px;border-radius: 12px;background-color: #f8bafd !important;">
                                    When can we meet ?</p>
                            </div>
                        </div>
                        <p class="response-time time"
                            style="float: right;
                            margin-right: 40px !important;font-size: 10px;
                            color: lightgrey;
                            margin-bottom: 10px;
                            margin-left: 85px;">
                            15h04</p>
                        <div class="message" style="display:flex;align-items: center;margin-bottom: 8px;">
                            <div class="photo" style="display: block;">
                                <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80"
                                    alt="" width="45" height="45" style="border-radius:50px;">
                                <div class="online"></div>
                            </div>
                            <p class="text"
                                style="margin: 0 35px;background-color: #f6f6f6;padding: 15px;border-radius: 12px"> 9 pm at
                                the bar if possible 😳</p>
                        </div>
                        <p class="time"
                            style="font-size: 10px;
                color: lightgrey;
                margin-bottom: 10px;
                margin-left: 85px;">
                            15h09</p>
                    </div>
                    <div class="footer-chat"
                        style=" width: 65%;
                height: 110px;
                display: flex;
                align-items: center;
                position: absolute;
                bottom: 0;
                background-color: transparent;
                border-top: 2px solid #EEE;">
                        <i class="icon fa fa-smile-o clickable" style="font-size:25pt;cursor: pointer;"
                            aria-hidden="true"></i>
                        <input type="text" class="write-message" placeholder="Type your message here"
                            style="border: none !important;
                width: 60%;
                height: 50px;
                margin-left: 20px;
                margin-top: -20px;
                padding: 10px;">
                        <i class="icon send fa fa-paper-plane-o clickable" style="cursor: pointer;"
                            aria-hidden="true"></i>
                    </div>
                </section>
            </div>
        </div>
    </main>
@endsection
@push('js')
@endpush
