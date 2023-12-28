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
            transition: 0.5s;

        }

        .card-hover:hover {
            background-color: rgb(229, 134, 253);
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
                <h3>Question</h3>
            </div>
            @foreach ($questions as $question)
                <div class="col-4">
                    <a href="{{ route('question.classpage', $question->term_id) }}">
                        <div class="card card-hover" style="height:250px; color: #ffffff;">
                            <div class="card-body justify-content-center hover-overlay d-flex align-items-center">
                                <div class="text-center">
                                    <img src="{{ asset('schools/assets/images/icons/vector.png') }}" alt=""
                                        class="img-fluid">
                                    <h6 class="white mt-4">{{ $question->term?->term_name }}</h6>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
@endsection
@push('js')
    <script></script>
@endpush
