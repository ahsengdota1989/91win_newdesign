<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Facades;
use Auth;
use Log;

class HelperFourdee extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
     
    public static function getFourDeeResult()
    {
        $userName = "cashback";//$request->user_name;

        $apiUser = "r8gaming";
        $apiPass = "r8gaming@win2021";
        $user = "R8GAMING";
        $pass = "168168168";
        $loginID = "91".$userName;
        $drawDate = date('Y-m-d',strtotime("-1 days"));
        
        $currentTimeFourDee = date("H:i:s", time());
        if($currentTimeFourDee >= '20:30:00' && $currentTimeFourDee <= '23:59:00')
        {
            $drawDate = date('Y-m-d');
        }

        $param = "apiUser=$apiUser&apiPass=$apiPass&user=$user&pass=$pass&loginID=$loginID&drawDate=$drawDate";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api2.coba8.com/result.aspx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $param,
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/x-www-form-urlencoded'
              ),
        ));

        $response = curl_exec($curl);
        
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        
        return $array;
    }
    
    public static function fourDeeCreatePlayer($userName)
    {
        //$userName = $request->user_name;

        $apiUser = "r8gaming";
        $apiPass = "r8gaming@win2021";
        $user = "R8GAMING";
        $pass = "168168168";//"445577";
        $loginID = "91".$userName;
        $loginPass = "AAaa1234";
        $fullName = "91".$userName;
        $commZero = "";
        $agent = "28win";

        $param = "apiUser=$apiUser&apiPass=$apiPass&user=$user&pass=$pass&loginID=$loginID&loginPass=$loginPass&fullName=$fullName&commZero=$commZero&agent=$agent";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://api2.coba8.com/createPlayer.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        return $response;
    }

    public static function login4D($username)
    {
        $apiUser = "r8gaming";
        $apiPass = "r8gaming@win2021";
        $user = "91".$username;
        $pass = "AAaa1234";

        $param = "apiUser=$apiUser&apiPass=$apiPass&user=$user&pass=$pass";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://api2.coba8.com/betLogin.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);
        
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        //return $array;

        $user = "91".$username;
        $sessionID = $array['sessionID'];
        $tokenCode = $array['tokenCode'];
        $url = "https://api2.coba8.com/bet.aspx?";

        $param = "user=$user&sessionID=$sessionID&tokenCode=$tokenCode";

        return $url.$param;

        curl_close($curl);

        return $response;
    }
    
    public static function fourDeeDeposit($userName, $amount)
    {
        // $userName = $request->user_name;
        // $amount = $request->amount;

        $apiUser = "r8gaming";
        $apiPass = "r8gaming@win2021";
        $user = "R8GAMING";
        $pass = "168168168";//"445577";
        $loginID = "91".$userName;
        $amount = $amount;

        $param = "apiUser=$apiUser&apiPass=$apiPass&user=$user&pass=$pass&loginID=$loginID&amount=$amount";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://api2.coba8.com/deposit.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
    public static function fourdeewithdraw($userName, $amount)
    {
        // $userName = $request->user_name;
        // $amount = $request->amount;

        $apiUser = "r8gaming";
        $apiPass = "r8gaming@win2021";
        $user = "R8GAMING";
        $pass = "168168168";//"445577";
        $loginID = "91".$userName;
        $amount = $amount;

        $param = "apiUser=$apiUser&apiPass=$apiPass&user=$user&pass=$pass&loginID=$loginID&amount=$amount";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://api2.coba8.com/withdraw.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);
        curl_close($curl);
        return $response;
    }
    
    public static function fourDeeGetProfile($userName)
    {
        //$userName = $request->user_name;

        $apiUser = "r8gaming";
        $apiPass = "r8gaming@win2021";
        $user = "R8GAMING";
        $pass = "168168168";//"445577";
        $loginID = "91".$userName;

        $param = "apiUser=$apiUser&apiPass=$apiPass&user=$user&pass=$pass&loginID=$loginID";

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://api2.coba8.com/getProfile.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));

        $response = curl_exec($curl);

        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        curl_close($curl);

        // $arr = array(
        //     'message' => 'pundek',
        //     'res' => $array['balance']
        // );
        
        // Log::debug(json_encode($arr, true));

        return $array['balance'];
    }

}
