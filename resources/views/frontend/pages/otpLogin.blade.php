@extends('frontend.layouts.app')
@section('main')

    <main>


        <!-- sign up area start -->
        <section class="signup__area po-rel-z1 pt-100 pb-145">
            <div class="sign__shape">
                <img class="man-1" src="assets/img/icon/sign/man-3.png" alt="">
                <img class="man-2 man-22" src="assets/img/icon/sign/man-2.png" alt="">
                <img class="circle" src="assets/img/icon/sign/circle.png" alt="">
                <img class="zigzag" src="assets/img/icon/sign/zigzag.png" alt="">
                <img class="dot" src="assets/img/icon/sign/dot.png" alt="">
                <img class="bg" src="assets/img/icon/sign/sign-up.png" alt="">
                <img class="flower" src="assets/img/icon/sign/flower.png" alt="">
            </div>
            <div class="container">
                <div class="row">
                    <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                        <div style="padding: 15px 70px" class="sign__wrapper white-bg shadow-lg">
                            <div class="sign__header mb-35">

                            </div>

                            <div class="text-center pb-4">
                                <h2 class="text-center fw-bold">Let's Start</h2>
                                <img style="width: 150px" src="{{ asset('frontend/assets/img/otp/validate-email.png') }}" alt="">
                            </div>
                            <div class="pt-4">
                                <h5> We just Send you</h5>
                                <p>Please enter the code we Send Your Phone Number.</p>
                            </div>
                            <div class="sign__form">
                                @isset($admin)
                                <form method="post" action="{{route('otp.login.admin')}}" enctype="multipart/form-data">
                                @else
                                <form method="post" action="{{route('otp.login.post')}}" enctype="multipart/form-data">
                                @endisset
                                
                                    @csrf
                                    <div class="sign__input-wrapper mb-25">
                                        @isset($admin)
                                            <input type="hidden" name="email" value="{{$admin->email}}" />
                                            <input type="hidden" name="adminId" value="{{$admin->id}}" />
                                        @else
                                        <div class="sign__input">
                                            <input type="hidden" placeholder="e-mail address" name="email" value="{{$to_email}}">
                                            <input type="hidden" placeholder="e-mail address" name="password" value="{{$to_password}}">
                                        </div>
                                        <input type="hidden" placeholder="Contact Number"  name="phone_number" value="{{$to}}">
                                        @endisset
                                    </div>
                                    
                                    <div class="sign__input-wrapper mb-25">
                                        <h5>OTP</h5>
                                        <div class="sign__input d-flex" id="otp__input">
                                            <input maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*"  data-next-index="1" name="otp1" id="fst" onkeyup="keyEvent(this, 'sec')">
                                            <input maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*"  data-next-index="1" name="otp2" id="sec" onkeyup="keyEvent(this, 'trd')">
                                            <input maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*"  data-next-index="1" name="otp3" id="trd" onkeyup="keyEvent(this, 'for')">
                                            <input maxlength="1" type="text" inputmode="numeric" pattern="[0-9]*"  data-next-index="1" name="otp4" id="for" onkeyup="keyEvent(this, 'fiv')">
                                            <input maxlength="1" type="hidden" inputmode="numeric" pattern="[0-9]*"  data-next-index="1"  id="fiv">
                                        </div>
                                    </div>

                                    <button class="w-btn w-btn-11 w-100" type="submit"> <span></span> Submit</button>
                                    {{-- <div class="sign__new text-center mt-20">
                                        <p>Already in Markit ? <a href="sign-in.html"> Sign In</a></p>
                                    </div> --}}
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- sign up area end -->
    </main>

@endsection
