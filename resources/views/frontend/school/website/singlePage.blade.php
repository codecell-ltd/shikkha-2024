<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Fav Icon -->
  <link rel="shortcut icon" href="favicon.ico" />
  <link rel="icon" href="{{ asset($school->school_logo) }}" type="image/svg" />
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}" />
  <!-- Font Awesome CSS -->
  <link href="{{asset('css/font-awesome.css')}}" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <!-- Settings CSS -->
  <link rel="stylesheet" href="{{asset('rs-plugin/css/settings.css')}}" />
  <!-- Jquery Fancybox CSS -->
  <link rel="stylesheet" type="text/css" href="{{asset('css/jquery.fancybox.min.css')}}" media="screen" />
  <!-- Owl Carousel CSS -->
  {{-- <link href="{{asset('css/owl.carousel.css')}}" rel="stylesheet" /> --}}
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.theme.default.min.css" />

  <!-- Style CSS -->
  <link href="{{asset('css/style.css')}}" rel="stylesheet" id="colors" />
  {{-- open font family --}}
  {{-- <link rel="stylesheet" href="https://bnblogs.com/style/lipi-alinur-banglaborno.css?auto=true"> --}}
  <link rel="stylesheet" href="https://bnblogs.com/style/fn-shorif-borsha-unicode.css?auto=true">

  <!-- Open Sans Family -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800" rel="stylesheet" />
  <!-- Roboto Family -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,500,600,700,800,900" rel="stylesheet" />
  <title>{{$school->school_name}}</title>
  <style>
    footer.team-wrap {
      padding: 0;
      /* text-align: center; */
    }
    body{
      background-image: url({{asset('images/bg9.jpg')}});
      background-repeat: no-repeat;
      background-size: cover;
      width: 100%;
      height: 100%;

    }
    
  </style>
</head>

