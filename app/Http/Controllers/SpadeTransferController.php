<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Helper;
use Mail;
use Auth;
use Hash;
use App\User;
use Redirect;

class SpadeTransferController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    // Product: Spade Gaming
    // Brand: 91win88
    // *Production Account*
    
    // BO information Live: http://backoffice.silverkirin88.com
    // Merchant Code: 91W88
    // ID: 91W88ADMIN
    // Password: Aa123456@
    // Callback URL: https://91win999.com/sites/gameApi/public/spadetransfer
        
    public function launchSpadeGaming($gameCode)
    {
        $url = "http://lobby.silverkirinplay.com/91W88/auth/?";

        $accId = Auth::User()->user_name;
        $language = "en_US";
        $token = $accId;
        $fun = "true";
        $menuMode = "on";
        $lobby = "SG";
        $isMobile = 0;

        if($isMobile == 0)
        {
            $isMobile = "false";
        }
        else
        {
            $isMobile = "true";
        }

        $params = "acctId=$accId&language=$language&token=$token&lobby=$lobby&mobile=$isMobile&game=$gameCode";

        $fullUrl = $url.$params;
        
        // return $fullUrl;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $fullUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        // return $response;
        
        return view('launchSG')->with('response', $response);
    }
    
    public function spadeGamingLobby()
    {
        $db = DB::SELECT("SELECT * FROM spadegaming_slots");

        $array = array();
        foreach($db as $slots)
        {
            $arr = array(
                'game_name' => $slots->game_name,
                'game_code' => $slots->game_code,
                'image_name' => $slots->image_name,
            );

            array_push($array, $arr);
        }

        return view('spadeGamingLobby')->with('array', $array);
    }

    public function spadebalance()
    {
        $acctId = Auth::User()->user_name;
        $pageIndex = 1;
        $serialNo = mt_rand(10000,999999999);
        $merchantCode = "91W88";
        
        $param = array(
            'acctId' => $acctId,
            'pageIndex' => $pageIndex,
            'serialNo' => $serialNo,
            'merchantCode' => $merchantCode
        );
        
        $securityKey = "91W88O7kyHYDuLcoAoCFE";
        $digest = json_encode($param, true).$securityKey;
        $digest = md5($digest);
        
        $url = "http://merchantapi.silverkirin88.com/api";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($param, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
          CURLOPT_HTTPHEADER => array(
            'API: getAcctInfo',
            'Datatype: JSON',
            'Content-Type: application/json',
            'Digest: '.$digest
          )
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response, true);
        
        return $response;
        
        curl_close($curl);
        
        return number_format($response['list'][0]['balance'], 2);
    }
    
    public function spadedeposit()
    {
        $amount = "10";
        $acctId = Auth::User()->user_name;
        $serialNo = mt_rand(10000,999999999);
        $merchantCode = "91W88";
        
        $param = array(
            'acctId' => $acctId,
            'currency' => 'MYR',
            'amount' => $amount,
            'merchantCode' => $merchantCode,
            'serialNo' => $serialNo
        );
        
        $url = "http://merchantapi.silverkirin88.com/api";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($param, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
          CURLOPT_HTTPHEADER => array(
            'API: deposit',
            'Datatype: JSON',
            'Content-Type: application/json',
            'Digest: '
          )
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response, true);
        
        curl_close($curl);
        
        return $response['code'];
    }
    
    public function spadewithdrawal()
    {
        $amount = "10";
        $acctId = Auth::User()->user_name;
        $serialNo = mt_rand(10000,999999999);
        $merchantCode = "91W88";
        
        $param = array(
            'acctId' => $acctId,
            'currency' => 'MYR',
            'amount' => $amount,
            'merchantCode' => $merchantCode,
            'serialNo' => $serialNo
        );
        
        $url = "http://merchantapi.silverkirin88.com/api";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => $url,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($param, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
          CURLOPT_HTTPHEADER => array(
            'API: withdraw',
            'Datatype: JSON',
            'Content-Type: application/json',
            'Digest: '
          )
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response, true);
        
        curl_close($curl);
        
        return $response['code'];
    }
    
}
