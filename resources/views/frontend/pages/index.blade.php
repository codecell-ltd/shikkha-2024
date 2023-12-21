@extends('frontend.layouts.app')

@section('main')

<style>
    .hero__title {
        font-size: 40px !important
    }

    @media only screen and (max-width: 1000px) {
        .hero__title {
            font-size: 30px !important;
            margin-top: 70px
        }
    }
</style>

<section class="hero__area hero__height p-relative d-flex align-items-center">
    <style>
        .btn1:hover {
            background-color: blueviolet;
            color: white !important;
        }

        .wrapper {
            display: flex;
            justify-content: center;
            margin-top: 50px;
        }

        .item {
            width: 100px;
            height: 20px;
            margin: 10px;
            position: relative;
        }

        button {
            border: 1px solid purple;
            background: white;
            width: 100%;
            padding: 5px;
            border-radius: 3px;
            color: blue;
            transition: background 0.5s ease;
        }

        button:hover {
            background: pink;
            color: white;
            font-weight: normal;
        }

        @keyframes slide1 {

            0%,
            100% {
                transform: translate(0, 0);
            }

            50% {
                transform: translate(10px, 0);
            }
        }

        button:hover i {
            color: white;
        }

        i {
            color: blue;
            margin-left: 20px;
        }

        .arrow1 {
            animation: slide1 1s ease-in-out infinite;
            margin-left: 9px;
        }

        .card-body:hover {
            background-color: blueviolet;
            color: white !important;
        }


        .owl-item>div {
            cursor: pointer;
            margin: 6% 8%;
            transition: margin 0.4s ease;
        }

        .owl-item.center>div {
            cursor: auto;
            margin: 0;
        }

        .owl-item:not(.center)>div:hover {
            opacity: .75;
        }

        .content {
            display: flex;
            justify-content: space-around;
            align-items: center;
            background: #030303;
            height: 100vh;
        }

        .value {
            font-size: 150px;
            display: block;
            font-weight: bold;
            color: #fff;
        }


        .services__inner {
            transition: transform .5s;


        }

        .services__item {
            padding: 0px 23px;
            padding-bottom: 15px;
        }

        .services__inner:hover {
            transform: scale(1.2);
            z-index: 2;
        }

        .services__item:hover {
            background: #010086;
        }

        .services__item:hover .services__content p {
            color: White;
        }

        .services__content h3 {
            color: black;
        }

        .services__content p {
            color: black;
        }

        .services__item:hover .services__content h3 {
            color: White;
        }

        .icon-counter {
            width: 70px;
            background: white;
            margin: 0px auto;
            border-radius: 50%;
            padding: 5px 8px;
            text-align: center;
        }
    </style>

    <div class="hero__shape">
        <img class="hero-circle-1" src="{{ asset('frontend/assets/img/icon/hero/home-1/circle-1.png') }}" alt="">
        <img class="hero-circle-2" src="{{ asset('frontend/assets/img/icon/hero/home-1/circle-2.png') }}" alt="">
        <img class="hero-triangle-1" src="{{ asset('frontend/assets/img/icon/hero/home-1/triangle-1.png') }}" alt="">
        <img class="hero-triangle-2" src="{{ asset('frontend/assets/img/icon/hero/home-1/triangle-2.png') }}" alt="">
    </div>
    <div class="container" id="getStarted">
        <div class="row align-items-center" style="margin-top: -80px">
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div class="hero__content pr-80">
                    <h3 style="font-size: 40px" class="hero__title wow fadeInUp" ><strong style="color: blueviolet">{{ __('app.Shikkha') }}</strong>{{ __('app.header_title') }}</h3>
                    <p class="wow fadeInUp mt-3 fw-light fs-6">{{ __('app.header_paragraph') }}</p>
                    <div class="hero__search wow fadeInUp " data-wow-delay=".7s">
                        <form method="get" action="{{ route('getStarted.post') }}" enctype="multipart/form-data">
                            <input type="email" placeholder="{{ __('app.email1') }}" name="email" required>
                            <button type="submit" class="w-btn mt-5" style="width: 100px;">{{ __('app.btn1') }}</button>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div>
                    <div class="hero__area__rightImg">
                        <img class="hero__area__rightImg__img" src="{{ asset('images/hero-img.png') }}" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
