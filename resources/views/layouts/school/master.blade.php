<!doctype html>
<?php

use Illuminate\Support\Carbon;
use App\Models\AddonModel;
use App\Models\AddonPurchase;
use App\Models\FeatureList;

$i = 1;
?>
<html lang="en" class=" {{ authUser()->color == 0 ? 'light-theme' : 'dark-theme' }}">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" href="{{ asset('images/favicon.svg') }}" type="image/svg" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
    <!--plugins-->
    <link href="{{ asset('schools/assets/plugins/simplebar/css/simplebar.css') }}" rel="stylesheet" />
    <link href="{{ asset('schools/assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css') }}" rel="stylesheet" />

    <!-- Bootstrap CSS -->
    <link href="{{ asset('schools/assets/css/bootstrap.min.css') }}" rel="stylesheet" />
    <!-- Toastr style -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" />
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> --}}
    <link href="{{ asset('schools/assets/css/bootstrap-extended.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css" />
    <link href="{{ asset('schools/assets/css/icons.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&amp;display=swap" rel="stylesheet">

    <!-- loader-->
    <link href="{{ asset('schools/assets/css/pace.min.css') }}" rel="stylesheet" />

    <!--Theme Styles-->
    <link href="{{ asset('schools/assets/css/dark-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('schools/assets/css/light-theme.css') }}" rel="stylesheet" />
    <link href="{{ asset('schools/assets/css/semi-dark.css') }}" rel="stylesheet" />
    <link href="{{ asset('schools/assets/css/header-colors.css') }}" rel="stylesheet" />
    <link href="{{ asset('schools/assets/css/style.css') }}" rel="stylesheet" />

    {{-- Bootstrap Icons --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.3/font/bootstrap-icons.css">

    <title>
        @hasSection('page_title')
        @php $pageTitle = "Shikkha - ". app()->view->getSections()['page_title']; @endphp
        Shikkha - @yield('page_title')
        @else
        {{ $pageTitle = isset($seo_array['seoTitle']) ? $seo_array['seoTitle'] : 'Shikkha - ' }}
        @endif
    </title>

    <meta name="description" content="{{ isset($seo_array['seoDescription']) ? $seo_array['seoDescription'] : 'Shikkha - ' . authUser()->school_name }}">
    <meta name="keywords" content="{{ isset($seo_array['seoKeyword']) ? $seo_array['seoKeyword'] : 'Shikkha' . authUser()->school_name }}">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Select2 --}}
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    {{-- OwlCarousel css --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />
    {{-- OwlCarousel css --}}

    <link href="{{ asset('schools/assets/plugins/datatable/css/dataTables.bootstrap5.min.css') }}" rel="stylesheet" />


    <link rel="preconnect" href="https://fonts.googleapis.com">

    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <link href="https://fonts.googleapis.com/css2?family=Noto+Sans:wght@400;700&family=Noto+Serif+Vithkuqi:wght@400;600&display=swap" rel="stylesheet">

    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    @stack('css')
    @include('layouts.school.schoolStyle')


    @if(App::getLocale() == 'bn')
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            font-family: 'Hind Siliguri', sans-serif !important;
        }
    </style>
    @else
    <style>
        body,
        h1,
        h2,
        h3,
        h4,
        h5,
        h6,
        p {
            font-family: 'Noto Sans', sans-serif !important;
        }
    </style>
    @endif

    <style>
        .floating-message-button {
            position: fixed;
            bottom: 40px;
            right: 40px;
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background-color: blueviolet;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s ease-in-out;
            z-index: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            color: #fff;
        }

        .floating-message-button:hover {
            transform: translateY(-10px);
        }

        .pace-done {
            background: #eef1f2 !important;
        }

        button.btn.btn-dark.btn-switcher.shadow-sm {
            z-index: 1000;
        }

        .nav-link {
            display: inline;
        }

        .icon-purple {
            color: #7100A7;
            border: 1.5px solid #7100A7;
        }

        @media print {
            .graph-img img {
                display: inline;
            }
        }

        @media print {
            * {
                -webkit-print-color-adjust: exact;
            }
        }

        /* Chrome, Safari, Edge, Opera */
        input::-webkit-outer-spin-button,
        input::-webkit-inner-spin-button {
            -webkit-appearance: none;
            margin: 0;
        }

        /* Firefox */
        input[type=number] {
            -moz-appearance: textfield;
        }

        .primary-btn {
            background-color: blueviolet !important;
            border-color: blueviolet !important;
        }

        .deasableFeature {
            display: none;
        }

        .submenu.active {
            background-color: #7100A7;
            color: #fff
        }
    </style>

</head>

<body>
    <!--start wrapper-->
    <?php

    use Illuminate\Support\Facades\Request;

    $date = Carbon::parse(authUser()->created_at);
    $now = Carbon::now();

    $diff = $date->diffInDays($now);
    $data = 38 - $diff;

    if (isset($pageTitle)) {
        \App\Helper\LogActivity::addToLog($pageTitle);
    }
    ?>

    <!-- modal -->

    <div class="wrapper">
        <!--start top header-->
        <header class="top-header">
            <nav class="navbar navbar-expand">
                <div class="mobile-toggle-icon d-xl-none">
                    <i class="bi bi-list" style="color: #000"></i>
                </div>
                <div class="top-navbar d-none d-xl-block">
                    <ul class="navbar-nav align-items-center">

                    </ul>
                </div>
                {{-- <div class="search-toggle-icon d-xl-none ms-auto">
                    <i class="bi bi-search"></i>
                </div> --}}
                <div class="searchbar d-none d-xl-flex ms-auto">
                    <div class="position-absolute top-50 translate-middle-y search-icon ms-3"></div>

                    {{-- @if (workPlace(authUser()->id)->price_id == 0) --}}
                    {{-- <h5 style="color:red;">{{$diff}} DAYS FREE TRIAL</h5> --}}
                    {{-- @else --}}
                    {{-- @endif --}}

                </div>

                <div class="toggle-ln">
                    <input type="checkbox" id="switch" {{ App::getLocale() === 'bn' ? 'checked' : '' }} name="language">
                    <label for="" class="onbtn">En</label>
                    <label for="" class="offbtn">Bn</label>
                </div>



                {{-- <div class="dropdown bg-primary rounded ms-auto" style="background-color: #7b00a7 !important">
                    <a class="btn btn-sm dropdown-toggle text-light" href="#" role="button"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        EN/বাং
                    </a>

                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="{{ route('change.language', 'bn') }}">Bangla</a></li>
                <li><a class="dropdown-item" href="{{ route('change.language', 'en') }}">English</a></li>
                </ul>
    </div> --}}

    <div class="top-navbar-right ms-3" style="cursor: pointer">
        <ul class="navbar-nav align-items-center">
            <li class="nav-item">
                <a href="{{route("device.index")}}" class="nav-link text-primary"> <i class="bi bi-gear" style="font-size: 25px"></i> </a>
            </li>
            <li class="nav-item">
                <a href="{{route("notice.school.admin.create.show")}}" class="nav-link text-primary"> <i class="bi bi-bell" style="font-size: 25px"></i> </a>
            </li>
            <li class="nav-item dropdown dropdown-large">
                <a class="nav-link dropdown-toggle-nocaret" data-bs-toggle="dropdown">
                    <div class="user-setting d-flex gap-2 align-items-center" style="border: none !important;">
                        <div class="font-weight-bold text-primary text-end">
                            <p class="m-0">{{ authUser()->school_name }}</p>
                            @if (authUser()->root->guard == "school")
                                <p class="m-0"><small>Admin</small></p>
                            @elseif (authUser()->root->guard == "teacher")
                                <p class="m-0"><small>Teacher</small></p>
                            @else
                                <p class="m-0"><small>Student</small></p>                                
                            @endif
                        </div>
                        <div class="user-name d-none d-sm-block mt-50">
                            <img src="{{ asset(authUser()->school_logo) }}" alt="" width="40px" height="40px" class="rounded-circle border">
                            <i class="bi bi-chevron-down" style="font-size:15px;"></i>
                        </div>
                    </div>
                </a>
                <ul class="dropdown-menu dropdown-menu-end">
                    @isset(authUser()->teacher)

                    <li>
                        <a class="dropdown-item" href="{{ route('teacher.account.Information') }}">
                            <div class="d-flex align-items-center">
                                <div class="ms-3 text-center">
                                    <h6 class="mb-0 dropdown-user-name text-center">
                                        {{ __('app.Teacher') }} {{ __('app.Profile') }}
                                    </h6>
                                    <small class="mb-0 dropdown-user-designation text-left">{{ authUser()->name }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    <hr>
                    @else
                    <li>
                        <a class="dropdown-item" href="{{ route('school.profile') }}">
                            <div class="d-flex align-items-center">
                                <div class="ms-3 text-center">
                                    <h6 class="mb-0 dropdown-user-name text-center">
                                        {{ __('app.School') }} {{ __('app.Profile') }}
                                    </h6>
                                    <small class="mb-0 dropdown-user-designation text-left">{{ authUser()->school_name }}</small>
                                </div>
                            </div>
                        </a>
                    </li>
                    {{-- <li><hr class="dropdown-divider"></li>
                                <li>
                                    @if (workPlace()->price_id == 0)
                                    <a class="dropdown-item" href="{{route('school.package.after')}}">
                    <div class="d-flex align-items-center">
                        <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="bi bi-person-fill"></i></div>
                        <div class="setting-text ms-3"><span>{{__('app.All')}} {{__('app.Package')}}</span></div>
                    </div>
                    </a>
                    @else
                    <a class="dropdown-item" href="{{route('school.payment.info')}}">
                        <div class="d-flex align-items-center">
                            <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="fadeIn animated bx bx-money"></i></div>
                            <div class="setting-text ms-3"><span>{{__('app.Paynow')}}</span></div>
                        </div>
                    </a>
                    @endif
            </li>
            --}}
            {{-- <li><hr class="dropdown-divider"></li> --}}
            {{-- <li>
                                    <a class="dropdown-item" href="{{route('school.payment.status')}}">
            <div class="d-flex align-items-center">
                <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="bi bi-person-fill"></i></div>
                <div class="setting-text ms-3"><span>{{__('app.Account')}} {{__('app.Status')}}</span></div>
            </div>
            </a>
            </li> --}}
            {{-- <li><hr class="dropdown-divider"></li>
                                <li>
                                    <a class="dropdown-item" target="_blank" href="{{route('show.notice')}}">
            <div class="d-flex align-items-center">
                <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="bi bi-bell"></i></div>
                <div class="setting-text ms-3"><span>{{__('app.Notice')}}</span></div>
            </div>
            </a>
            </li> --}}
            {{-- <li>
                                    <a class="dropdown-item" target="_blank" href="{{ route('todoList') }}">
            <div class="d-flex align-items-center">
                <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="bi bi-trash3"></i></div>
                <div class="setting-text ms-3"><span>To Do List</span></div>
            </div>
            </a>
            </li> --}}
            <li>
                <hr class="dropdown-divider">
            </li>
            {{-- <li>
                                    <a class="dropdown-item" href="{{ route('school.billingtransaction') }}">
            <div class="d-flex align-items-center">
                <div class="setting-icon" style="background-color:#7b00a7;color:white">৳
                </div>
                <div class="setting-text ms-3"><span>{{ __('app.pricing') }}</span></div>
            </div>
            </a>
            </li> --}}
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" href="{{ route('school.billing') }}">
                    <div class="d-flex align-items-center">
                        <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="bi bi-cash"></i></div>
                        <div class="setting-text ms-3"><span>{{ __('app.billing') }}</span></div>
                    </div>
                </a>
            </li>
            <li>
                <hr class="dropdown-divider">
            </li>
            <li>
                <a class="dropdown-item" target="_blank" href="{{ route('Recyclepage') }}">
                    <div class="d-flex align-items-center">
                        <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="bi bi-trash3"></i></div>
                        <div class="setting-text ms-3"><span>Recycle bin</span></div>
                    </div>
                </a>
            </li>

            {{-- <li>
                                    <a class="dropdown-item" target="_blank"
                                        href="{{ route('ticketCreate.school') }}">
            <div class="d-flex align-items-center">
                <div class="setting-icon" style="background-color:#7b00a7;color:white"><i class="bi bi-briefcase-fill"></i></div>
                <div class="setting-text ms-3"><span>Support</span></div>
            </div>
            </a>
            </li> --}}
            <li>
                <hr class="dropdown-divider">
            </li>
            @endif
            <li>
                <div class="d-flex align-items-center" style="margin-left:250px">
                    <a href="{{ route('logout') }}" class="btn btn-primary" onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">{{ __('app.Logout') }}</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                    <div class="setting-text ms-3">
                    </div>
                </div>
            </li>
        </ul>
        </li>
        </ul>
    </div>
    </nav>
    </header>
    <!--end top header-->

    <!--start sidebar -->
    <aside class="sidebar-wrapper">
        <div class="iconmenu">
            <div class="nav-toggle-box">
                <div class="nav-toggle-icon"><i class="bi bi-list text-white"></i></div>
            </div>
            <ul class="nav nav-pills flex-column" style="align-items: center">


                @if(hasPermission("Dashboard show|Admission Request Show"))
                <x-Sidemenu.dashboard />
                @else
                <x-Sidemenu.dashboard />
                @endif
                @if(hasPermission("Class Show|Section Show|Syllabus Show|Subject Show|Period Show|Routine Show"))
                <x-Sidemenu.class />
                @endif

                @if(hasPermission("student_show"))
                <x-Sidemenu.student />
                @endif


                @if(hasPermission("teacher_show|assign_teacher_show"))
                <x-Sidemenu.teacher />
                @endif

                @if(hasPermission("Staff Type Show|Staff List Show"))
                <x-Sidemenu.staff />
                @endif

                @if(hasPermission("Student Attendance Dashboard|Attendance Take Show|Get Attendance|Upload Attendance|get_attendance|custom_attendance|Get Attendance|teacher_attendance_dashboard
                |teacher_attendance_take_create|
                teacher_view_attendance|
                staff_attendance_take|
                staff_view_attendance"))
                <x-Sidemenu.attendence />
                @endif

                @if(hasPermission("Finance Dashboard|Finance School Fees Show|Finance Assign Fees Show|Collect Fees Show|Staff Salary Show|Teacher Salary Show|Bank Account Show|Expense Show|Expense List Show|Fund Show|Fund List Show|Accesories Show|Student Finance Status Show"))
                <x-Sidemenu.finance />
                @endif

                @if(hasPermission("Result SMS Send|Student SMS Send|Teacher SMS Send|Staff SMS Send"))
                <x-Sidemenu.sms />
                @endif


                @if(hasPermission("Exam Term Show|Exam Routine Show|Question Show|Admit Card Show|Sit Plan Show"))
                <x-Sidemenu.exam />
                @endif

                @if(hasPermission("Result Upload Show|See Result|Result PDF"))
                <x-Sidemenu.result />
                @endif

                @if(hasPermission("Notice Show"))
                <x-Sidemenu.notice />
                @endif

                @if(hasPermission("Borrower Info Show|book_info"))
                <x-Sidemenu.library />
                @endif

                @if(hasPermission("Role Show"))
                <x-Sidemenu.role />
                @endif

                @if(hasPermission("Setting Class Show|Setting Finger Print Show"))
                <x-Sidemenu.setting />
                @endif

                @if(hasPermission("Addon Purchase"))
                <x-Sidemenu.addon />
                @endif
                
                @if(hasPermission("website control"))
                    <x-Sidemenu.website />
                @endif


            </ul>
        </div>

        <div class="textmenu">
            <div class="brand-logo">
                {{-- <h6>{{authUser()->school_name}}<br>
                <button class="btn btn-danger btn-sm" style="font-size: 12px;">
                    {{90-$diff}} days left
                </button>
                </h6> --}}

                @isset(authUser()->teacher)
                    Hi! {{authUser()->teacher->full_name}}
                @endisset
            </div>

            <div class="tab-content">

                {{-- Dashboard --}}
                <div class="tab-pane fade 
                        <?php
                        if ((Request::segment(1) == 'school' and (Request::segment(2) == 'dashboard' or Request::segment(2) == 'online' or Request::segment(2) == 'Recycle') or (Request::segment(3) == 'admission' or Request::segment(3) == 'Recyclepage') or Request::segment(1) == 'school' and Request::segment(2) == 'profile') or (Request::segment(1) == 'teachers')) {
                            echo 'active show';
                        } elseif (Request::segment(2) == 'support') {
                            echo 'active show';
                        }
                        ?>" id="pills-mdashboards">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item sidebar2 ">
                            <div class="d-flex w-100 justify-content-between">
                                @isset(authUser()->teacher)
                                <h6 class="mb-0">{{ __('app.Teacher') }} {{ __('app.dashboard') }}</h6>
                                @else
                                <h5 class="mb-0">{{ __('app.dashboard') }}</h5>
                                @endif

                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        <div>

                            @isset(authUser()->teacher)

                                <a href="{{url('/teachers')}}" class="list-group-item"><i class="fadeIn animated bx bx-home-circle"></i>Dashboard</a>
                                @if(hasPermission("Dashboard Show"))
                                    <a href="{{route('school.dashboard')}}" class="list-group-item"><i class="fadeIn animated bx bx-home-circle"></i>School Dashboard</a>
                                @endif

                                @if(hasPermission("Admission Request Show"))
                                    <a href="{{route('online.Admission.Form.list')}}" class="list-group-item"><i class="fadeIn animated bx bx-home-circle"></i>Admission Request</a>
                                @endif
                                    <a href="{{route('teacher.myClass.show')}}" class="list-group-item"><i class="fadeIn animated bx bx-chalkboard"></i>My Classes</a>
                                    <a href="{{route('all.teachers.attendance.show')}}" class="list-group-item"><i class="fadeIn animated bx bx-folder-open"></i>All Attendance Show</a>
                                    {{-- <a href="{{route('all.teachers.result.show')}}" class="list-group-item"><i class="fadeIn animated bx bx-message-alt-edit"></i>Result</a>
                                    <a href="{{route('all.teachers.student.show')}}" class="list-group-item"><i class="fadeIn animated bx bx-user-check"></i>Student Show</a> --}}
                                    <a href="{{route('all.teachers.routine.show')}}" class="list-group-item"><i class="fadeIn animated bx bx-chalkboard"></i>Routine</a>
                                    <a href="{{route('all.assignment.student.show')}}" class="list-group-item"><i class="fadeIn animated bx bx-calendar-check"></i>Assignment</a>
                            @else
                                @if(hasPermission("Dashboard Show"))
                                    <x-side_submenu.dashboard.school_dashboard />
                                @endif

                                @if(hasPermission("Admission Request Show"))
                                    <x-side_submenu.dashboard.admission />
                                @endif
                                <x-side_submenu.dashboard.session />

                            @endisset
                        </div>
                    </div>
                </div>

    {{-- <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and (Request::segment(2) == 'dashboard' or Request::segment(2) == 'online/admission' )) {
        echo 'active show';
        } ?>" id="pills-mdashboards">

        <div class="list-group list-group-flush">
            <div class="list-group-item">
                <div class="d-flex w-100 justify-content-between">
                    <h5 class="mb-0">{{ __('app.dashboard') }}</h5>
                </div>

            </div>

            <div>
                @if(hasPermission("Dashboard Show"))
                    <x-side_submenu.dashboard.school_dashboard />
                @endif

                @if(hasPermission("admission_request_show"))
                    <x-side_submenu.dashboard.admission />
                @endif

            </div>
        </div>
    </div> --}}



                {{-- Class / Section / Group / Period / routine / syllabus / subject --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and (Request::segment(2) == 'class' or Request::segment(2) == 'section' or Request::segment(2) == 'group' or Request::segment(2) == 'subject' or Request::segment(2) == 'department' or Request::segment(2) == 'routine' or Request::segment(2) == 'period' or Request::segment(2) == 'syllabus' or Request::segment(2) == 'FormShowPost' or Request::segment(2) == 'routine')) {
                                                echo 'active show';
                                            } ?>" id="pills-class">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Class') }}</h5>
                            </div>

                        </div>
                        <div>


                        @if(hasPermission("Class Show"))
                            <x-side_submenu.class.class_show />
                            @endif

                            @if(hasPermission("Section Show"))
                            <x-side_submenu.class.section_show />
                            @endif



                            @if(hasPermission("Syllabus Show"))
                            <x-side_submenu.class.syllabus_show />
                            @endif



                            @if(hasPermission("Subject Show"))
                            <x-side_submenu.class.subject_show />
                            @endif



                            @if(hasPermission("Period Show"))
                            <x-side_submenu.class.class_period />
                            @endif






                            @if(hasPermission("Routine Show"))
                            <x-side_submenu.class.class_routine />
                            @endif




                            {{--
                            @if(hasPermission("school_routine"))
                            <x-side_submenu.class.school_routine />
                            @endif
--}}
                        </div>
                    </div>
                </div>

                {{-- Student --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'student' and (Request::segment(3) == 'show' or Request::segment(3) == 'create' or Request::segment(3) == 'edit' or Request::segment(3) == 'studentshow' or Request::segment(3) == 'student' and Request::segment(4) == 'singleShow') or Request::route()->getName() == 'student.find') {
                                                echo 'active show';
                                            } ?>" id="pills-student">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Student') }}</h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        <div>
                            @if(hasPermission("Student Show"))
                            <x-side_submenu.student.student_show />
                            @endif

                            @if(hasPermission("Student Create"))
                            <x-side_submenu.student.student_create />
                            @endif


                            {{-- <a href="{{route('student.upload')}}" class="list-group-item"><i class="fadeIn animated bx bx-user-plus"></i>{{__('app.Student')}} {{__('app.Upload')}}</a> --}}
                            {{-- <a href="{{route('id.Card')}}" class="list-group-item"><i class="fadeIn animated bx bx-credit-card-alt"></i>Student Id Card</a> --}}
                        </div>

                    </div>
                </div>

                {{-- Teacher --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'teacher') {
                                                echo 'active show';
                                            } ?>" id="pills-teacher">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Teacher') }}</h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        <div>
                            @if(hasPermission("Teacher Show"))
                            <x-side_submenu.teacher.teacher_show />
                            @endif
                            @if(hasPermission("Assign Teacher Show"))
                            <x-side_submenu.teacher.assign_class_teacher />
                            @endif




                        </div>
                    </div>
                </div>

                {{-- Staff --}}
                <div class="tab-pane fade @if (Request::segment(1) == 'school' and Request::segment(2) == 'staff') active show @endif " id="pills-staff">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Stuff') }} </h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}} </small> --}}
                        </div>
                        <div>
                            @if(hasPermission("Staff List Show"))
                            <x-side_submenu.staff.staff_list />
                            @endif
                            @if(hasPermission("Staff Type Show"))
                            <x-side_submenu.staff.staff_type />
                            @endif


                            {{-- <a href="{{route('school.staff.create')}}" class="list-group-item"><i class="bi bi-cast"></i>Staff Type create</a> --}}
                            {{-- <a href="{{route('school.staff.List.create')}}" class="list-group-item"><i class="bi bi-cast"></i>Staff Create</a> --}}
                        </div>

                    </div>
                </div>

                {{-- Attendance --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'student' and (Request::segment(3) == 'attendanceshow' or Request::segment(3) == 'all' and Request::segment(4) == 'attendanceshow' or Request::segment(3) == 'attendance' and Request::segment(4) == 'attendanceshow' or Request::segment(3) == 'attendance' and Request::segment(4) == 'show' or Request::segment(3) == 'attendance' and Request::segment(4) == 'dashboard' or Request::segment(3) == 'attendance' and Request::segment(4) == 'profile' or Request::segment(3) == 'attendance' and Request::segment(4) == 'list') or Request::segment(3) == 'datepage' or Request::segment(3) == 'datepage' or Request::segment(3) == 'StaffAttendancePage' or Request::segment(3) == 'TeacherAttendance' or Request::segment(3) == 'TeacherView' or Request::segment(3) == 'Teacher-Attendance-Month' or Request::segment(2) == 'Staff' and Request::segment(3) == 'Staff' and Request::segment(4) == 'Attendance' or Request::segment(3) == 'StaffAttendance') {
                                                echo 'active show';
                                            } elseif (Request::route()->getName() == 'auto.attendance') {
                                                echo 'active show';
                                            } elseif (Request::route()->getName() == 'input.attendance') {
                                                echo 'active show';
                                            } elseif (Request::route()->getName() == 'StudentDetailsDashboard') {
                                                echo 'active show';
                                            } elseif (Request::route()->getName() == 'teacherDetailsDashboard') {
                                                echo 'active show';
                                            } elseif (Route::is('school.attendance.report') || Route::is('school.attendance.report.user')) {
                                                echo 'active show';
                                            }
                                            ?>" id="pills-attentdance">

                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Student') }}</h5>
                            </div>
                        </div>
                        <div>
                    @if(hasPermission("Student Attendance Dashboard"))
                        <x-side_submenu.attendence.student.attendance_dashboard />
                    @endif

                    @if(hasPermission("Attendance Report Show"))
                    <x-side_submenu.attendence.student.student_attendence />
                    @endif


                    @if(hasPermission("Attendance Take Show"))
                        <x-side_submenu.attendence.student.attendence />
                    @endif

                    @if(hasPermission("View Attendance Show"))
                        <x-side_submenu.attendence.student.view_attendance />
                    @endif

                    @if(hasPermission("Upload Attendance"))
                        <x-side_submenu.attendence.student.upload_attendence />
                    @endif


                    @if(hasPermission("Get Attendance"))
                        <x-side_submenu.attendence.student.get_attendence />
                    @endif



                    @if(hasPermission("Custom Attendance Show"))
                        <x-side_submenu.attendence.student.custom_atendence />
                    @endif



                    @if (authUser()->subscription_status != 0)

                        @if(hasPermission("Auto Attendance"))
                            <x-side_submenu.attendence.student.auto_attendence />
                        @endif
                    @endif
                </div>
                        <br><hr><br>
                        {{-- Teacher --}}
                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-0" style="margin-top:-22px">{{ __('app.Teacher') }}</h5>
                                </div>
                            </div>
                            <div>

                                @if(hasPermission("Teaccher Attendance Dashboard"))
                                <x-side_submenu.attendence.teacher.teacher_attendence_dashboard />
                                @endif
                                @if(hasPermission("Teacher Attendance Take Create"))
                                <x-side_submenu.attendence.teacher.teacher_take_attendence />
                                @endif
                                @if(hasPermission("Teacher View Attendance"))
                                <x-side_submenu.attendence.teacher.teacher_view_attendence />
                                @endif
                            </div>
                        </div>
                        <br><hr><br>

                        <div class="list-group list-group-flush">
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h5 class="mb-0" style="margin-top:-22px">{{ __('app.Stuff') }}</h5>
                                </div>
                            </div>
                            <div>
                                @if(hasPermission("Staff View Attendance"))
                                <x-side_submenu.attendence.staff.staff_view_attendence />
                                @endif
                                @if(hasPermission("Staff Attendance Take Create"))
                                <x-side_submenu.attendence.staff.staff_take_attendence />
                                @endif


                            </div>
                        </div>
                    </div>
                </div>

                {{-- =================  Finance =================================================   --}}
                <div class="tab-pane fade 
                        @if (
                            (request()->segment(1) == 'school' && request()->segment(2) == 'finance') ||
                            Route::is('school.finance.dashoboard') ||
                            Route::is('school.finance.schoolFees') ||
                            Route::is('school.finance.assign.fees.index') ||
                            Route::is('school.finance.userlist') ||
                            Route::is('school.staff.salary.List') ||
                            Route::is('teacher.salary.Show') ||
                            Route::is('bankadd') ||
                            Route::is('expense.show') ||
                            Route::is('expense.list') ||
                            Route::is('expense.edit') ||
                            Route::is('expense.create') ||
                            Route::is('fund.show') ||
                            Route::is('fund.list') ||
                            Route::is('reciept.create') ||
                            Route::is('bankadd.create') ||
                            Route::is('student.finance.status') ||
                            Route::is('class.wise.student.finance.status') ||
                            Route::is('without.load.pagination') ||
                            Route::is('bankadd.edit')
                        ) active show @endif" id="pills-finance">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Finance') }}</h5>
                            </div>
                        </div>
                        <div>

                            @if(hasPermission("Finance Dashboard"))
                            <x-side_submenu.finance.finance_dashboard />
                            @endif

                            @if(hasPermission("Finance School Fees Show"))
                            <x-side_submenu.finance.school_fees />
                            @endif

                            @if(hasPermission("Finance Assign Fees Show"))
                            <x-side_submenu.finance.assign_fees />
                            @endif


                            @if(hasPermission("Finance Collect Fees Show"))
                            <x-side_submenu.finance.collect_fees />
                            @endif

                            @if(hasPermission("Staff Salary Show"))
                            <x-side_submenu.finance.staff_salary />
                            @endif
                            @if(hasPermission("Teacher Salary Show"))
                            <x-side_submenu.finance.teacher_salary />
                            @endif


                            @if(hasPermission("Bank Account Show"))
                            <x-side_submenu.finance.bank_account />
                            @endif



                            @if(hasPermission("Expense Show"))
                            <x-side_submenu.finance.expense />
                            @endif



                            @if(hasPermission("Expense List Show"))
                            <x-side_submenu.finance.expense_list />
                            @endif



                            @if(hasPermission("Fund Show"))
                            <x-side_submenu.finance.funds />
                            @endif


                            @if(hasPermission("Fund List Show"))
                            <x-side_submenu.finance.fund_list />
                            @endif


                            @if(hasPermission("Accesories Show"))
                            <x-side_submenu.finance.accesories_receipt />
                            @endif




                            @if(hasPermission("Student Finance Status Show"))
                            <x-side_submenu.finance.student_finance />
                            @endif



                        </div>
                    </div>
                </div>

                {{-- SMS --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'send' and Request::segment(3) == 'sms' and (Request::segment(4) == 'teacher' or Request::segment(4) == 'student' or Request::segment(4) == 'employee')) {
                                                echo 'active show';
                                            } ?>" id="pills-sms">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.SMS') }} </h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}} </small> --}}
                        </div>
                        <div>
                            @if(hasPermission("Student SMS Send"))
                            <x-side_submenu.sms.sms_student />
                            @endif
                            @if(hasPermission("Teacher SMS Send"))
                            <x-side_submenu.sms.sms_teacher />
                            @endif
                            @if(hasPermission("Staff SMS Send"))
                            <x-side_submenu.sms.sms_employee />
                            @endif


                            @if(hasPermission("sms_purchase"))
                            <x-side_submenu.sms.sms_purchase />
                            @endif



                        </div>

                    </div>
                </div>

                {{-- Exams --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'term' or (Request::segment(3) == 'exam' or Request::segment(3) == 'create/question' or Request::segment(3) == 'question' or Request::segment(3) == 'admit' and Request::segment(4) == 'card' or Request::segment(3) == 'sit' and Request::segment(4) == 'plan')) {
                                                echo 'active show';
                                            } ?>" id="pills-exam">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Exam') }}</h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        <div>
                            @if(hasPermission("Exam Term Show"))
                                <x-side_submenu.exam.exam_term />
                            @endif
                            
                            @if(hasPermission("Exam Routine Show"))
                                <x-side_submenu.exam.exam_routine />
                            @endif
                            
                            <!--@if(hasPermission("question_bank"))-->
                            <!--    <x-side_submenu.exam.question_bank />-->
                            <!--@endif-->
                            
                            <!--@if(hasPermission("question_serach"))-->
                            <!--    <x-side_submenu.exam.question_search />-->
                            <!--@endif-->
 
                            @if(hasPermission("Admit Card Show"))
                                <x-side_submenu.exam.admit_card />
                            @endif
                            
                            @if(hasPermission("Sit Plan Show"))
                                <x-side_submenu.exam.sit_plan />
                            @endif
                        </div>

                    </div>
                </div>


                {{-- Result --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and (Request::segment(2) == 'student' or Request::segment(2) == 'sms') and (Request::segment(3) == 'result' or Request::segment(3) == 'mark' or Request::segment(3) == 'class' or Request::segment(3) == 'show' and Request::segment(4) == 'class' and Request::segment(5) == 'wise' and Request::segment(6) == 'result' or Request::segment(6) == 'all' and Request::segment(4) == 'result' and Request::segment(5) == 'data' and Request::segment(6) == 'show')) {
                                                echo 'active show';
                                            } ?>" id="pills-result">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Result') }}</h5>
                            </div>
                        </div>
                        <div>
                            @if (hasPermission("Result Upload Show" )|| hasPermission("Result PDF") || hasPermission("See Result"))
                                @if (authUser()->subscription_status != 0)
                                    @if (App\Models\AddonModel::where('feature_id', 53)->where('status', 1)->exists())
                                        @if (App\Models\AddonPurchase::where('school_id', authUser()->id)->where('feature_id', 53)->where('status', 1)->exists())
                                            <a href="{{ route('sms.result') }}" class="list-group-item ">
                                                <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                                {{ __('app.Result') }} {{ __('app.SMS') }}
                                            </a>
                                        @endif
                                    @else
                                        <a href="{{ route('sms.result') }}" class="list-group-item  @if (App\Models\FeatureList::where('id', 53)->where('status', 0)->exists()) deasableFeature @endif">
                                            <div class="imgbox"><i class="bi bi-chevron-double-right"></i></div>
                                            {{ __('app.Result') }} {{ __('app.SMS') }}
                                        </a>
                                    @endif
                                @endif
        
                                @if(hasPermission("Result Upload Show"))
                                    <x-side_submenu.result.result_upload />
                                @endif
        
                                @if(hasPermission("Result PDF"))
                                    <x-side_submenu.result.result_pdf />
                                @endif
        
                                @if(hasPermission("See Result"))
                                    <x-side_submenu.result.see_result />
                                @endif
                            @endif                    
        
                        </div>
                    </div>
                </div>

                {{-- Library --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'library' or Request::segment(2) == 'borrowerinfo' or Request::segment(2) == 'borrowerCreate' or Request::segment(2) == 'borrowerEdit' or Request::segment(2) == 'booksCreate') {
                                                echo 'active show';
                                            } ?>" id="pills-library">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Library') }}</h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        <div>
                            @if(hasPermission("Borrower Info Show"))
                            <x-side_submenu.library.borrow_info />
                            @endif

                            @if(hasPermission("Book List Show"))
                            <x-side_submenu.library.book_info />
                            @endif



                        </div>
                    </div>
                </div>

                {{-- Role --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'roles') {
                                                echo 'active show';
                                            } ?>" id="pills-role">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ 'Role Manage' }}</h5>
                            </div>
                        </div>
                        <div>
                            @if(hasPermission("Role Show"))
                            <x-side_submenu.role.role />
                            @endif

                            {{--
                                @if(hasPermission("permission"))
                            <x-side_submenu.role.permission />
                            @endif
                             --}}
                        </div>
                    </div>
                </div>

                {{-- Notice --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'student' and Request::segment(3) == 'notice') {
                                                echo 'active show';
                                            } ?>" id="pills-notice">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Notice') }}</h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        @if(hasPermission("Notice Show"))
                        <x-side_submenu.notice.notice />
                        @endif

                    </div>
                </div>

                {{-- Settings --}}
                <div class="tab-pane fade @if (Request::segment(1) == 'school' and (Request::segment(2) == 'settings' or Request::segment(2) == 'device')) active show @endif" id="pills-settings">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Setting') }}</h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        <div>

                            @if(hasPermission("Setting Class Show"))
                            <x-side_submenu.setting.setting_class />
                            @endif
                            @if(hasPermission("Setting Finger Print Show"))
                            <x-side_submenu.setting.class_fingerprint_device />
                            @endif

                            
                        </div>
                    </div>
                </div>

                {{-- Addon --}}
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'addons') {
                                                echo 'active show';
                                            } ?>" id="pills-SchoolAddon">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">{{ __('app.Addon') }}</h5>
                            </div>
                            {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        <div>

                            @if(hasPermission("Addon Purchase"))
                            <x-side_submenu.addons.addons />
                            @endif
                        </div>
                    </div>
                </div>
                
                <!--website control-->
                <div class="tab-pane fade <?php if (Request::segment(1) == 'school' and Request::segment(2) == 'website' and Request::segment(3) == 'setting') {
                    echo 'active show';
                } ?>" id="pills-website">
                    <div class="list-group list-group-flush">
                        <div class="list-group-item">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-0">Website Setting</h5>
                            </div>
                        {{-- <small class="mb-0">{{__('app.dashboard1')}}</small> --}}
                        </div>
                        
                        @if(hasPermission("website control"))
                            <x-side_submenu.website.website_control />
                        @endif
                        
        
                    </div>
                </div>
            </div>
        </div>
    </aside>


    @yield('content')
    @include('modals.attendance_form')
    @include('modals.get_attendance')

    <!--start overlay-->
    <div class="overlay nav-toggle-icon"></div>
    <!--end overlay-->

    <!--Start Back To Top Button-->
    <a href="#" class="back-to-top"><i class='bx bxs-up-arrow-alt'></i></a>
    <!--End Back To Top Button-->

    <!--start switcher-->
    <div class="switcher-body">
        <form method="post" action="{{ route('user.update.post.color') }}" enctype="multipart/form-data">
            @csrf
            @if (authUser()->color == 0)
            <input type="hidden" name="color" value="1">
            <button class="btn btn-dark btn-switcher shadow-sm" type="submit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling"><i class="lni lni-night"></i> <br><span>Dark</span> </button>
            @else
            <input type="hidden" name="color" value="0">
            <button class="btn btn-light btn-switcher" type="submit" data-bs-toggle="offcanvas" data-bs-target="#offcanvasScrolling" aria-controls="offcanvasScrolling" style="background-color: #f1f1f1;color: black;"><i class="lni lni-sun"></i><br><span>light</span></button>
            @endif
        </form>
    </div>
    <!--end switcher-->

    </div>
    <!--end wrapper-->

    <body>


        <div class="floating-message-button">
            <a href="{{ route('ticketCreate.school') }}"> <i style="color: white;" class="fas fa-envelope"></i>
            </a>
        </div>

    </body>
    <!-- Bootstrap bundle JS -->
    <script src="{{ asset('schools/assets/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('schools/assets/js/jquery.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-bottom-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "3000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    {{-- This is web language change jquery function --}}

    <script>
        const toggleSwitch = document.querySelector('#switch');

        toggleSwitch.addEventListener('change', function() {
            const locale = toggleSwitch.checked ? 'bn' : 'en'; // Switch to 'bn' and 'en' for Bengali and English
            const url = '{{ route('change.language', ':locale') }}'.replace(':locale', locale);
            // console.log(url);
            window.location.href = url;
        });
    </script>










    {{-- This is web language change jquery function --}}

    <script src="{{ asset('schools/assets/plugins/simplebar/js/simplebar.min.js') }}"></script>
    <script src="{{ asset('schools/assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js') }}"></script>
    <script src="{{ asset('schools/assets/js/pace.min.js') }}"></script>

    <script src="{{ asset('schools/assets/js/table-datatable.js') }}"></script>
    <!-- Bootstrap bundle JS -->
    <script src="https://cdn.bootcss.com/jquery/2.2.4/jquery.min.js"></script>


    {!! Toastr::message() !!}

    {{-- Select2 js --}}
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        $(".js-select").select2({
            placeholder: "Select One",
            allowClear: true,
            width: "100%"
        });
    </script>

    @stack('js')
    <script src="{{ asset('schools/assets/plugins/apexcharts-bundle/js/apexcharts.min.js') }}"></script>
    <!--app-->
    <script src="{{ asset('schools/assets/js/app.js') }}"></script>
    <script src="{{ asset('schools/assets/js/index5.js') }}"></script>

    @include('sweetalert::alert')

    <!--for owl-carousel -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script>


    <script src="{{ asset('schools/assets/plugins/datatable/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('schools/assets/plugins/datatable/js/jquery.dataTables.min.js') }}"></script>

    <script>
        $('#example').DataTable({
            "language": {
                "paginate": {
                    "previous": '<i class="bi bi-chevron-left"></i>',
                    "next": '<i class="bi bi-chevron-right"></i>'
                }
            }
        });
    </script>

    <script>
        // Change the width of the search input field
        $('div.dataTables_filter input').addClass('custom-search-input');
        $('div.dataTables_filter').append('<i class="fas fa-search search-icon"></i>');
        $('div.dataTables_filter input').attr('placeholder', 'Search here...');

        $('#myTable').DataTable();
    </script>

</body>

</html>