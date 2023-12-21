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
                <form action="{{route('school.website.image.post')}}" method="post" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="row" style="margin-bottom: 8px;">
                        <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Image:</b></h6></div>
                        <div class="col-md-7">
                            <input type="file" name="image" id="" accept="image/*" class="form-control">
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="row" style="margin-bottom: 8px;">
                        <div class="col-md-2 d-flex align-items-center"><h6 class="text-center"><b>Type:</b></h6></div>
                        <div class="col-md-7">
                            <select name="type" id="" class="form-select">
                                <option value="2">Gellary</option>
                                <option value="1">Slider</option>
                                {{-- <option value="3">School logo</option> --}}
                            </select>
                            {{-- <input type="file" name="gellary" id="" accept="image/*" class="form-control"> --}}
                        </div>
                        <div class="col-md-1"></div>
                    </div>

                    <div class="d-flex justify-content-center" style="margin-top: 40px;">
                        <button type="submit" class="btn btn-primary" style="width: 150px; height:50px;"> Save</button>
                    </div>
                    
                </form>
            </div>
        </div>

        @if (count($sliderImage)>0)
            <div class="classes class-wrap">
                <div class="container">
                    <div class="section-header">
                        <div class="title d-flex justify-content-center" style="margin-top: 30px;margin-bottom:0;">
                            <h4> <span ><b> SliderImages</b> </span></h4><br>
                        </div>
                        <div class="notice-text d-flex justify-content-center" style="margin: 0;padding:0;">
                            <p>Latest 3 image will be visiable in your website. You can delete rest of the images.</p>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($sliderImage as $data)
                            <div class="col-lg-4 col-md-6  col-sm-2" style="margin-top: 30px;  padding:10px;">
                                <div class="card p-0" style="padding: 5px; position:relative;">
                                    <img src="{{$data->image}}" alt="{{$data->type}}" height="300px;" class="card-img-top">
                                    <a href="{{route('school.website.slider.delete', $data->id)}}" style="position:absolute;bottom: 0; right:0"><button class="btn btn-danger">Delete</button></a>
                                </div>                                
                            </div>                                                
                        @endforeach 
                    </div>
                            
                </div>
                <!-- container -->
            </div>
        @endif

        @if (count($gellaryImage)>0)
            <div class="classes class-wrap">
                <div class="container">
                    <div class="section-header">
                        <div class="title d-flex justify-content-center" style="margin-top: 30px;margin-bottom: 10px;">
                        <h4> <span ><b>Gallery Images</b> </span></h4>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($gellaryImage as $data)
                            <div class="col-lg-3 col-md-6 col-sm-2" style="margin-top: 30px; padding:10px;">
                                <div class="card p-0" style="padding: 5px; position: relative;">
                                    <img src="{{$data->image}}" alt="{{$data->type}}" height="250px;" class="card-img-top"> 
                                    <a href="{{route('school.website.gallery.delete', $data->id)}}" style="position:absolute; bottom: 0; right: 0"><button class="btn btn-danger">Delete</button></a>
                                </div>                                
                            </div>                                                
                        @endforeach 
                    </div>
                            
                </div>
                <!-- container -->
            </div>
        @endif
    </main>
    
@endsection