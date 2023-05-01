<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Helper;
use Illuminate\Support\Facades\App;
use Mail;
use Auth;
use Hash;
use App\User;
use Redirect;
use Log;

class MaxbetController extends Controller
{
    // 玩家前缀 91w
    // Operator ID  91w
    // Vendor_id kidetu2709
    
    // Production API URL: http://m4v7api.db5688.com/api
    
    // For more integration info please refer API DOC:
    // Chinese: https://developer.onebook.dev/DocumentDownload/boping_api_integration_ch.html
    // English: https://developer.onebook.dev/DocumentDownload/boping_api_integration.html

    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function createMember()
    {
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        $maxbetUsername = "91w_1".$username;
        $oddsType = 1;
        $currency = 2;
        $maxTransfer = 9999999;
        $minTransfer = 5;
        
        $param2 = array(
            "vendor_id" => $vendorId,
            "vendor_member_id" => $maxbetUsername,
            "operatorId" => $operatorId,
            "username" => $maxbetUsername,
            "oddstype" => $oddsType,
            "currency" => $currency,
            "maxtransfer" => $maxTransfer,
            "mintransfer" => $minTransfer
        );
        
        $url = "http://m4v7api.db5688.com/api/CreateMember";
        
        $param = "vendor_id=$vendorId&vendor_member_id=$maxbetUsername&operatorId=$operatorId&username=$maxbetUsername&oddstype=1&maxtransfer=99999&mintransfer=5&currency=$currency";
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }
    
    public static function login()
    {
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        
        $url = "http://m4v7api.db5688.com/api/GetSabaUrl";
        
        $param = "vendor_id=$vendorId&vendor_member_id=$vendorMemberId&platform=1"; //1=desktop, 2=mobile
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $data = json_decode($response, true);
        
        return $data['Data'];

        if (App::isLocale('ch')) 
        {
            return redirect($data['Data']."&lang=cs");
        }
        else
        {
            return redirect($data['Data']);
        }
    }
    
    public function balance()
    {
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        $walletId = 1;
        
        $url = "http://m4v7api.db5688.com/api/CheckUserBalance";
        
        $param = "vendor_id=$vendorId&vendor_member_ids=$vendorMemberId&wallet_id=$walletId";
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $data = json_decode($response, true);
        
        
        return $data['Data'][0]['balance'];
    }
    
    public function deposit()
    {
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        $walletId = 1;
        $transId = "91w_".mt_rand(100000,999999999);
        $amount = 10;
        $direction = 1; //1=deposit , 0 = withdraw
        
        $url = "http://m4v7api.db5688.com/api/FundTransfer";
        
        $param = "vendor_id=$vendorId&vendor_member_id=$vendorMemberId&wallet_id=$walletId&vendor_trans_id=$transId&amount=$amount&currency=2&direction=$direction";
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res = json_decode($response, true);
        
        return $res['error_code'];
    }
    
    public function withdraw()
    {
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        $walletId = 1;
        $transId = "91w_".mt_rand(100000,999999999);
        $amount = 10;
        $direction = 0; //1=deposit , 0 = withdraw
        
        $url = "http://m4v7api.db5688.com/api/FundTransfer";
        
        $param = "vendor_id=$vendorId&vendor_member_id=$vendorMemberId&wallet_id=$walletId&vendor_trans_id=$transId&amount=$amount&currency=2&direction=$direction";
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }
}
