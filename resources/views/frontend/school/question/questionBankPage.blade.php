@extends('layouts.school.master')

@section('content')
    <style>
        .center-content {
            display: table-cell;
            vertical-align: middle;

        }

        .centericon {
            display: block;
            margin-left: auto;
            margin-right: auto;
            width: 20%;
            margin-bottom: 15px;
        }

        .card:hover {
            background: white !important;
            color: #7500a7 !important;
        }
    </style>
    <main class="page-content">

        <div class="row">
            @foreach ($questionbank as $item)
                <div class="col-4">
                    <a href="">
                        <div class="card p-5" style="background:#7500a7;color:white;cursor:pointer;">
                            <div class="center-content">
                                <h1 class="centericon"><i class="bi bi-stack"></i></h1>
                                <h3 style="text-align:center;">Class One</h3>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>
    </main>
@endsection
