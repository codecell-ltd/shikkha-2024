@extends('frontend.layouts.app')

@section('main')
<link rel="stylesheet" href="{{asset('frontend\assets\css\style.v2.css')}}">

    <style>
        .social-link ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }
        
        .toc {
            /* -ms-flex-item-align: start;
            -webkit-padding-after: 75px; */
            /* align-self: flex-start; */
            border-bottom-left-radius: 8px;
            border-bottom-right-radius: 8px;
            padding-block-end: 75px;
            position: sticky;
            top: 140px;
            height: 85vh;
            overflow: hidden;
            /* width: 34%; */
        }

        .toc nav{
            height: 85vh;
            overflow: scroll;
        }

        .toc-li.active{
            background-color: white;
            border-radius: 15px;
            padding: 15px;
            box-shadow: 2px 2px 2px 2px rgba(0, 0, 0, 0.2);
        }
    </style>

    <div style="height:150px"></div>
    <div style="position: relative">
        <div class="feature-blog-bg" style="position: absolute; top:10"></div>
        <div class="container">
            <div class="row gap-5" style="padding-top: 5%;padding-bottom: 5%;">
                <div class="col-md-6">
                    <img src="{{ asset($blog->image ?? 'frontend/assets/img/page-title/5.jpg') }}" style="border-radius:2%;height:400px;width:100%; box-shadow: 0 4px 8px 0 rgba(0, 0, 0, 0.2), 0 6px 20px 0 rgba(0, 0, 0, 0.19)" alt="Image">
                </div>
                
                <div class="col-md-5">
                    <h1 class="mb-4" style="font-size:40px">{{$blog->title}}</h1>

                    <div class="d-flex align-items-center justify-content-between">
                        <h6> <img src="{{('frontend/assets/img/page-title/1.png') }}" style="height:40px;width:40px;border-radius:50%">
                            {{App\Models\Admin::find($blog->written_by)?->name}}
                        </h6>
                        <h6>|</h6>
                        <h6>{{$blog->created_at->format('d/M/Y')}}</h6>
                        <h6>|</h6>
                        <h6>4 min read</h6>
                    </div>

                    <div class="d-flex justify-content-between gap-1">
                        <h3>
                            <a href="https://www.facebook.com/codecell.com.bd" style="padding:5%;background-color:white;text-align:center;height:50px;border-radius:50%;width:50px;display:inline-block;"><i class="fab fa-facebook"></i></a>

                            <a href="#" style="padding:5%;background-color:white;height:50px;border-radius:50%;width:50px;display:inline-block;"><i class="fab fa-twitter"></i></a>

                            <a href="https://www.linkedin.com/company/codecellltd/mycompany/" style="padding:5%;background-color:white;height:50px;border-radius:50%;width:50px;display:inline-block;"><i class="fab fa-linkedin"></i></a>

                            <a href="https://www.instagram.com/codecell.ltd/?igshid=MzRlODBiNWFlZA%3D%3D" style="padding:5%;background-color:white;height:50px;border-radius:50%;width:50px;display:inline-block;"><i class="fab fa-instagram"></i></a>
                        </h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
        
    <div style="background: #FAFBFC;" class="pb-155">
        <div class="container">
            <div class="row" style="padding-top: 5%; position: relative">
                <div class="col-md-8" style="padding-right: 5%;" id="cot_top">
                    <div style="color: black;" id="dynamic_content"> 
                        {!!$blog->content!!}
                    </div>
                </div>

                <div class="col-md-4 toc d-none d-md-block">
                    <h5 style="margin-bottom: 5px">TABLE OF CONTENTS</h5>
                    <nav id="toc"></nav>
                </div>
            </div>
        </div>
    </div>

@endsection

@push('js')
    <script>
        $(document).ready(()=>{
            let id = 0;
            let toc = '<ol style="padding:0">';

            $("#dynamic_content h3").each(function(){
                id++;

                let el = $(this);
                let headline = el.text();
                el.attr('id', 'cot_'+id);

                if(id == 1)
                {
                    toc += `<li class="toc-li"> <i class="fa fa-caret-right"></i> <a href="#cot_top">${headline}</a></li><hr/>`;
                }
                else
                {
                    toc += `<li class="toc-li"> <i class="fa fa-caret-right"></i> <a href="#cot_${(id-1)}">${headline}</a></li><hr/>`;
                }
            });
            
            toc += '</ol>';

            $("#toc").html(toc);
        });

        $(document).on('click', ".toc-li", function(){
            console.log($(this).html());
            $('.toc-li').removeClass('active');
            $(this).addClass('active');
        })
        
    </script>
@endpush
