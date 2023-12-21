@extends('layouts.school.master')

@section('content')
    <!--start content-->
    <main class="page-content">
        <div class="row">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-center">
                        <h3><b>Weblite Setting</b></h3>
                        
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                @isset($data)
                    <form action="{{route('school.website.blog.update', $data->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 8px;">
                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Title:</b></h6></div>
                            <div class="col-md-7">
                                <input type="text" name="title" id="" placeholder="Enter Blog Title" class="form-control" value="{{$data->title}}">
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row" style="margin-bottom: 8px;">
                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Image:</b></h6></div>
                            <div class="col-md-7">
                                <input type="file" name="image" id="" accept="image/*" class="form-control">
                                <img src="{{$data->image}}" alt="" srcset="" width="150px" height="150px">
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row" style="margin-bottom: 8px;">
                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Details:</b></h6></div>
                            <div class="col-md-7">
                                <textarea name="details" id="" rows="10" class="form-control">{{$data->details}}</textarea>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="d-flex justify-content-center" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-primary" style="width: 150px; height:50px;"> Save</button>
                        </div>
                        
                    </form>
                @else
                    <form action="{{route('school.website.blog.post')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="row" style="margin-bottom: 8px;">
                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Title:</b></h6></div>
                            <div class="col-md-7">
                                <input type="text" name="title" id="" placeholder="Enter Blog Title" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row" style="margin-bottom: 8px;">
                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Image:</b></h6></div>
                            <div class="col-md-7">
                                <input type="file" name="image" id="" accept="image/*" class="form-control">
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="row" style="margin-bottom: 8px;">
                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Details:</b></h6></div>
                            <div class="col-md-7">
                                <textarea name="details" id="" rows="10" class="form-control"></textarea>
                            </div>
                            <div class="col-md-1"></div>
                        </div>

                        <div class="d-flex justify-content-center" style="margin-top: 40px;">
                            <button type="submit" class="btn btn-primary" style="width: 150px; height:50px;"> Save</button>
                        </div>
                        
                    </form>
                @endisset
                {{-- <form action="{{route('school.website.blog.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row" style="margin-bottom: 8px;">
                        <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Title:</b></h6></div>
                        <div class="col-md-7">
                            <input type="text" name="title" id="" placeholder="Enter Blog Title" class="form-control">
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row" style="margin-bottom: 8px;">
                        <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Image:</b></h6></div>
                        <div class="col-md-7">
                            <input type="file" name="image" id="" accept="image/*" class="form-control">
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row" style="margin-bottom: 8px;">
                        <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Blog Details:</b></h6></div>
                        <div class="col-md-7">
                            <textarea name="details" id="" rows="10" class="form-control"></textarea>
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="d-flex justify-content-center" style="margin-top: 40px;">
                        <button type="submit" class="btn btn-primary" style="width: 150px; height:50px;"> Save</button>
                    </div>
                    
                </form> --}}
            </div>
        </div>
    </main>
    
@endsection