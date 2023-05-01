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

class AsiaGamingController extends Controller
{
    // Operator Name 代理名			91win88
    // Backend URL 后台地址			http://mdbo.galaxyworld888.com
    // Backend Username 后台账号		91win88myr
    // Backend Password 后台密码		Please refer to your Galaxy BO Password
    
    
    // API Credential 接口资料:	
    
    
    // Provider Code (providercode) 产品代码	AG
    // Operator Code (operatorcode) 代理码	rwin
    // Secret Key (secret_key) 接口密码		4197e4b9e0aca56a067f3c8226d48c1b
    // Agent Currency 货币			MYR, MALAYSIA RINGGIT
    // API_URL					http://mdapi.world3333.com
    // LOG_URL					http://mdlog.world3333.com
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function createplayer()
    {
        $userId = Auth::User()->id;

        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = strtolower($db[0]->user_name);
        $operatorCode = 'rwin';
        $secretkey = '4197e4b9e0aca56a067f3c8226d48c1b';
        $signature = md5($operatorCode.$userName.$secretkey);
        $sign = strtoupper($signature);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mdapi.world3333.com/createMember.aspx?operatorcode=$operatorCode&username=$userName&signature=$sign",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
         
        curl_close($curl);
        //echo $response;
    }
    
    public function getbalance()
    {
        $this->createplayer();
        
        $userId = Auth::User()->id;

        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        
        $userName = strtolower($db[0]->user_name);
        $operatorCode = 'rwin';
        $secretkey = '4197e4b9e0aca56a067f3c8226d48c1b';
        $providerCode = 'AG';
        $password = 'AAaa1234';
        
        $signature = md5($operatorCode.$password.$providerCode.$userName.$secretkey);
        $sign = strtoupper($signature);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mdapi.world3333.com/getBalance.aspx?operatorcode=$operatorCode&providercode=$providerCode&username=$userName&password=$password&signature=$sign",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res2 = json_decode($response, true);
        
        return number_format($res2['balance'], 2);
    }
    
    public function launchGame()
    {
        $this->createplayer();
        
        //$this->agdeposit();
        
        $userId = Auth::User()->id;

        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        
        $userName = strtolower($db[0]->user_name);
        $operatorCode = 'rwin';
        $secretkey = '4197e4b9e0aca56a067f3c8226d48c1b';
        $providerCode = 'AG';
        $password = 'AAaa1234';
        $referenceid = mt_rand(100000,999999);
        $amount = 10;
        $type = 'LC';//slot
        
        $signature = md5($operatorCode.$password.$providerCode.$type.$userName.$secretkey);
        $sign = strtoupper($signature);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mdapi.world3333.com/launchGames.aspx?operatorcode=$operatorCode&providercode=$providerCode&username=$userName&password=$password&type=$type&gameid=0&lang=en-US&html5=1&signature=$sign",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res2 = json_decode($response, true);
        
        //return $res2['gameUrl'];
        
        return Redirect::to($res2['gameUrl']);
    }
    
    public function launchSlotgame()
    {
        $this->createplayer();
        
        $userId = Auth::User()->id;

        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        
        $userName = strtolower($db[0]->user_name);
        $operatorCode = 'rwin';
        $secretkey = '4197e4b9e0aca56a067f3c8226d48c1b';
        $providerCode = 'AG';
        $password = 'AAaa1234';
        $referenceid = mt_rand(100000,999999);
        $amount = 10;
        $type = 'SL';//slot
        
        $signature = md5($operatorCode.$password.$providerCode.$type.$userName.$secretkey);
        $sign = strtoupper($signature);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mdapi.world3333.com/launchGames.aspx?operatorcode=$operatorCode&providercode=$providerCode&username=$userName&password=$password&type=$type&gameid=0&lang=en-US&html5=1&signature=$sign",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res2 = json_decode($response, true);
        
        //return $res2['gameUrl'];
        
        return Redirect::to($res2['gameUrl']);
    }
}
