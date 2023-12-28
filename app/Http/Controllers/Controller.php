<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    
    public static function defaultSubject()
    {
        return [
            'Bangla 1st Paper',
            'Bangla 2nd Paper',
            'English 1st Paper',
            'English 2nd Paper',
            'Math',
            'Religion',
            'ICT',
            'Agricultural Studies',
            'Physical Studies',
            'General Science',
            'Bangladesh and Global Studies'
        ];
    }
  

    /**
     * ----------------------------------------------
     *  send sms through greenweb API
     * ----------------------------------------------
     * 
     * @param string $phone
     * @param string $message
     * 
     * @return mixed
     */
    static function GreenWebSMS($phone, $message)
    {
        $url = "http://api.greenweb.com.bd/api.php?json";
        $token   = env("GREENWEB_TOKEN");

        $data = [
            'to'      => "$phone",
            'message' => "$message",
            'token'   => "$token"
        ]; // Add parameters in key value

        if(self::greenwebSmsBalance() > 1)
        {
            $http = Http::withoutVerifying()->asForm()->post($url,$data);
            $smsresult = $http->object()[0];

            if($smsresult->status == "SENT")
            {
                return $smsresult;
            }
            else
            {
                return $smsresult->statusmsg;
            }

        }
        else
        {
            throw new \ErrorException('SMS could not be sent');
        }
    }


    /**
     * ----------------------------------------------
     *  Check SMS balance of Greenweb
     * ----------------------------------------------
     * 
     * @param string $phone
     * @param string $message
     * 
     * @return float
     */
    static function greenwebSmsBalance()
    {
        $token   = env("GREENWEB_TOKEN");
        $smsPerRate   = (double)env("GREENWEB_SMS_PER_RATE", 0.26);
        $url = "http://api.greenweb.com.bd/g_api.php?token=$token&balance&json";

        $http = Http::withoutVerifying()->get($url);
        $resp = $http->object();

        $balance = (double)$resp[0]->response;
        return round($balance / $smsPerRate, 2);
    }


    /**
     * ----------------------------------------------
     *  Calculate the number of required SMS
     * ----------------------------------------------
     * 
     * @param int $numberOfUser
     * @param int $numberOfChar
     * @param string $lang
     * 
     * @return int
     */
    static function numberOfRequriedSMS(int $numberOfUser, int $numberOfChar, string $lang)
    {
        $countSMS = 1;

        if($lang == "en" && $numberOfChar > 130)
        {
            $countSMS = 2;
        }

        if($lang == "bn" && $numberOfChar > 40)
        {
            $countSMS = 2;
        }

        return $numberOfUser * $countSMS;
    }


    public function importAllUser()
    {
        $schools = \App\Models\School::all();
        

        try
        {
                
            // truncate all user
            \App\Models\AllUser::truncate();


            // find Duplicate emails
            $duplicateEmails = \App\Models\Teacher::select('email')
                ->union(\App\Models\School::select('email'))
                ->groupBy('email')
                ->havingRaw('COUNT(email) > 1')
                ->pluck('email')
                ->toArray();

            // insert School info into alluser table
            $schools = \App\Models\School::get();
            foreach ($schools as $key => $school) {
                \App\Models\AllUser::create([
                    "email" => $school->email,
                    "phone" => $school->phone,
                    "password" => $school->password,
                    "guard" => "school",
                    "guard_id" => $school->id,
                    "school_from" => $school->id,
                ]);
            }

            // insert Teacher info into alluser table    
            $teachers = \App\Models\Teacher::whereNotIn('email', $duplicateEmails)->get();

            foreach($teachers as $teacher)
            {
                \App\Models\AllUser::create([
                    "email" => $teacher->email,
                    "phone" => $teacher->phone,
                    "password" => $teacher->password,
                    "guard" => "teacher",
                    "guard_id" => $teacher->id,
                    "school_from" => $teacher->school_id,
                ]);
            }

            // remove all duplicate student email
            $duplicateStudentsEmails = \App\Models\User::select('email')
                ->union(\App\Models\School::select('email'))
                ->union(\App\Models\Teacher::select('email'))
                ->groupBy('email')
                ->havingRaw('COUNT(email) > 1')
                ->pluck('email')
                ->toArray();

            $students = \App\Models\User::whereNotIn('email', $duplicateStudentsEmails)->get();

            foreach($students as $student)
            {
                \App\Models\AllUser::create([
                    "email" => $student->email,
                    "phone" => $student->phone,
                    "password" => $student->password,
                    "guard" => "student",
                    "guard_id" => $student->id,
                    "school_from" => $student->school_id,
                ]);
            }
            
                
            

            return \App\Models\AllUser::get()->toArray();
            // DB::commit();
        }
        catch(\Exception $e)
        {
            // DB::rollBack();
            return $e->getMessage();
        }
    }

    public function importSchoolToken()
    {
        $schools = School::get();
        foreach($schools as $school){
            $token = dechex($school->id)."|".\Str::random(30);

            $schoolUpdate = School::find($school->id);
            $schoolUpdate -> api_token = $token;
            
            $schoolUpdate->save();

        }
        $schools = School::get();
        return $schools;
    }
}
