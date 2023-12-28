@extends('layouts.school.master')
{{-- @extends($layout) --}}

@section('content')
<!--start content-->
<style>
    .lala {
        position: relative;
        animation: myfirst 12s 20;
        animation-direction: alternate-reverse;
        transition: 0.5s;
    }

    @keyframes myfirst {
        from {
            left: -200px;
        }

        to {
            left: 200px;
        }

    }

    .card {
        border-radius: 20px;
    }

    .card-hover {
        background-color: #7500a7;
        color: #FFF
        transition: 0.5s;

    }

    .card-hover:hover {
        background-color: rgb(138, 75, 154);
        cursor: pointer;
        color: #7a00a7;
    }

    .card-hover:hover .white {
        color: #000000;
    }

    .dropdown i {
        color: #ffffff;
    }

    .delete:hover {
        background-color: red;
        border-radius: 9%;
        color: white;
        margin-left: 5px;
        width: 85%;
    }

    .duplicate:hover {
        background-color: #7a00a7;
        border-radius: 9%;
        color: white;
        margin-left: 5px;
        width: 85%;
    }

    @keyframes blink {
        50% {
            opacity: 0.0;
        }
    }

    .blink {
        animation: blink 0.5s step-start 0s;
        animation-iteration-count: 3;
    }
</style>
<main class="page-content">

    <div class="row">
        <div class=" mb-4">
            <h3>Syllabus</h3>
        </div>

        @foreach($classes as $class)
        <div class="col-md-4">
            <div class="card card-hover" style="width:17rem;height:220px;border-radious:20px">
                <div class="card-body text-center hover-overlay" style="color: #ffffff;">
                    <div style="margin-right: -180px;">
                        <div class="dropdown">
                            <button class="btn" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false" style="background-color: none; border:none;">
                                <i class="bi bi-three-dots white" style="font-size: 20px;"></i>
                            </button>
                            <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                                <li>
                                    <button onclick="syllabus({{$class->id }});" class="dropdown-item duplicate">Create </button>
                                </li>

                          
                            </ul>
                        </div>
                    </div>
                    <a id="" href="{{route('syllabus.test.show',$class->id)}}">
                        <div class="text-center">
                            <img src="{{ asset('schools/assets/images/icons/vector 2.png')}}" alt="" width="65" height="80">
                            <h5 class="white mt-4" style="color: #FFF">{{ $class->class_name }}</h5>
                                <p class="white" style="color: #FFF">{{ $class->created_at->format('d/m/Y') }}</p>
                            </h5>
                        </div>
                    </a>
                </div>
                </a>
            </div>
        </div>
        @endforeach

    </div>
</main>
@endsection
<script>
    function syllabus(classId) {
        console.log();
        window.location.href = '/school/syllabus/test/create/' + classId;
    }
</script>