</section>
<!-- hero area end -->



<!-- services area start -->
{{-- <section class="services__area p-relative  pb-130">
    <div class="services__shape">
        <img class="services-circle-1" src="{{ asset('frontend/assets/img/icon/services/home-1/circle-1.png') }}" alt="">
        <img class="services-circle-2" src="{{ asset('frontend/assets/img/icon/services/home-1/circle-2.png') }}" alt="">
        <img class="services-dot" src="{{ asset('frontend/assets/img/icon/services/home-1/dot.png') }}" alt="">
        <img class="services-triangle" src="{{ asset('frontend/assets/img/icon/services/home-1/triangle.png') }}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="p-0 col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-6 col-md-10 offset-md-1">
                <div class="text-center section__title-wrapper mb-75 wow fadeInUp" >
                    <h2 class="section__title">{{ __('app.header2') }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="services__inner hover__active mb-30 wow fadeInUp" >
                    <div class="text-center services__item white-bg transition-3 ">
                        <div class="services__icon mb-25 d-flex align-items-end justify-content-center">
                            <img src="{{ asset('frontend/assets/img/icon/services/home-1/services-1.png') }}" alt="" width="85">

                        </div>
                        <div class="services__content">
                            <h3 class="services__title"><a href="#">{{ __('app.feater1a') }}
                                    {{ __('app.feater1b') }}</a></h3>
                            <p>{{ __('app.feater1c') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="services__inner hover__active active mb-30 wow fadeInUp" data-wow-delay=".5s">
                    <div class="text-center services__item white-bg mb-30 transition-3">
                        <div class="services__icon mb-25 d-flex align-items-end justify-content-center">
                            <img src="{{ asset('frontend/assets/img/icon/services/home-1/services-2.png') }}" alt="" width="85">
                        </div>
                        <div class="services__content">
                            <h3 class="services__title"><a href="#">{{ __('app.feater2a') }}</a></h3>
                            <p>{{ __('app.feater2b') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="services__inner hover__active mb-30 wow fadeInUp" data-wow-delay=".7s">
                    <div class="text-center services__item white-bg transition-3">
                        <div class="services__icon mb-25 d-flex align-items-end justify-content-center">
                            <img src="{{ asset('frontend/assets/img/icon/services/home-1/services-3.png') }}" alt="" width="85">
                        </div>
                        <div class="services__content">
                            <h3 class="services__title"><a href="#">{{ __('app.feater3a') }}</a></h3>
                            <p>{{ __('app.feater3b') }}</p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="services__inner hover__active mb-30 wow fadeInUp" data-wow-delay=".9s">
                    <div class="text-center services__item white-bg transition-3">
                        <div class=" services__icon mb-25 d-flex align-items-end justify-content-center">
                            <img src="{{ asset('frontend/assets/img/icon/services/home-1/services-4.png') }}" alt="" width="85">
                        </div>
                        <div class="services__content">
                            <h3 class="services__title"><a href="#">{{ __('app.feater4a') }}</a></h3>
                            <p>{{ __('app.feater4b') }}</p>
                            <br>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</section> --}}
<!-- services area end -->

<x-Frontend.feature/>

{{-- counter section start --}}
<div class="counter-section">
    <div class="row">
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="icon-counter">
                <img src="{{('frontend/assets/img/icon/countericon/school.png')}}" width="45" alt="" />
            </div>
            <div id="counterone" style="font-size:40px;font-weight:bold;text-align:center;margin-top:25px;">0
            </div>
            <p style="font-size:22px;color:white;font-weight:bold;text-align:center;margin-top:15px;">Total School</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="icon-counter">
                <img src="{{('frontend/assets/img/icon/countericon/teacher.png')}}" width="45" alt="" />
            </div>
            <div id="countertwo" style="font-size:40px;font-weight:bold;text-align:center;margin-top:25px;">0
            </div>
            <p style="font-size:22px;color:white;font-weight:bold;text-align:center;margin-top:15px;">Total Teacher</p>
        </div>
        <div class="col-lg-4 col-md-4 col-sm-12 col-12">
            <div class="icon-counter">
                <img src="{{('frontend/assets/img/icon/countericon/student.png')}}" width="45" alt="" />
            </div>

            <div id="counterthree" style="font-size:40px;font-weight:bold;text-align:center;margin-top:25px;">0
            </div>
            <p style="font-size:22px;color:white;font-weight:bold;text-align:center;margin-top:15px;">Total Student</p>
        </div>
    </div>

</div>
{{-- counter section end --}}

<!-- Demo header-->

{{--
<section class="py-5 header">
    <div class="container py-4">
        <header class="text-center mb-5 pb-5 ">
            <h1 class="display-4">Shikkha vertical tabs</h1>
            <p class="font-italic mb-1">Making advantage of Shikkha 4 components, easily build an awesome tabbed
                interface.</p>
            <p class="font-italic">
                <a class="text-white" href="">
                    <u></u>
                </a>
            </p>
        </header>

        <div class="row">
            <div class="col-md-5 col-sm-3 col-12">
                <!-- Tabs nav -->
                <div class="nav flex-column nav-pills nav-pills-custom" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                    <button class="nav-link active" id="v-pills-home-tab" data-bs-toggle="pill" data-bs-target="#v-pills-home" type="button" role="tab" aria-controls="v-pills-home" aria-selected="true">Welcome to Imagebox 1 Shikkha</button>

                    <button class="nav-link" id="v-pills-profile-tab" data-bs-toggle="pill" data-bs-target="#v-pills-profile" type="button" role="tab" aria-controls="v-pills-profile" aria-selected="false">Welcome to Imagebox 2 Shikkha

                    </button>

                    <button class="nav-link" id="v-pills-messages-tab" data-bs-toggle="pill" data-bs-target="#v-pills-messages" type="button" role="tab" aria-controls="v-pills-messages" aria-selected="false">Welcome to Imagebox 3 Shikkha</button>
                    <button class="nav-link" id="v-pills-settings-tab" data-bs-toggle="pill" data-bs-target="#v-pills-settings" type="button" role="tab" aria-controls="v-pills-settings" aria-selected="false">Welcome to Imagebox 4 Shikkha</button>
                </div>
            </div>


            <div class="col-md-7 col-sm-3 col-12">
                <!-- Tabs content -->
                <div class="tab-content" id="v-pills-tabContent">
                    <div class="tab-pane fade shadow rounded bg-white text-center show active p-5" id="v-pills-home" role="tabpanel" aria-labelledby="v-pills-home-tab">

                        <img src="{{ asset('frontend\assets\img\about\home-5\about-sm.jpg') }}" width="550" height="300" alt="">
</div>

<div class="tab-pane fade shadow rounded text-center bg-white p-5" id="v-pills-profile" role="tabpanel" aria-labelledby="v-pills-profile-tab">
    <img src="{{ asset('frontend\assets\img\about\home-5\about-big.jpg') }}" width="550" height="300" alt="">
</div>

<div class="tab-pane fade shadow rounded text-center bg-white p-5" id="v-pills-messages" role="tabpanel" aria-labelledby="v-pills-messages-tab">
    <img src="{{ asset('frontend\assets\img\about\home-5\about-sm.jpg') }}" width="550" height="300" alt="">
</div>

<div class="tab-pane fade shadow rounded text-center bg-white p-5" id="v-pills-settings" role="tabpanel" aria-labelledby="v-pills-settings-tab">
    <img src="{{ asset('frontend\assets\img\about\home-5\about-big.jpg') }}" width="550" height="300" alt="">
</div>
</div>
</div>
</div> --}}
{{-- </div>
</section> --}}

<!-- testimonial area start -->
{{-- <section class="overflow-y-visible testimonial__area pt-150 pb-70 p-relative">
        <div class="circle-animation testimonial">
            <span></span>
        </div>
        <div class="testimonial__shape">
            <img class="testimonial-circle-1"
                src="{{ asset('frontend/assets/img/icon/testimonial/home-1/circle-1.png') }}" alt="">
    <img class="testimonial-circle-2" src="{{ asset('frontend/assets/img/icon/testimonial/home-1/circle-2.png') }}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 offset-xxl-3 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2">
                <div class="text-center section__title-wrapper section-padding mb-65 wow fadeInUp" >
                    <h2 class="section__title">{{ __('app.header11') }} </h2>
                </div>
            </div>
        </div>
        <div class="container">

            <div class="owl-carousel">
                @foreach ($testimonialimg as $img)
                <div><img src="{{ asset($img->image) }}" alt="" width="140" height="140"></div>
                @endforeach
            </div>
        </div>
    </div>
</section> --}}
<!-- testimonial area end -->

{{-- Download Shikkha APP --}}
{{-- <section>
    <div class="downloadapp" style="padding:40px 20px;background:linear-gradient(to right, #06019e 0%, #49028b 100%);margin:50px 0px">
        <div class="containerapp" style="background: #fdfdfd;color:black;padding-top:2px;padding-bottom:10px;padding-left:2px;width:1150px;margin:0 auto;border-radius:7px;margin:0px auto;">
            <div class="d-flex justify-content-start">
                <div class="left-side">
                    <img src="{{('frontend/assets/img/icon/countericon/hero-img.png') }}" width="464" height="auto" alt="not found">
                </div>
                <div class="sd" style="padding:120px">
                    <h3>ডাউনলোড করুন Shikkha App</h3>
                    <h6>বেস্ট এক্সপেরিয়েন্স পেতে, এখনই ডাউনলোড করুন <span style="color: #49028b;font-size:larger">Shikkha App</span></h6>
                    <div class="button-box d-flex gap-3 mt-4">
                        <button class="d-flex justify-content-center gap-2 pt-3" style="background:#eaecf0;border:#eaecf0">
                            <img src="{{('frontend/assets/img/icon/countericon/android.png') }}" alt="" width="20">
                            <h6>ANDROID</h6>
                        </button>
                        <button class="d-flex justify-content-center gap-2 pt-3" style="background:#eaecf0;border:#eaecf0">
                            <img src="{{('frontend/assets/img/icon/countericon/mac.png') }}" alt="" width="20">
                            <h6>Ios/MacOs</h6>
                        </button>

                    </div>
                    <div class="button-box d-flex gap-3 mt-4">
                        <button class="d-flex justify-content-center gap-2 pt-3" style="background:#eaecf0;border:#eaecf0">
                            <img src="{{('frontend/assets/img/icon/countericon/window.png') }}" alt="" width="20">
                            <h6>Windows</h6>
                        </button>
                        <button class="d-flex justify-content-center gap-2 pt-3" style="background:#eaecf0;border:#eaecf0">
                            <img src="{{('frontend/assets/img/icon/countericon/linux.png') }}" alt="" width="20">
                            <h6>Linux</h6>
                        </button>

                    </div>
                </div>
            </div>
        </div>
    </div>
</section> --}}


{{-- Blog start here --}}
@if (count($blog) > 0)
<section class="services__area p-relative mb-5">
    <div class="services__shape">
        <img class="services-circle-1" src="{{ asset('frontend/assets/img/icon/services/home-1/circle-1.png') }}" alt="">
        <img class="services-circle-2" src="{{ asset('frontend/assets/img/icon/services/home-1/circle-2.png') }}" alt="">
        <img class="services-dot" src="{{ asset('frontend/assets/img/icon/services/home-1/dot.png') }}" alt="">
        <img class="services-triangle" src="{{ asset('frontend/assets/img/icon/services/home-1/triangle.png') }}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="p-0 col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-6 col-md-10 offset-md-1">
                <div class="text-center section__title-wrapper mb-5 wow fadeInUp" >
                    <h2 class="section__title">{{ __('app.Blog') }}</h2>
                </div>
            </div>
        </div>
    </div>
    <div class="blog-pages-wrapper section-space--ptb_100">
        <div class="container">
            <div style="margin-top:50px;margin-left:10px">
                <div class="row">
                    @foreach ($blog as $data)
                    <div class="col-md-4">
                        <a href="{{ route('blog.view', ["slug" => $data->slug]) }}">
                            <div class="card" style="box-shadow:0px 0px 6px #cecdcd">
                                <div>

                                    <img Width="100%" height="250px" src="{{ asset($data->image ?? 'frontend/assets/img/icon/countericon/school.png') }}" alt="">
                                    <div style="height: 150px;margin:15px">
                                        <h6 style="margin-top: 20px;text-align:justify;margin-left:5px;margin-right:20px;overflow:hidden">
                                            {!! substr(strip_tags($data->title), 0, 100) !!}</h6>
                                        <p style="text-align:left ;margin-left:5px">
                                            {!! substr(strip_tags($data->content), 0, 130) !!}.....
                                        </p>
                                    </div>
                                    <a href="{{ route('blog.view', ["slug" => $data->slug]) }}" style="color:blueviolet;font-weight:bold;margin:15px">Read
                                        More<i class="bi bi-chevron-double-right" style="margin-left:5px !important;font-weight:bold;color:blueviolet"></i>
                                </div>
                            </div>


                        </a>
                    </div>
                    @endforeach

                </div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="item">
            <a href="{{ route('blog.page') }}" class="w-btn">More <i class="fa fa-long-arrow-right arrow1" aria-hidden="true"></i></a>
        </div>
    </div>
</section>
@endif
{{-- Blog end here --}}

<!-- features area start -->
<section class="overflow-y-visible features__area pt-60 pb-25 p-relative">
    <div class="circle-animation features">
        <span></span>
    </div>
    <div class="features__shape">
        <img class="features-circle-1" src="{{ asset('frontend/assets/img/icon/features/home-1/circle-1.png') }}" alt="">
    </div>
    <div class="container">
        <div class="row">
            <div class="col-xxl-6 col-xl-6 col-lg-6">
                <div class="section__title-wrapper mb-65 wow fadeInUp" >
                    <h2 class="section__title">{{ __('app.head') }}</h2>
                    <p>{{ __('app.head2') }}</p>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="features__item mb-30 wow fadeInUp" >
                    <div class="features__icon mb-35">
                        <span class="gradient-pink"><i class="far fa-heart-rate"></i></span>
                    </div>
                    <h3 class="features__title">{{ __('app.module1') }}</h3>
                    <div class="features__list">
                        <ul>
                            <li>{{ __('app.module1a') }}</li>
                            <li>{{ __('app.module1b') }}</li>
                            <li>{{ __('app.module1c') }}</li>
                            <li>{{ __('app.module1d') }}</li>
                            <li>{{ __('app.module1e') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="features__item mb-30 wow fadeInUp pl-15" data-wow-delay=".5s">
                    <div class="features__icon mb-35">
                        <span class="gradient-blue"><i class="fal fa-chart-pie-alt"></i></span>
                    </div>
                    <h3 class="features__title">{{ __('app.module2') }}</h3>
                    <div class="features__list">
                        <ul>
                            <li>{{ __('app.module2a') }}</li>
                            <li>{{ __('app.module2b') }}</li>
                            <li>{{ __('app.module2c') }}</li>
                            <li>{{ __('app.module2d') }}</li>
                            <li>{{ __('app.module2e') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6">
                <div class="features__item mb-30 wow fadeInUp pl-45" data-wow-delay=".7s">
                    <div class="features__icon mb-35">
                        <span class="gradient-yellow"><i class="fal fa-tag"></i></span>
                    </div>
                    <h3 class="features__title">{{ __('app.module3') }}</h3>
                    <div class="features__list">
                        <ul>
                            <li>{{ __('app.module3a') }}</li>
                            <li>{{ __('app.module3b') }}</li>
                            <li>{{ __('app.module3c') }}</li>
                            <li>{{ __('app.module3d') }}</li>
                            <li>{{ __('app.module3e') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-6 col-sm-6 d-lg-flex justify-content-end">
                <div class="features__item mb-30 wow fadeInUp" data-wow-delay=".9s">
                    <div class="features__icon mb-35">
                        <span class="gradient-purple"><i class="fal fa-layer-group"></i></span>
                    </div>
                    <h3 class="features__title">{{ __('app.module4') }}</h3>
                    <div class="features__list">
                        <ul>
                            <li>{{ __('app.module4a') }}</li>
                            <li>{{ __('app.module4b') }}</li>
                            <li>{{ __('app.module4c') }}</li>
                            <li>{{ __('app.module4d') }}</li>
                            <li>{{ __('app.module4e') }}</li>
                            <li>{{ __('app.module4f') }}</li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xxl-12">
                <div class="text-center features__more mt-50">
                </div>
            </div>
        </div>
    </div>
</section>
<!-- features area end -->

<!-- cta area start -->
<section class="cta__area mb-65">
    <div class="circle-animation cta-1">
        <span></span>
    </div>
    <div class="circle-animation cta-1 cta-2">
        <span></span>
    </div>
    <div class="circle-animation cta-3">
        <span></span>
    </div>
    <div class="container">
        <div class="cta__inner p-relative fix z-index-1 wow fadeInUp p-4" data-wow-delay=".5s">
            <div class="cta__shape">
                <img class="circle" src="{{ asset('frontend/assets/img/cta/home-1/cta-circle.png') }}" alt="">
                <img class="circle-2" src="{{ asset('frontend/assets/img/cta/home-1/cta-circle-2.png') }}" alt="">
                <img class="circle-3" src="{{ asset('frontend/assets/img/cta/home-1/cta-circle-3.png') }}" alt="">
                <img class="triangle-1" src="{{ asset('frontend/assets/img/cta/home-1/cta-triangle.png') }}" alt="">
                <img class="triangle-2" src="{{ asset('frontend/assets/img/cta/home-1/cta-triangle-2.png') }}" alt="">
            </div>
            {{-- <div class="row">
                <div class="col-xxl-12">
                    <div class="cta__wrapper d-lg-flex justify-content-between align-items-center">
                        <div class="cta__content">
                            <h3 class="cta__title"> {{ __('app.head4a') }}<br>{{ __('app.head4b') }}</h3>
                        </div>
                        <div class="cta__btn">
                            <a data-ga-click-tracking="" ga-event="Signup click" ga-category="Signup button" onClick="signHandler()" ga-label="pricing free forever" ga-value="" mail-label="pricing free forever" lp-plan="free-forever" data-beta="" href="javascript:void(0)" class="w-btn w-btn-white" style="background-color: #fbfbfb;">{{ __('app.head5') }}</a>
                        </div>
                    </div>
                </div>
            </div> --}}
            <div class="row align-items-center justify-content-between gap-3">
                <div class="col-md-6 text-md-start text-center">
                    <h3 class="cta__title"> {{ __("app.get_best_experience") }} </h3> 
                    <h2>{{__("app.download_app")}}</h1>
                </div>
                <div class="col-md-4 text-center">
                    <img src="{{asset("frontend/assets/img/icon/download.app.jpg")}}" alt="Download App" class="img-fluid" style="height: 200px"/>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- cta area end -->


<script>
    let count = document.getElementById("counterone")
    let counternumber = 0
    let schools = @json($schools)

    function counter() {
        counternumber++
        count.innerHTML = counternumber
        if (counternumber >= schools) {
            clearInterval(stop)
        }
    }

    let stop = setInterval(function() {
        counter()
    }, 70)
</script>
<script>
    let count2 = document.getElementById("countertwo")
    let counternumber2 = 0
    let teachers = @json($teachers)

    function countertwo() {
        counternumber2++
        count2.innerHTML = counternumber2
        if (counternumber2 >= teachers) {
            clearInterval(stop2)
        }
    }

    let stop2 = setInterval(function() {
        countertwo()
    }, 40)
</script>
<script>
    let count3 = document.getElementById("counterthree")
    let counternumber3 = 0
    let students = @json($students)

    function counterthree() {
        counternumber3++
        count3.innerHTML = counternumber3
        if (counternumber3 >= students) {
            clearInterval(stop3)
        }
    }

    let stop3 = setInterval(function() {
        counterthree()
    })
</script>
@endsection
@push('js')
<script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
@endpush
