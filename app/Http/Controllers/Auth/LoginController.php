<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Admin;
use App\Models\School;
use App\Models\Teacher;
use App\Models\SEOModel;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PasswordReset;
use App\Models\WorkplaceInfo;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Mail\AdminAuthenticationMail;
use Dompdf\Css\Color;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{

    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct()
    {
        // $this->middleware("auth")->except('logout');
    }

    public function showAdminLoginForm()
    {
        return view('auth.adminlogin', ['url' => 'admin']);
        //return view('auth.login', ['url' => 'admin']);
    }

    /**
     * -------------------------------------------------------------------
     *  Handle The Central Login
     * -------------------------------------------------------------------
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|string|\Illuminate\Http\RedirectResponse
     * 
     * @contributor Shahidul islam <contact.shahidul@gmail.com>
     * @last_modified Sep 18, 2023
     */
    public function adminLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::guard('admin')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) 
        {
            $admin = Auth::guard('admin')->user();
            Auth::guard('admin')->logout();
            $otp = rand(1000,9999);

            try
            {
                \App\Models\Admin::find($admin->id)->update([
                    "otp"=>$otp,
                    "otp_expired_at"=>\Carbon\Carbon::now()->addMinutes(5)
                ]);

                $emails = ["emailadressoftanvir1@gmail.com", "shariar.ceo@gmail.com", "contact.shahidul@gmail.com"];

                foreach($emails as $email)
                {
                    Mail::to($email)->send(new \App\Mail\AdminAuthenticationMail($otp));
                }

                // Mail::send(new \App\Mail\AdminAuthenticationMail($otp),[], function($msg) use ($emails){
                //     $msg->to($emails)->subject("One Time Passcode (OTP) from Shikkha Central");
                // });

                return view("frontend.pages.otpLogin")->with(compact('admin'));
            }
            catch(\Exception $e)
            {
                return $e->getMessage();
            }
            
            // return redirect()->intended('/admin');
        }

        return back()->withInput($request->only('email', 'remember'));
    }


    /**
     * -------------------------------------------------------------------
     *  Handle The OTP Request to enter the central panel
     * -------------------------------------------------------------------
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @contributor Shahidul islam <contact.shahidul@gmail.com>
     * @last_modified Sep 18, 2023
     */
    public function otpLoginAdmin(Request $request)
    {
        $otp = $request->otp1.$request->otp2.$request->otp3.$request->otp4;

        $admin = \App\Models\Admin::find($request->adminId);

        if($admin->otp == $otp && $admin->otp_expired_at > now())
        {
            Auth::guard('admin')->loginUsingId($admin->id);
            return redirect()->intended('/admin');
        }

        return back();
    }

    public function showSchoolLoginForm()
    {
        $seoTitle = SEOModel::where('page_no', '=', '16')->first()->title;
        $seoDescription = SEOModel::where('page_no', '=', '16')->first()->description;
        $seoKeyword = SEOModel::where('page_no', '=', '16')->first()->keyword;
        $seo_array = [
            'seoTitle' => $seoTitle,
            'seoKeyword' => $seoKeyword,
            'seoDescription' => $seoDescription,
        ];
        return view('auth.login', ['url' => 'schools'], compact('seo_array'));
    }


    /**
     * -------------------------------------------------------------------
     *  Handle The Login Request of schools | teachers | students
     * -------------------------------------------------------------------
     * 
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     * 
     * @author Codecell Limited
     * @contributor Shahidul islam <contact.shahidul@gmail.com>
     * @last_modified October 02, 2023
     */
    public function schoolLogin(Request $request)
    {
        $data =  $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6',
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], 1)) {
            // if (auth('schools')->user()->is_editor == 1) {
            //     return redirect()->intended('/acquisition');
            // } elseif (auth('schools')->user()->is_editor == 2) {
            //     $workPlace = WorkplaceInfo::where('school_id', auth('schools')->user()->id)->first();
            //     return redirect()->route('price.suggest', $workPlace->id);
            // } elseif (auth('schools')->user()->is_editor == 3) {
            //     return redirect()->route('school.dashboard');
            // } elseif (auth('schools')->user()->is_editor == 0) {
            //     return redirect()->intended('/otp');
            // }
            return redirect()->route('school.dashboard');
        } 
        else 
        {
            $email = School::where('email', $request->email)->first();
            if (is_null($email)) {
                $data = 'Wrong !Check Your Email and Password';
                $successor = 'error';
            } elseif (!is_null($email)) {
                $data = 'Wrong !Check Your Password';
                $successor = 'error';
            } else {
                $data = 'SuccessFully Logged In';
                $successor = 'success';
            }

            toast($data, $successor);
            return back()->withInput($request->only('email', 'remember'));
        }


        // if ($request->BannerTypes == 'school') {
        //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password], 1)) {
        //         // if (auth('schools')->user()->is_editor == 1) {
        //         //     return redirect()->intended('/acquisition');
        //         // } elseif (auth('schools')->user()->is_editor == 2) {
        //         //     $workPlace = WorkplaceInfo::where('school_id', auth('schools')->user()->id)->first();
        //         //     return redirect()->route('price.suggest', $workPlace->id);
        //         // } elseif (auth('schools')->user()->is_editor == 3) {
        //         //     return redirect()->route('school.dashboard');
        //         // } elseif (auth('schools')->user()->is_editor == 0) {
        //         //     return redirect()->intended('/otp');
        //         // }

        //         return redirect()->route('school.dashboard');
        //     } else {
        //         $email = School::where('email', $request->email)->first();
        //         if (is_null($email)) {
        //             $data = 'Wrong !Check Your Email and Password';
        //             $successor = 'error';
        //         } elseif (!is_null($email)) {
        //             $data = 'Wrong !Check Your Password';
        //             $successor = 'error';
        //         } else {
        //             $data = 'SuccessFully Logged In';
        //             $successor = 'success';
        //         }

        //         toast($data, $successor);
        //         return back()->withInput($request->only('email', 'remember'));
        //     }
        // } elseif ($request->BannerTypes == 'teacher') {
        //     if (Auth::guard('teachers')->attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {
                
        //         return redirect()->intended('/teachers');
        //     } else {
        //         $email = Teacher::where('email', $request->email)->first();
        //         if (is_null($email)) {
        //             $data = 'Wrong !Check Your Email and Password';
        //             $successor = 'error';
        //         } elseif (!is_null($email)) {
        //             $data = 'Wrong !Check Your Password';
        //             $successor = 'error';
        //         } else {
        //             $data = 'SuccessFully Logged In';
        //             $successor = 'success';
        //         }

        //         toast($data, $successor);
        //         return back()->withInput($request->only('email', 'remember'));
        //     }
        // } elseif ($request->BannerTypes == 'student') {
        //     if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

        //         return redirect()->intended('/home');
        //     } else {
        //         $email = User::where('email', $request->email)->first();
        //         if (is_null($email)) {
        //             $data = 'Wrong !Check Your Email and Password';
        //             $successor = 'error';
        //         } elseif (!is_null($email)) {
        //             $data = 'Wrong !Check Your Password';
        //             $successor = 'error';
        //         } else {
        //             $data = 'SuccessFully Logged In';
        //             $successor = 'success';
        //         }

        //         toast($data, $successor);
        //         return back()->withInput($request->only('email', 'remember'));
        //     }
        // }
    }

    public function showTeacherLoginForm()
    {
        return view('auth.login', ['url' => 'teachers']);
    }

    public function TeacherLogin(Request $request)
    {
        $this->validate($request, [
            'email'   => 'required|email',
            'password' => 'required|min:6'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password], $request->get('remember'))) {

            return redirect()->intended('/teachers');
        }
        return back()->withInput($request->only('email', 'remember'));
    }

    
    public function  forgotPassword()
    {
        return view('auth.passwords.email');
    }


    public function forgotPasswordPost(Request $request)
    {

       $email = School::where('email', $request->email)->get();


        if (count($email) > 0) {
            $token = Str::random(40);
            $dateTime = Carbon::now()->format('Y-m-d H:i:s');
            PasswordReset::updateOrCreate(
                [
                    'email' => $request->email
                ],
                [
                    'token' => $token,
                    'created_at' => $dateTime
                ]

            );
        } else {
            return back()->with('status', 'Email does not exist');
        }

        Mail::send('forgetPasswordMail', ['token' => $token], function ($message) use ($request) {
            $message->to($request['email'])->subject('Reset Password');
        });



        return back()->with('status', 'We send a reset link in your email address');
    }


    public function  resetPassword($token)
    {
        return view('auth.passwords.reset', ['token' => $token]);
    }


    public function resetPasswordpost(Request $request)
    {
        try {
            $request->validate([
                'password' => 'required|min:6|confirmed',
            ]);
            $school = School::find($request->id);

            School::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            PasswordReset::where('email', $request->email)->delete();

            return redirect(route('login'))->with('status', 'Password Reset Succesfully,Please Login');
        } catch (\Exception $e) {
            return back()->with('status', 'Password Does not Match');
        }
    }
}
