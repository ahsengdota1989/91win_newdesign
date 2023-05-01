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
use Log;

class MicrogamingController extends Controller
{
    // Product : Micro Gaming 
    // **Production Account > Transfer Wallet**
    
    // this is the mg production account for 91win
    
    // BO url : https://bo200.mg.plus/
    // Username: 91win
    // Password: $G!o6mkfef
    // Agent Code ID : 91win
    // API URL : api-m8bettw.k2net.io
    // Token URL : sts-m8bettw.k2net.io
    // API Secret Key : 5098337738364912b906108c11619e
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    private function createtoken()
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sts-m8bettw.k2net.io/connect/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=91win&client_secret=5098337738364912b906108c11619e',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }
    
    public function createplayer()
    {
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
        
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-m8bettw.k2net.io/api/v1/agents/91win/players',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => "playerId=$username",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }
    
    public function sessionlivecasino()
    {
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
        
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/players/$username/sessions",
          CURLOPT_RETURNTRANSFER => true, 
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'langCode=en-us&platform=desktop&contentCode=SMG_titaniumLiveGames_Hollywood_Baccarat',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $getUrl = json_decode($response, true);
           
        $gameurl = $getUrl['url'];
        
        // return $gameurl;
        return Redirect::to($gameurl);
    }
    
    public function deposit()
    {
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
         
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $referenceid = mt_rand(100000,999999);
        
        $amount = "10";
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/WalletTransactions",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => "playerId=$username&type=Deposit&amount=$amount&idempotencyKey=$referenceid&externalTransactionId=$referenceid",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        //Log::Error($response);
        
        curl_close($curl);
        
        $res = json_decode($response, true);
        
        return $res['status'];
    }
    
    public function withdrawal()
    {
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
        
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $referenceid = mt_rand(100000,999999);
        
        $amount = "10";
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/WalletTransactions",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => "playerId=$username&type=Withdraw&amount=$amount&idempotencyKey=$referenceid&externalTransactionId=$referenceid",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }
    
    public function balance()
    {
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
        
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/players/$username?properties=balance",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $getBalance = json_decode($response, true);
        
        return $getBalance['balance']['total'];

    }
    
    private function gameCategories()
    {        
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
        
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://api-m8bettw.k2net.io/api/v1/agents/91win/games?fromReleaseDateUtc=2018-01-01%2000:00:00&toReleaseDateUtc=2022-01-01%2000:00:00',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        return $response;
    }
    
    public function microLobby()
    {
        $gameLists = $this->gameCategories();
        
        $gameArray = array();
        
        $data = json_decode($gameLists, true);
        
        foreach($data as $games)
        {
            $arr = array(
                'name' => $games['gameName'],
                'gameCode' => $games['gameCode'],
            );
            
            array_push($gameArray, $arr);
        }
        
        //return $gameArray;
        
        return view('microLobby')->with('gameArray', $gameArray);
    }
    
    public function sessionslot($gameCode)
    {
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
        
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/players/$username/sessions",
          CURLOPT_RETURNTRANSFER => true, 
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => "langCode=en-us&platform=desktop&contentCode=$gameCode",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $getUrl = json_decode($response, true);
           
        $gameurl = $getUrl['url'];
        
        //return $gameurl;
        
        //return $gameurl;
        return Redirect::to($gameurl);
    }
}
