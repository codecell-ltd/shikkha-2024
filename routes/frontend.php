<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

    //** *************    Frontend Page   ***************  */
    Route::get("language/{local?}", [PageController::class, 'changeLanguage'])->name('change.language');
    Route::post('/payment/success', [App\Http\Controllers\PaymentController::class, 'success'])->name('payment.success');
        Route::get('/{user_name}-institute',[WebsiteController::class, 'singlePageWebsite']);



    Route::middleware("language")
    ->group(function(){
        Route::get('/forgot/pass', [LoginController::class, 'forgotPassword'])->name('user.forgot.password');
        Route::get('/reset/pass/{token}', [LoginController::class, 'resetPassword'])->name('user.reset.password');
        Route::post('/forgot/pass/post', [LoginController::class, 'forgotPasswordPost'])->name('user.forgot.password.post');
        Route::post('/reset/pass/post', [LoginController::class, 'resetPasswordpost'])->name('user.reset.password.post');

        Route::get('/', [PageController::class, 'home'])->name('home');
        Route::get('/contact', [PageController::class, 'contactPage'])->name('contact.page');
        Route::get('/blog/{slug}', [PageController::class, 'blogView'])->name('blog.view');
        Route::post('/blog/SUBSCRIPTION/POST', [AdminPageController::class, 'subscription'])->name('subscription');
        Route::post('/contact', [PageController::class, 'contactSuppport'])->name('contact.support');
        Route::get('/feature-page', [PageController::class, 'featurePage'])->name('feature.page');
        Route::get('/feature-page/user-management', [PageController::class, 'featureU'])->name('feature.page.u');
        Route::get('/feature-page/record', [PageController::class, 'featureS'])->name('feature.page.s');
        Route::get('/feature-page/assignment-project', [PageController::class, 'featureA'])->name('feature.page.a');
        Route::get('/feature-page/sms-payroll', [PageController::class, 'featureP'])->name('feature.page.p');
        Route::get('/feature-page/online-class', [PageController::class, 'featureO'])->name('feature.page.o');
        Route::get('/feature-page/employee-management', [PageController::class, 'featureE'])->name('feature.page.e');
        Route::get('/pricing', [PageController::class, 'pricing'])->name('pricing');
        Route::post('/pricing/Checkout', [PageController::class, 'pricing_Checkout']);

        Route::get('/get/started', [PageController::class, 'getStarted'])->name('getStarted.post');
        Route::get('/signup/post/otp', [LoginController::class, 'getSignupOtp'])->name('signup.post.otp');
        Route::get('/signup', [PageController::class, 'getSignupView'])->name('signup.get');
        Route::post('/signup/post', [PageController::class, 'getSignup'])->name('signup.post');

        Route::post('/otp/send', [PageController::class, 'otpPost'])->name('otp.post');
        Route::post('/otp/resend', [PageController::class, 'otpResent'])->name('resend.otp');
        Route::get('/term-condition', [PageController::class, 'termsCondition'])->name('term.condition');
        Route::get('/videos', [PageController::class, 'video'])->name('videos.page');
        Route::get('/blog', [PageController::class, 'blog'])->name('blog.page');


        Route::get('/home',    [App\Http\Controllers\HomeController::class, 'index'])->name('user.dashboard');
        Route::view('/payment', 'amarpayment');
        Route::view('/about', 'about');
        Route::view('/privacy', 'privacy');
        Route::view('/changelog', 'changelog');
        Auth::routes();
        Route::get('/login', function () {
            return redirect()->route('school.login');
        })->name('login');

        Route::get('/central', [LoginController::class, 'showAdminLoginForm']);
        Route::get('/login/school', [LoginController::class, 'showSchoolLoginForm'])->name('school.login');
        Route::get('/login/teachers', [LoginController::class, 'showTeacherLoginForm'])->name('teachers.login');
        Route::get('/register/admin', [RegisterController::class, 'showAdminRegisterForm']);
        Route::get('/register/school', [RegisterController::class, 'showSchoolRegisterForm']);
        Route::post('/login/admin', [LoginController::class, 'adminLogin']);
        Route::post('/login/schools', [LoginController::class, 'schoolLogin']);
        Route::post('/login/teachers', [LoginController::class, 'teacherLogin']);
        Route::post('/register/admin', [RegisterController::class, 'createAdmin']);
        Route::get('logout', [LoginController::class, 'logout']);
        Route::get('/back', [PageController::class, 'backa'])->name('back');
        Route::post('/otp/post/admin',    [LoginController::class, 'otpLoginAdmin'])->name('otp.login.admin');

        Route::middleware('auth')
        ->group(function(){
            Route::get('/otp',[App\Http\Controllers\SchoolController::class, 'otpLogin'])->name('otp.login');
            Route::post('/otp/post',    [App\Http\Controllers\SchoolController::class, 'otpPostLogin'])->name('otp.login.post');
            Route::get('/acquisition',    [App\Http\Controllers\SchoolController::class, 'acquisition'])->name('acquisition');
            Route::post('/acquisition/post',    [App\Http\Controllers\SchoolController::class, 'acquisitionPost'])->name('acquisition.post');
        });
    });