<body>

  <div class="container">
  {{-- @include('layouts.navbar') --}}

    <!-- Header start -->

      <div class="top-header">
          <div class="container">
          <div class="row">
              <div class="col-3">
                  <img src="{{asset($school->school_logo)}}" width="100" height="100" alt="" style="border-radius: 10%"/>
              
              </div>
              <div class="col-6 text-center">
              <h4> {{$school->school_name_bn}}</h4>
              <p style="color: white; margin:0px;padding:0px;"> {{$school->slogan_bn}}</p>
              {{-- <h6 style="font-size: 14px">ইআইআইএন : {{eiin()}}, স্থাপিত : 2009</h6> --}}
              <p style="color: white; margin:0px;padding:0px;">{{$school->address_bn}}</p>
              <h6 style="font-size: 14px">EIIN : {{$school->ein_number}}</h6>
              </div>
              <div class="col-3 text-right">
                  <img src="{{asset('images/govtlogo.png')}}" alt="" width="80" />
                  <img src="{{asset('images/mujib23.png')}}" width="140" alt="" />
              </div>
          </div>
          </div>
      </div>

      {{-- Notice start --}}
      <div class="row">  
          <div class="col-lg-1">
              <button disabled="disabled" class="btn btn-info"><strong class="d-flex justify-content-center align-content-center"><h5 class="m-0">নোটিশ</h5></strong></button>
              
          </div>      
          <div class="col-lg-9">
              
              <!--Navegation End-->
              <div class="notice">
              <marquee width="99%" direction="left" height="30%">
                  @foreach ($notices as $latest)
                      <span class="mx-5"> {{$latest->topic}} </span> ||
                  @endforeach
              </marquee>
              </div>
          </div>
          <div class="col-lg-2 d-flex justify-content-end">          
            <button disabled="disabled" class="btn btn-success"><strong class="d-flex justify-content-start align-content-center"><h5 class="m-0">ভর্তি ফরম</h5></strong></button>
        </div>
      </div>
      {{-- Notice End  --}}    

      <!-- Revolution slider start -->
      <div class="tp-banner-container sliderWraper">
        <div class="tp-banner"> 
          <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
              @foreach($slider as $key => $data)
                @if ($key == 0)
                  <div class="carousel-item active">
                    <img class="d-block w-100" src="{{$data->image}}" alt="First slide" width="100%" height="500px;">
                  </div>
                @else
                  <div class="carousel-item">
                    <img class="d-block w-100" src="{{$data->image}}" alt="First slide" width="100%" height="500px;">
                  </div>
                @endif
                
              @endforeach
            </div>
            <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="sr-only">Next</span>
            </a>
          </div>
        </div>
      </div>
      <!-- Revolution slider end -->

    <!--Header end-->

    <!--body start-->

    <!-- Element Start -->
    <div class="element-wrap">      
      <ul class="row">
        <li class="col-lg-4">
          <a href="#teacher" style="text-decoration: none">
            <div class="elementInfo">
              {{-- <div class="element-icon">
                <img src="images/teacher.png" width="40" alt="" />
              </div> --}}
              <h3 class="d-flex justify-content-center align-content-center">শিক্ষক</h3>
            </div>
          </a>
        </li>
        <li class="col-lg-4">
          <a href="#class" style="text-decoration: none">
            <div class="elementInfo">
              {{-- <div class="element-icon">
                <img src="images/book.png" width="40" alt="" />
              </div> --}}
              <h3 class="d-flex justify-content-center align-content-center">ক্লাস</h3>
            </div>
          </a>
        </li>
        <li class="col-lg-4">
          <a href="#contact" style="text-decoration: none">
            <div class="elementInfo">
              {{-- <div class="element-icon">
                <img src="images/favicon (1).ico" width="40" alt="" />
                <!-- <i class="bi bi-newspaper"></i> -->
              </div> --}}
              <h3 class="d-flex justify-content-center align-content-center">যোগাযোগ</h3>
            </div>
          </a>
        </li>
      </ul>      
    </div>
    <!-- Element Endt -->

    <!--About Start-->
    <div class="about-wrap" style="margin-bottom: 20px;">
      <div class="title">
        <h2>স্বাগতম <br><span style="color: #f71bd9;">{{$school->school_name_bn}}</span></h2>
      </div>
      <div class="row">
        <div class="col-lg-6 col-md-6">
          <p> 
            @if (!empty($about))
            {{ $about->about }}
              {{-- {{ substr_replace($about->about, '...', 1000) }}  --}}
              <br> 
            @endif                
              
          </p>
        </div>
        <div class="col-lg-6 col-md-6">
          <div class="view overlay zoom" class="img-fluid " >
            @if (!empty($about))
              <img src="{{$about->image}}" alt="" class="w-100" style="border-radius: 5%"/>                     
            @endif                  
          </div>
        </div>
      </div>
    </div>
    <!--About End-->

    <!--Classes Start-->
    <div class="classes class-wrap" id="class">
      <div class="container">
        <div class="section-header">
          <div class="title">
            <h1 class="p-0 m-0">আমাদের <span>ক্লাসগুলো</span></h1>
            <div class="row">
              <div class="col-md-4"></div>  
              <div class="col-md-4">
                <img src="{{asset('images/underline2.png')}}" alt="">  
              </div>                
              <div class="col-md-4"></div>  
            </div>
          </div>
          <h5>
            স্কুলের ক্লাসগুলি স্কুলের শিক্ষাগত প্রোগ্রামের একটি গুরুত্বপূর্ণ অংশ, এখানে শিক্ষার্থীদের প্রত্যেকের শিক্ষা
            এবং উন্নতির জন্য গুরুত্বপূর্ণ হোল।
          </h5>
        </div>
        <ul class="owl-carousel classes-wrap">
          {{-- @dd($classes) --}}
          @foreach ($classes as $class)
            <li class="item">
              <div class="class-item"  style="border-radius:5%;">
                <div class="image">
                  <img src="{{asset('images/class_image.jpg')}}" alt="class image" class="img-responsive" width="250px;" height="250px;" style="border-radius:5%;"/>
                  {{-- <p><span>ক্লাসের সময়</span> সকাল ৮.০০ - ১.০০</p> --}}
                </div>
                <div class="content">
                  <h4><a href="class-single.html" style="color: #686868">{{$class->class_name_bn}}</a></h4>
                </div>
                
              </div>
            </li>
          @endforeach
          
        </ul>
        <!-- row -->
      </div>
      <!-- container -->
    </div>
    <!--Classes Start-->

    <!-- Speechs -->

    
    <div class="card white-bg" style="border: none;padding-top: 30px;">
      <!-- Main Heading -->
      <div class="main-heading-holder">
        <div class="section-header">
          <div class="title">
            <h1 class="p-0 m-0"> অধ্যক্ষের <span>বাণী </span></h1>
            <div class="row">
              <div class="col-md-4"></div>  
              <div class="col-md-4">
                <img src="{{asset('images/underline.png')}}" alt="">  
              </div>                
              <div class="col-md-4"></div>  
            </div>
            
          </div>              
        </div>
      </div>
      <!-- Main Heading -->

      <!-- Our speech -->

      <!-- Img Post -->
      
          <div class="row no-gutters">
            <!-- Post Img -->
            <div class="col-lg-6">
              <div class="post-img d-flex justify-content-center" style="padding-top: 15%">
                @if (!empty($speech->p_image))
                    <img src="{{$speech->p_image}}" alt="img-01" height="350px" width="350px" style="border-radius: 5%; border: 2px solid rgb(0, 0, 0);" class="img-thumbnail"/>
                @else
                    {{-- <img src="" alt="img-01" height="350px" width="350px" /> --}}
                @endif
              
              </div>
            </div>
            <!-- Post Img -->

            <!-- Post Detail -->
            <div class="col-lg-6 pull-right">
              <div class="blog-post-detail">
                <h2> 
                    @if (!empty($speech->name))
                    {{$speech->name}}
                    @endif
                </h2>
                <h4>
                    @if (!empty($speech->designation))
                    {{$speech->designation}} <hr style="border-width: 3px;">
                    @endif
                </h4>
                <p>
                    @if (!empty($speech->speech))
                    {{$speech->speech}}
                    @endif
                </p>              
              </div>
            </div>
            <!-- Post Detail -->
          </div>
      
      <!-- Our speech -->
    </div>
        
    

    <!-- End Speechs -->
    <!-- teacher start -->

    <div class="classes class-wrap" id="class">
      <div class="container">
        <div class="section-header">
          <div class="title">
            <h1 class="p-0 m-0">আমাদের <span>শিক্ষক</span></h1>
            <div class="row">
              <div class="col-md-4"></div>  
              <div class="col-md-4">
                <img src="{{asset('images/underline2.png')}}" alt="">  
              </div>                
              <div class="col-md-4"></div>  
            </div>
          </div>
            <h6>
            আমাদের শিক্ষকদের উদ্দেশ্য শিক্ষার্থীদের শিক্ষা এবং উন্নতির জন্য একটি সুস্থ ও সুরক্ষিত পরিবেশ সরবরাহ করা। তারা
            শিক্ষার্থীদের উন্নত জীবনের দিকে পরিচিত করতে সাহায্য করতে এবং তাদের স্বপ্নগুলি পূর্ণ করতে উৎসাহিত হন।
            </h6>
        </div>
        <ul class="owl-carousel classes-wrap">
          {{-- @dd($classes) --}}
          @foreach ($teachers as $teacher)
            <li class="item">
              <div class="class-item"  style="border-radius:5% 5% 0% 0%;">
                <div class="image">
                  <img src="{{ $teacher->image }}" height="300px" width="250px" alt="" style=" border-radius:5% 5% 0% 0%;"/>
                    {{-- <p><span>ক্লাসের সময়</span> সকাল ৮.০০ - ১.০০</p> --}}
                </div>
                
                <div class="team-info" style="background-color: darkcyan">
                    <h5 style="color: white;">{{ $teacher->full_name }}</h5>
                    <span>{{ $teacher->designation }}
                    </span>
                </div>               
                
              </div>
            </li>
          @endforeach
          
        </ul>
        <!-- row -->
      </div>
      <!-- container -->
    </div>

    <!-- teacher start -->

    <!--gellary Start-->
      <div class="project-wrap">
          <div class="container">
          <div class="project-heading">
              <div class="section-header">
              <div class="title">
                  <h1 class="p-0 m-0">আমাদের <span>গ্যালারি</span></h1>
                  <div class="row">
                    <div class="col-md-4"></div>  
                    <div class="col-md-4">
                      <img src="{{asset('images/underline2.png')}}" alt="">  
                    </div>                
                    <div class="col-md-4"></div>  
                  </div>
              </div>
              <h6>
                  আপনাদের গ্যালারি একটি মহুল সম্প্রদায়ের সুন্দর স্থান, যেখানে বিভিন্ন রকমের ছবি এবং চিত্র সংরক্ষিত রয়েছে।
                  এটি একটি সমৃদ্ধ কালের মৌলিক ও আধুনিক কাব্য এবং ক্রীতির বৃহত্তর বিদ্যালয়ের ঐতিহাসিক এবং সাংস্কৃতিক উদ্দেশ্যে
                  একটি উৎসাহী এবং সুন্দর স্থান।
              </h6>
              </div>
          </div>
          </div>
          <div class="">
          <div class="col-lg-12">
            <div class="row">
              @foreach ($gellary as $data)
                <div class="col-lg-3 col-md-4 col-sm-6" style="padding: 10px;">
                    <div class="projectImg" style="padding: 10px;">
                        <img src="{{$data->image}}" height="300px" width="100%" alt="" style="border-radius: 5%;"/>
                        {{-- <div class="service-overlay">
                        <div class="heading"></div>
                        </div> --}}
                    </div>
                </div>
              @endforeach 
            </div>
              
                        
              
              
              
          </div>

          
          
          </div>
      </div>
    <!--gellary End-->

    <!--body end-->
  </div>
  
  <!--Footer Start-->
  <footer class="footer bg-style" id="contact" style="margin-top: 30px;">
    <div class="col-md-12" style="padding-top: 10px;">
      @if (!empty($school->school_map) && !is_null($school->school_map))
        <div class="map" style="margin: 2% 2% 0% 2%;">          
          <iframe src="{{$school->school_map}}" width="100%" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
      @endif
      
    </div>

    <div class="container">
      <div class="footer-upper">
        <div class="row">
          <div class="col-lg-3 col-md-6">
            <div class="footer-widget about-widget">
              <a href="#">
                <img src="{{asset($school->school_logo)}}" style="height: 100px;" alt="Awesome Image" />
              </a>
              <p>
                {{$school->slogan_bn}}
              </p>
              <ul class="social">
                <li>
                  <a href="#"><i class="bi bi-facebook"></i></a>
                </li>
                <li>
                  <a href="#"><i class="bi bi-twitter"></i></a>
                </li>
                <li>
                  <a href="#"><i class="bi bi-instagram"></i></a>
                </li>
                <li>
                  <a href="#"><i class="bi bi-linkedin"></i></a>
                </li>
                <li>
                  {{-- <a href="#"><i class="fa fa-vimeo"></i></a> --}}
                </li>
              </ul>
            </div>
          </div>
          <div class="col-lg-4 col-md-6">
            <div class="footer-widget contact">
              <h3 class="title">আমাদের সাথে থাকুন</h3>
              <div class="widget-content">

                <ul class="contact-info">
                  <li>
                    <span class="icon fa fa-home"></span>{{$school->address_bn}}
                    <br />
                  </li>
                  <li>
                    <span class="icon fa fa-phone"></span>{{$school->phone_number }}
                  </li>
                  <li>
                    <span class="icon fa fa-envelope"></span>{{$school->email}}
                  </li>
                </ul>
              </div>
            </div>
          </div>
          <div class="col-lg-3 col-md-6">
            <div class="footer-widget quick-links">
              <h3 class="title">প্রয়োজনীয় লিংক</h3>
              <ul>
                <li><a href="https://bangladesh.gov.bd/index.php">বাংলাদেশ জাতীয় তথ্য বাতায়ন</a></li>
                <li><a href="https://moedu.gov.bd/">শিক্ষা মন্ত্রণালয়</a></li>
                <li><a href="https://www.dpe.gov.bd/">প্রাথমিক শিক্ষা অধিদপ্তর</a></li>
                <li><a href="https://pesp.finance.gov.bd/pesp/login">প্রাথমিক ও গণশিক্ষা মন্ত্রণালয়</a></li>
                {{-- <li><a href="#.">প্রাইভেসি পলিসি </a></li> --}}
              </ul>
            </div>
          </div>
          <div class="col-lg-2 col-md-6">
            <div class="footer-widget opening-hour">
              <h3 class="title">খোলা থাকবে</h3>
              <ul class="day-time">
                <li>রবিবার - বৃহস্পতিবার
                  (সকাল ০৮টা - বিকাল ৬.০০টা)

                </li>

              </ul>
            </div>
          </div>
        </div>        
      </div>
    </div>

    
  </footer>
  <!--Footer End-->



  <!--Copyright Start-->
  <div class="footer-bottom text-center">
    <div class="container">
      <div class="copyright-text">
        Copyright ©{{$school->school_name}} | Powered by <a href="http://shikkha.one">Shikkha</a>.
      </div>
    </div>
  </div>
  <!--Copyright Start--> 


  {{-- button for scroll to top --}}
  <button
    type="button"
    class="btn btn-danger btn-floating btn-lg"
    id="btn-back-to-top">
    <i class="fa fa-arrow-up"></i>
  </button>
    
    
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="{{asset('js/jquery-3.2.1.slim.min.js')}}"></script>
    <!-- Popper min -->
    <script src="{{asset('js/popper.min.js')}}"></script>
    <!-- Bootstrap min file -->
    <script src="{{asset('js/bootstrap.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <!-- Revolution Slider file -->
    <script src="{{asset('rs-plugin/js/jquery.themepunch.tools.min.js')}}"></script>
    <script src="{{asset('rs-plugin/js/jquery.themepunch.revolution.min.js')}}"></script>
    <!-- Isotope -->
    <script src="{{asset('js/isotope.js')}}"></script>
    <!-- Owl Carousel -->
    {{-- <script src="{{asset('js/owl.carousel.js')}}"></script> --}}

    <!-- Jquery Fancybox -->
    <script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
    <!-- Counter -->
    <script src="{{asset('js/counter.js')}}"></script>
    <!-- general script file -->
    <script src="{{asset('js/script.js')}}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js"></script> 

    <script>
      //Get the button
      let mybutton = document.getElementById("btn-back-to-top");

      // When the user scrolls down 20px from the top of the document, show the button
      window.onscroll = function () {
        scrollFunction();
      };

      function scrollFunction() {
        if (
          document.body.scrollTop > 20 ||
          document.documentElement.scrollTop > 20
        ) {
          mybutton.style.display = "block";
        } else {
          mybutton.style.display = "none";
        }
      }
      // When the user clicks on the button, scroll to the top of the document
      mybutton.addEventListener("click", backToTop);

      function backToTop() {
        document.body.scrollTop = 0;
        document.documentElement.scrollTop = 0;
      }
    </script>
</body>

</html>

