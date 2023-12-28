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
                <div class="row">
                    <div class="col">
                        <div class="card-header">
                            <h5 class="card-title"></h5>
                            <ul class="nav nav-tabs card-header-tabs" data-bs-tabs="tabs">
                                <li class="nav-item">
                                    <a class="nav-link active" aria-current="true" data-bs-toggle="tab" href="#about"> About</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#p_speech">Principal Speech</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" data-bs-toggle="tab" href="#g_body">Govorning Body</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="card">
                            <div class="card-body tab-content">        
                                <div class=" tab-pane active" id="about">
                                    <form action="{{route('school.website.about.post')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        <div class="row" style="margin-bottom: 8px;">
                                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>About:</b></h6></div>
                                            <div class="col-md-7">
                                                <textarea name="about" id=""  rows="10" class="form-control">@isset($dataAbout)@if ($dataAbout->about != null){{$dataAbout->about}}@endif @else @endisset</textarea>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                    
                                        <div class="row" style="margin-bottom: 8px;">
                                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>School Image:</b></h6></div>
                                            <div class="col-md-7">
                                                <input type="file" name="image" id="" accept="image/*" class="form-control">
                                                @isset($dataAbout)
                                                    @if ($dataAbout->image != null)
                                                        <img class="mb-3" src="{{asset($dataAbout->image)}}" alt="" height="120px" width="200px">
                                                    @endif 
                                                @else 

                                                @endisset
                                                    
                                                
                                            </div>
                                            
                                            <div class="col-md-1"></div>
                                        </div>
                    
                                        
                    
                                        <div class="d-flex justify-content-center" style="margin-top: 40px;">
                                            <button type="submit" class="btn btn-primary" style="width: 150px; height:50px;"> Save</button>
                                        </div>
                                        
                                    </form>        
                                </div>
        
                                <div class="tab-pane" id="p_speech">
                                    <form action="{{route('school.website.speech.post')}}" method="post" enctype="multipart/form-data">
                                        @csrf

                                        @isset($data)@if ($data->about != null)<input type="hidden" name="about" value="{{$data->about}}">@endif @else @endisset
                                        {{-- <input type="hidden" name="name" @isset($data)@if ($data->name != null){{$data->name}}@endif @else @endisset>
                                        <input type="hidden" name="designation" @isset($data)@if ($data->designation != null){{$data->designation}}@endif @else @endisset>
                                        <input type="hidden" name="speech" @isset($data)@if ($data->speech != null){{$data->speech}}@endif @else @endisset> --}}

                                        <div class="row" style="margin-bottom: 8px;">
                                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Name</b></h6></div>
                                            <div class="col-md-7">
                                                <input type="text" name="name" id="" class="form-control" @isset($data)@if ($data->name != null) value="{{$data->name}}" @endif @else @endisset>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                    
                                        <div class="row" style="margin-bottom: 8px;">
                                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Designation:</b></h6></div>
                                            <div class="col-md-7">
                                                <input type="text" name="designation" id="" class="form-control" @isset($data)@if ($data->designation != null) value="{{$data->designation}}" @endif @else @endisset>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                    
                                        <div class="row" style="margin-bottom: 8px;">
                                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Principal Image:</b></h6></div>
                                            <div class="col-md-7">
                                                <input type="file" name="p_image" id="" accept="image/*" class="form-control">
                                                @isset($data)
                                                @if ($data->p_image != null)<img class="mb-3" src="{{asset($data->p_image)}}" alt="" height="120px" width="100px"> @endif @else @endisset

                                                                    
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                    
                                        <div class="row" style="margin-bottom: 8px;">
                                            <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Principal Speech:</b></h6></div>
                                            <div class="col-md-7">
                                                <textarea name="speech" id="" rows="10" class="form-control">@isset($data)@if ($data->speech != null){{$data->speech}}@endif @else @endisset</textarea>
                                            </div>
                                            <div class="col-md-1"></div>
                                        </div>
                    
                                        <div class="d-flex justify-content-center" style="margin-top: 40px;">
                                            <button type="submit" class="btn btn-primary" style="width: 150px; height:50px;"> Save</button>
                                        </div>
                                        
                                    </form>
        
                                </div>
        
                                
        
                                <!-- Fees -->
                                <div class=" tab-pane" id="g_body">
                                    <div class="form-control">
                                        <form action="{{route('school.website.gover.post')}}" method="post" enctype="multipart/form-data">
                                            @csrf
                                            
                        
                                            <div class="row" style="margin-bottom: 8px;">
                                                <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Name</b></h6></div>
                                                <div class="col-md-7">
                                                    <input type="text" name="name" id="" class="form-control">
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                        
                                            <div class="row" style="margin-bottom: 8px;">
                                                <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Designation:</b></h6></div>
                                                <div class="col-md-7">
                                                    <input type="text" name="designation" id="" class="form-control">
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                        
                                            <div class="row" style="margin-bottom: 8px;">
                                                <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Image:</b></h6></div>
                                                <div class="col-md-7">
                                                    <input type="file" name="image" id="" accept="image/*" class="form-control">
                                                    {{-- <img class="mb-3" src="{{asset($GovorningBody->image)}}" alt="" height="120px" width="100px"> --}}
                        
                                                </div>
                                                <div class="col-md-1"></div>
                                            </div>
                        
                                            <div class="d-flex justify-content-center" style="margin-top: 40px;">
                                                <button type="submit" class="btn btn-primary" style="width: 150px; height:50px;"> Save</button>
                                            </div>
                                            
                                        </form>
                                    </div>

                                    @if (count($GovorningBody)>0)
                                        <div class="classes class-wrap">
                                            <div class="container">
                                                <div class="section-header">
                                                    <div class="title d-flex justify-content-center" style="margin-top: 30px;margin-bottom: 30px;">
                                                    <h1> <span >Govorning Body</span></h1>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    @foreach ($GovorningBody as $data)
                                                        <div class="col-lg-4 col-md-6" style="margin-top: 30px;">
                                                            <div class="galleryImg">
                                                                <img src="{{$data->image}}" alt="{{$data->name}}" width="300px;" height="300px;">                                                  
                                                            </div>
                                                            <div class="content">
                                                                <h4>{{$data->name}}</h4>
                                                                <h6>{{$data->designation}}</h6>
                                                            </div>
                                                            <a href="{{route('school.website.gover.delete', $data->id)}}" style="float: right;"><button class="btn btn-danger">Delete</button></a>
                                                        </div>                                                
                                                    @endforeach 
                                                </div>
                                                       
                                            </div>
                                            <!-- container -->
                                        </div>
                                    @endif
                                    
                                    
                                </div>
        
        
                            </div>
                        </div>
                    </div>
                </div>



                {{-- <form act  --}}
            </div>
        </div>
    </main>
    
@endsection