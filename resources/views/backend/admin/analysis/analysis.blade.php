@extends('layouts.master')

@section('content')
    <!--start content-->
    <main class="page-content">

        <div class="row mb-5 ">
            <div class="col">
                <div class="card">
                    <div style="background-color:#233545; color:white;" class="card-header">
                        <div class="row">
                            <div class="col-lg-12">
                                <center>
                                    <h3 style="margin-top:10px;font-size:50px">School Feature Use Analysis</h3>
                                </center>
                            </div>
                        </div>
                    </div>
                    <div class="card-body" style="margin-top:20px ; padding-bottom:30px">
                        <div class="container">
                            <div class="row  mb-5">
                                <div class="col-5 ">
                                    <form action="{{ route('SchoolListsearch') }}">
                                        <div class="input-group">
                                            <input type="search" name="search_key" class="form-control "
                                                placeholder="Search" aria-label="Search" aria-describedby="search-addon" />
                                            <button type="submit" class="btn btn-warning">search</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="col-7">

                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="table-responsive">
                                    <table id="example" class="table table-striped table-bordered " style="width:100%">
                                        <thead>
                                            <tr>
                                                <th scope="col">no</th>
                                                <th scope="col">School Name</th>
                                                <th scope="col">Email</th>
                                                <th scope="col">Contact</th>
                                                <th scope="col">Subscribe Date</th>
                                                <th colspan="3" class="text-center">Analysis</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($schools as $school)
                                                <tr>
                                                    <th scope="row">{{ $school->id }}</th>
                                                    <td>{{ $school->school_name }}</td>
                                                    <td>{{ $school->email }}</td>
                                                    <td>{{ $school->phone_number }}</td>
                                                    <td>{{ $school->created_at }}</td>
                                                    <td><a href="{{ route('School.Single.Analysis', $school->id) }}" class="btn btn-primary" style="color:white"><i class="fa-solid fa-chart-line"></i></a></td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
