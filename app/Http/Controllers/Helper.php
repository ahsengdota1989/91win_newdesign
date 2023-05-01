<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Facades;
use Auth;
use Nexmo;
use Log;
use Twilio\Rest\Client;


class Helper extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public static function transferLog($transferFrom, $transferTo, $status, $amount)
    {
        $date = date('Y-m-d H:i:s');
        $userId = Auth::User()->id;
        
        //DB::BeginTransaction();
        try
        {
            DB::INSERT("INSERT INTO users_transfers(user_id, amount, transfer_from, transfer_to, created_at) 
                        VALUE(?,?,?,?,?)",
                        array($userId, $amount, $transferFrom, $transferTo, $date));
                        
            return 1;
        }
        catch(\Exception $ex)
        {
            //Log::Error($ex);
            
            return 0;
        }
    }
    
    public static function transferLogNew($transferFrom, $transferTo, $status, $amount, $lastAmount)
    {
        $date = date('Y-m-d H:i:s');
        $userId = Auth::User()->id;
        
        //DB::BeginTransaction();
        try
        {
            DB::INSERT("INSERT INTO users_transfers(user_id, amount, transfer_from, transfer_to, created_at, last_balance) 
                        VALUE(?,?,?,?,?,?)",
                        array($userId, $amount, $transferFrom, $transferTo, $date, $lastAmount));
            Log::Error('kukur');       
            return 1;
        }
        catch(\Exception $ex)
        {
            Log::Error($ex);
            
            return 0;
        }
    }
    
    public static function sendMessageForgot($phoneNumber, $tempPass)
    {
        $curl = curl_init();
        $data = array(
          'api_key' => "2FhMGTtKNAKUUjQtnyI6OEpshrq",
          'api_secret' => "IQMGqsCe9wvnPKSk5zgIxUiCFGIm1m13ZJr4Z6F5",
          'text' => "OTP Temporary Pass : $tempPass.",
          'to' => '+6'.$phoneNumber,
          'from' => "MOVIDEROTP"
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.movider.co/v1/sms",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => http_build_query($data),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "cache-control: no-cache"
          ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    }
            
    public static function sendMessageForgotTwo($phoneNumber, $code)
    {
        $random = rand(100000,9999999999999999);
        $message = urlencode("Your new pass is : $code");
        $key = "18a6e61b7ddeb9d833ee6f02c80b4e59";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.oneSMS.my/api/send.php?apiKey=$key&messageContent=$message&recipients=6$phoneNumber&referenceID=$random",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Cookie: language=english; PHPSESSID=o1fqpaltji7am70aautf4t0uq6'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
    }

    public static function sendMessage($phoneNumber, $code)
    {
        $curl = curl_init();
        $data = array(
          'api_key' => "2FhMGTtKNAKUUjQtnyI6OEpshrq",
          'api_secret' => "IQMGqsCe9wvnPKSk5zgIxUiCFGIm1m13ZJr4Z6F5",
          'text' => "OTP : $code",
          'to' => '+6'.$phoneNumber,
          'from' => "MOVIDEROTP"
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api.movider.co/v1/sms",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => http_build_query($data),
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "cache-control: no-cache"
          ),
        ));
    
        $response = curl_exec($curl);
        $err = curl_error($curl);
    
        curl_close($curl);
    }
    
    public static function sendMessageTwo($phoneNumber, $code)
    {
        $curl = curl_init();
        
        $random = rand(100000,9999999999999999);
        
        $message = urlencode("RM0 91win code : $code");

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.sms123.net/api/send.php?apiKey=12c851033066ec6622893c26c66bb488&recipients=$phoneNumber&messageContent=$message&referenceID=$random",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Cookie: PHPSESSID=upunlj5be09uimh7vp8pkp8906'
          ),
        ));
        
        $response = curl_exec($curl);
        
        Log::Error($response);
        
        curl_close($curl);
    }
        
    public static function sendMessageThree($phoneNumber, $code)
    {
        $random = rand(100000,9999999999999999);
        $message = urlencode("Your Pin is :$code");
        $key = "18a6e61b7ddeb9d833ee6f02c80b4e59";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://www.oneSMS.my/api/send.php?apiKey=$key&messageContent=$message&recipients=6$phoneNumber&referenceID=$random",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            'Cookie: language=english; PHPSESSID=o1fqpaltji7am70aautf4t0uq6'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
    }
    
    public static function sendMessageFour($phoneNumber, $code)
    {
        $receiverNumber = "+6$phoneNumber";
        $message = "OTP : $code";
  
        try {
  
            $account_sid = ENV("TWILIO_SID");
            $auth_token = ENV("TWILIO_TOKEN");
            $twilio_number = ENV("TWILIO_FROM");
  
            $client = new Client($account_sid, $auth_token);
            $client->messages->create($receiverNumber, [
                'from' => $twilio_number, 
                'body' => $message]);

        } catch (Exception $e) {
            Log::Error($e->getMessage());
        }
    }

    public static function getCompanyID($userID)
    {
            $getCompId = DB::SELECT("SELECT company_id FROM users_details WHERE user_id = ?",array($userID));

            return $getCompId[0]->company_id;
    }

    public static function getBankName($bankID)
    {
        try
        {
            $getBankName = DB::SELECT("SELECT bank_name FROM banks WHERE id = ?",array($bankID));

            return $getBankName[0]->bank_name;
        }
        catch(\Exception $ex)
        {
            return $ex;
        }
    }

    public static function getBankDetails($bankID)
    {
        try
        {
            $getBankDetails = DB::SELECT("SELECT * FROM banks
                WHERE id = ?",array($bankID));

            return $getBankDetails;
        }
        catch(\Exception $ex)
        {
            return $ex;
        }
    }

    public static function getUserDetails($userId)
    {
        try
        {
            $getUser = DB::SELECT("SELECT
                    a.user_name
                    , a.name
                    , a.email
                    , b.company_id
                    , b.referral_id
                    , b.phone_no
                 FROM users as a
                 INNER JOIN users_details as b ON a.id = b.user_id
                 WHERE a.id = ?",array($userId));

             return $getUser;
        }
        catch(\Exception $ex)
        {
            return $ex;
        }
    }

    public static function getGameType($gameTypeId)
    {
        $db = DB::SELECT("SELECT * FROM game_types WHERE id = ?",array($gameTypeId));

        return $db;
    }

    public static function getGameProviderName($gameId)
    {
        $db = DB::SELECT("SELECT * FROM games WHERE id = ?",array($gameId));

        return $db;
    }
}
