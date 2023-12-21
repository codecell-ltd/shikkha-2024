@extends('frontend.layouts.app')

@section('main')
    <style>
        .feature-headline{
            line-height: 80px;
            font-size:4.275rem
        }

        @media only screen and (max-width: 1000px){
	        /*Big tab [426px -> 600px]*/
            .feature-headline{
                line-height: 70px;
                font-size:3.5rem;
                margin-top: 50px !important
            }
        }
        @media only screen and (max-width: 600px){
	        /*Big smartphones [426px -> 600px]*/
            .feature-headline{
                line-height: 60px;
                font-size:3.275rem;
                margin-top: 50px !important
            }
        }
        @media only screen and (max-width: 425px){
            /*Small smartphones [325px -> 425px]*/
            .feature-headline{
                line-height: 50px;
                font-size:2.275rem;
                margin-top: 50px !important
            }
        }
    </style>


    <link rel="stylesheet" href="{{asset('frontend\assets\css\style.v2.css')}}">
    <div style="height:100px;background-color: #fff"></div>

    <div style="background-color: #292d3405 !important;">
        @if($blog->count(0))

            {{-- feature blog --}}
            <div style="position: relative">
                <div class="feature-blog-bg" style="position: absolute; top:10"></div>
                <div class="container" >
                    @if($blogFeature)
                    <div class="row gap-3 justify-content-around align-items-center" style="min-height: 85vh">
                        <div class="col-lg-4">
                            <a href="{{ route('blog.view', $blogFeature->slug) }}">
                                <h1 class="feature-headline">{!! substr(strip_tags($blogFeature->title), 0, 70) !!}...</h1>
                                {{-- <h1 style="line-height: 92px;font-size:4.275rem">Project management tips & trends, delivered.</h1> --}}
                            </a>

                            <form action="{{route('subscription')}}" method="post" class="w-100">
                                @csrf
                                <div class="d-flex mt-4">
                                    <input type="email" class="form-control py-3 shadow border-0" style="border-radius:9px;" placeholder="Enter email" name="email" required/>
                                    <button type="submit" class="btn border-0 px-3" style="background-color:blueviolet;color:white; margin-left:5px; border-radius:9px;">Subscribe</button>
                                </div>
                            </form>

                            <div class="d-flex w-100" style="margin-top: 30px; color:rgba(128, 128, 128, 0.459)">
                                <h6 class="w-100">Follow Us On:
                                    <a href="https://www.facebook.com/codecell.com.bd" style="font-size:24px; margin:0 3px" class="fab fa-facebook"></a>
                                    <a href="#" style="font-size:24px; margin:0 3px" class="fab fa-twitter"></a>
                                    <a href="https://www.linkedin.com/company/codecellltd/mycompany/" style="font-size:24px; margin:0 3px" class="fab fa-linkedin"></a>
                                    <a href="https://www.instagram.com/codecell.ltd/?igshid=MzRlODBiNWFlZA%3D%3D" style="font-size:24px; margin:0 3px" class="fab fa-instagram"></a>
                                </h6>
                            </div>
                        </div>
                        <div class="col-lg-6">

                            <div class="card shadow" style="border-radius: 10px; border:none">
                                
                                <div class="card-heder text-center" style="background-color: #292d3405">
                                    <a href="{{ route('blog.view', $blogFeature->slug) }}">
                                        <img src="{{ asset($blogFeature->image ?? 'frontend/assets/img/page-title/5.jpg') }}" width="400" class="card-image-top img-fluid" alt="Image">
                                    </a>
                                </div>

                                <div class="card-body">
                                    <a href="{{ route('blog.view', $blogFeature->slug) }}">
                                        <h3>{!! substr(strip_tags($blogFeature->content ), 0, 110) !!}</h3>
                                    </a>

                                    <div class="row align-items-center mt-5">
                                        <div class="col-6">
                                            <h6> <img src="{{('frontend/assets/img/page-title/1.png') }}" style="height:40px;width:40px;border-radius:50%">
                                                {{App\Models\Admin::find($blogFeature->written_by)?->name}}
                                            </h6>
                                        </div>
                                        <div class="col-6 text-end">
                                            <p>times read</p>
                                        </div>
                                    </div>

                                </div>
                            </div>

                        </div>
                    </div>
                    @endif
                </div>
            </div>


            <div class="container" style="margin-top: 50px; padding-bottom: 100px">
                
                <div class="d-flex align-items-center justify-content-between mb-5">
                    <h3> <span class="p-3 text-light fa fa-book" style="background-color: blueviolet; margin-right: 5px;font-size:24px; border-radius: 18px"></span> Articles </h3>
                    
                    {{-- <div class="btn-group shadow" role="group" aria-label="Basic example">
                        <button type="button" class="btn btn-purple">RECENT</button>
                        <button type="button" class="btn btn-light">POPULAR</button>
                    </div> --}}
                </div>


                <div class="row align-items-center">
                    @foreach ($blog as $data)
                    @if($data->blog_design==1)
                    <div class="col-md-4 mb-5" style="padding:1%; align-items:center;">
                        <a href="{{ route('blog.view', $data->slug) }}">
                            <div class="card" style="height:540px; border-radius: 10px;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);border:0">
                                <img style="height:60%;border-radius: 10px 10px 0 0" src="{{ asset($data->image ?? 'frontend/assets/img/page-title/1.png') }}" class="img-fluid card-top-image">
                                <div class="card-body">
                                    <h3> {!! substr(strip_tags($data->title), 0, 50) !!}</h3>

                                    <div style="margin-top: 80px" class="d-flex align-items-center justify-content-between">
                                        <h6>
                                            <img src="{{('frontend/assets/img/page-title/1.png') }}" style="height:40px;width:40px;border-radius:50%">
                                            {{App\Models\Admin::find($data->written_by)?->name}}
                                        </h6>
                                        <h6>5 times read</h6>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @else
                    <div class="col-md-8 mb-5" style="padding:1%">
                        <a href="{{ route('blog.view', $data->slug) }}">

                            <div class="card" style="height:540px;border:0ch; border-radius: 2%;  box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19);">
                                <img style="height:60%;border-radius: 10px 10px 0 0" src="{{ asset($data->image ?? 'frontend/assets/img/page-title/1.png') }}" class="img-fluid d-lg-none card-top-image">
                                <div class="row align-items-center">
                                    <div class="col-md-6" style="padding: 2%;">
                                        <div class="card-body">
                                            <h3 class="card-title">{{$data->title}}</h3>
                                            {{-- <p class="card-text" ><small class="text-muted">Last updated 3 mins ago</small></p> --}}
                                        
                                            <div style="margin-top: 20px" class="d-flex align-items-center justify-content-between">
                                                <h6>
                                                    <img src="{{('frontend/assets/img/page-title/1.png') }}" style="height:40px;width:40px;border-radius:50%">
                                                    {{App\Models\Admin::find($data->written_by)?->name}}
                                                </h6>
                                                <h6>5 times read</h6>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 d-none d-lg-block">

                                        <img src="{{ asset($data->image ?? 'frontend/assets/img/page-title/1.png') }}" style="height:540px; width:100%;border-radius: 2%;" class="img-fluid rounded-start" alt="...">

                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                    @endif
                    @endforeach

                </div>
            </div>

        @endif
    </div>
@endsection