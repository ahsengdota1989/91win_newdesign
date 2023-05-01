<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades;
use Illuminate\Support\Facades\DB;
use Auth;
use Redirect;
use Exception;
use Log;

class BalanceController extends Controller
{ 
    private function ibccreateMember()
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
    
    public function ibc()
    {
        $this->ibccreateMember();
        
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
        
        return number_format($data['Data'][0]['balance'], 2);
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
    
    private function microcreateplayer()
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
        
        //return $response;
    }
    
    public function microgaming(request $request)
    {
        $username = Auth::User()->user_name;
        
        $this->microcreateplayer();
        
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
        
        return number_format($getBalance['balance']['total'], 2);
    }
    
    private function registersbo() 
    {
        $username = Auth::User()->user_name;
        
        $param = array(
            "CompanyKey" => "0D199E24C98D4A9CA6B18060DA7109EC",
            "ServerId" => "YY-production",
            "Username" => $username,
            "Agent" => "aaaa000099",
            "UserGroup" => "a"
        );
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ex-api-yy.xxttgg.com/web-root/restricted/player/register-player.aspx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($param),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
    }
    
    public function sbo(request $request)
    {
        // return "Maintenance";
        //register sbo player
        $this->registersbo();
        
        $username = Auth::User()->user_name;
        $referenceid = mt_rand(100000,999999999);
        
        $param = array(
            "CompanyKey" => "0D199E24C98D4A9CA6B18060DA7109EC",
            "ServerId" => "YY-production",
            "Username" => $username,
        );
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://ex-api-yy.xxttgg.com/web-root/restricted/player/get-player-balance.aspx',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($param),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res2 = json_decode($response, true);
        
        return number_format($res2['balance'], 2);
    }
    
    private function CheckOrCreate($username)
    {
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/CheckOrCreate"; //api interface @ which function to be called 
        $client = $username.'_'.$companyId;
        $contentType = "application/json";
        $httpMethod = "POST";
        $accSuffix = "3ia";

        //Please replace with your Operator ID
        $propertyId = "9399976";
        //Please replace with your AllBet API Key
        $allbetApiKey = "/p3Eq6Uk5muwbiS7x96jGgVnhGUGI2tKMW1U1HMmj6jymTmIQFWuE8m/k76PncoohDfBqiYNfZuiiFCk7cKJrw==";

        //okay
        $date   = new \DateTime("now", new \DateTimeZone("UTC"));
        $requestTime = $date->format('D, d M Y H:m:s T'); // "Wed, 28 Apr 2021 06:13:54 UTC"; 
        
        //okay
        $postArray = array(
            'agent' => $agent,
            'player' => $client.$accSuffix
        );

        //okay
        $requestBodyString = json_encode($postArray, true);
        $contentMD5 =  base64_encode(pack('H*', md5($requestBodyString)));
        
        //The steps to generate HTTP authorization headers
        $stringToSign = $httpMethod . "\n"
          . $contentMD5 . "\n"
          . $contentType . "\n"
          . $requestTime . "\n"
          . $path;

          
        //Use HMAC-SHA1 to sign and generate the authorization
        $deKey = base64_decode($allbetApiKey);
        $hash_hmac = hash_hmac("sha1", $stringToSign, $deKey, true);
        $encrypted = base64_encode($hash_hmac);
        $authorization = "AB" . " " . $propertyId . ":" . $encrypted;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiURL . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestBodyString,
            CURLOPT_HTTPHEADER => array(
                'Accept: '.$contentType,
                'Authorization: '.$authorization,
                'Content-MD5: '.$contentMD5,
                'Content-Type: '.$contentType,
                'Date:'.$requestTime
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $res = json_decode($response, true);
        
        return $res['resultCode'];
    }
    
    public function allbetbalance()
    {
        // return "Maintenance";
        $username = Auth::User()->user_name;

        $create = $this->CheckOrCreate($username);

        if($create == 'OK' || $create == 'PLAYER_EXIST')
        {
            $companyId = 1; //test
            $apiURL = "https://mw2.absvc.net";
            $agent = "91winyh";
            $path = "/GetBalances"; //api interface @ which function to be called 
            $client = $username.'_'.$companyId;
            $contentType = "application/json";
            $httpMethod = "POST";
            $accSuffix = "3ia";
            
            //Please replace with your Operator ID
            $propertyId = "9399976";
            $rand = mt_rand(1000000000000,9999999999999);
            $rand2 = $propertyId.$rand;
            
            //Please replace with your AllBet API Key
            $allbetApiKey = "/p3Eq6Uk5muwbiS7x96jGgVnhGUGI2tKMW1U1HMmj6jymTmIQFWuE8m/k76PncoohDfBqiYNfZuiiFCk7cKJrw==";
    
            //okay
            $date   = new \DateTime("now", new \DateTimeZone("UTC"));
            $requestTime = $date->format('D, d M Y H:m:s T'); // "Wed, 28 Apr 2021 06:13:54 UTC"; 
            
            //okay
            $postArray = array(
                'pageSize' => 1000,
                'pageIndex' => 1,
                'recursion' => 1,
                'players' => array($client.$accSuffix)
            );
    
            //okay
            $requestBodyString = json_encode($postArray, true);
            
            // Log::Error($requestBodyString);
            $contentMD5 =  base64_encode(pack('H*', md5($requestBodyString)));
            
            //The steps to generate HTTP authorization headers
            $stringToSign = $httpMethod . "\n"
              . $contentMD5 . "\n"
              . $contentType . "\n"
              . $requestTime . "\n"
              . $path;
    
            //Use HMAC-SHA1 to sign and generate the authorization
            $deKey = base64_decode($allbetApiKey);
            $hash_hmac = hash_hmac("sha1", $stringToSign, $deKey, true);
            $encrypted = base64_encode($hash_hmac);
            $authorization = "AB" . " " . $propertyId . ":" . $encrypted;
    
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => $apiURL . $path,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $requestBodyString,
                CURLOPT_HTTPHEADER => array(
                    'Accept: '.$contentType,
                    'Authorization: '.$authorization,
                    'Content-MD5: '.$contentMD5,
                    'Content-Type: '.$contentType,
                    'Date:'.$requestTime
                ),
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
    
            $res = json_decode($response, true);
            
            //return $response;
    
            return number_format($res['data']['list'][0]['amount'], 2);
        }
    }
    
    public function spadebalance()
    {
        $this->spadedeposit();
        
        $userId = Auth::User()->id;
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
        
        $url = "http://merchantapi.silverkirin88.com/api/";
        
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
            'Digest:'.$digest
          )
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response, true);
        
        $arrrr = array(
            'spade_message' => $response
        );
        
        Log::Error($arrrr);
        
        curl_close($curl);
        
        if($response['list'][0]['balance'] <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET spade_turnover = ? WHERE user_id = ?",array(0, $userId));
        }
        
        return number_format($response['list'][0]['balance'], 2);
    }
    
    public function spadedeposit()
    {
        $url = "http://lobby.silverkirinplay.com/91W88/auth/?";

        $accId = Auth::User()->user_name;
        $language = "en_US";
        $token = $accId;
        $gameCode = "S-RH01";

        $params = "acctId=$accId&token=$token&game=$gameCode";

        $fullUrl = $url.$params;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $fullUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
        ));

        $response = curl_exec($curl);

        curl_close($curl);
    }
    
    public function pragmaticbalance()
    {
        $userId = Auth::User()->id;
        
        $db = DB::SELECT("SELECT pp_balance FROM users_wallets WHERE user_id = ?",array($userId));
        
        if($db[0]->pp_balance <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET pragmatic_turnover = ? WHERE user_id = ?",array(0, $userId));
        }
        
        return number_format($db[0]->pp_balance, 2);
    }
    
    public function m8sportsbalance()
    {
        $userId = Auth::User()->id;
        
        $db = DB::SELECT("SELECT m8_balance FROM users_wallets WHERE user_id = ?",array($userId));
        
        if($db[0]->m8_balance <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET m8_turnover = ? WHERE user_id = ?",array(0, $userId));
        }
        
        return number_format($db[0]->m8_balance, 2);
    }
    
    public function nineoneeightaddUser()
    {
        $userId = Auth::User()->id;
        
        //get mega password
        $db = DB::SELECT("SELECT phone_number, name, mega_password FROM users WHERE id = ?",array($userId));
        
        $dd = $db[0]->phone_number.$userId;
        $password = $db[0]->mega_password;
        $name = urlencode($db[0]->name); 
        $phoneNum = $db[0]->phone_number;  
        
        $params = array(
            "phoneno" => $phoneNum,
            "userid" => $userId,
            "name" => $name,
            "mega_password" => $password
        );
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://91win999.com/918kiss/createaccount.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params, true),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        if(curl_errno($curl)){
            //Log::Error('Curl error: ' . curl_error($curl));
            //return 0;
            return "Curl error: ".curl_error($curl);
        }
        
        curl_close($curl);
        
        return $response;
    }
    
    public function nineoneeightbalance()
    {
        // return "Maintenance";
        $this->nineoneeightaddUser();
        
        $userId = Auth::User()->id;
        
        //get mega password
        $db = DB::SELECT("SELECT phone_number FROM users WHERE id = ?",array($userId));
        
        $phoneNum = $db[0]->phone_number;  
        
        $params = array(
            "phoneno" => $phoneNum,
            "userid" => $userId
        );
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://91win999.com/918kiss/balance.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($params, true),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        Log::Error($response);
        if(curl_errno($curl)){
            //Log::Error('Curl error: ' . curl_error($curl));
            //return 0;
            return "Curl error: ".curl_error($curl);
        }
        
        curl_close($curl);
        
        return number_format($response, 2);
    }
    
    private function addUser()
    {
        $userId = Auth::User()->id;
        
        //get mega password
        $db = DB::SELECT("SELECT phone_number, name, mega_password FROM users WHERE id = ?",array($userId));
        
        $randomNum = mt_rand(10,999);
        
        $agent = 'psyapi91w';
        $userName = Auth::User()->user_name;
        $dd = 'myr'.$userId;
        $password = "MXMpxyuu".$randomNum;
        $name = urlencode($db[0]->name); 
        $phoneNum = $db[0]->phone_number;  
        $authCode = "gXSJqWgYfEpuEmbcfwBA";
        $secretkey = "a543dfh2649tn793V6hQ";
        $time = time()*1000;
        
        //return $time;
        $sign = strtolower($authCode.$dd.$time.$secretkey); //what is wrong with this part ???
        $sign2 = strtoupper(md5($sign));
        
        $url = "http://api.pussy888.com/ashx/account/account.ashx?";
        $param = "action=addUser&agent=$agent&PassWd=$password&pwdtype=1&userName=$dd&Name=$name&Tel=$phoneNum&Memo=oldplayer&UserType=1&time=$time&authcode=$authCode&sign=$sign2";
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url.$param,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));
        
        $response = curl_exec($curl);
        
        $res = json_decode($response, true);
        
        if($res['code'] == 0)
        {
            DB::UPDATE("UPDATE users SET pussy_password = ? WHERE id = ?",array($password, $userId));
        }
        
        curl_close($curl);
    }
    
    public function pussybalance()
    {
        $this->addUser();
        
        //create pussy member 1st
        $userId = Auth::User()->id;
        
        $agent = 'psyapi91w';
        $dd = 'myr'.$userId;
        $authCode = "gXSJqWgYfEpuEmbcfwBA";
        $secretkey = "a543dfh2649tn793V6hQ";
        $time = time()*1000;
        $sign = strtolower($authCode.$dd.$time.$secretkey); //what is wrong with this part ???
        $sign2 = strtoupper(md5($sign));
        $random = mt_rand(100000,99999999999);
        $amount = 10*-1;
        $actionUser = "admin";
        $actionIp = "103.6.198.129";
        
        $url = "http://api.pussy888.com/ashx/account/account.ashx?";
        $param = "action=getSearchUserInfo&userName=$dd&time=$time&authcode=$authCode&sign=$sign2";
        
        //return $url.$param;
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url.$param,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
        ));
        
        $response = curl_exec($curl);
        
        if(curl_errno($curl)){
            //Log::Error('Curl error: ' . curl_error($curl));
            return "Maintenance";
        }
        
        curl_close($curl);
        
        if($response == '')
        {
            return "Maintenance";
        }
        else
        {
            $res = json_decode($response, true);
            
            if($res['results'][0]['MoneyNum'] <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET pussy_min_withdraw = ? WHERE user_id = ?",array(0, $userId));
            }
            
            return number_format($res['results'][0]['MoneyNum'], 2);
        }
    }
    
    public function evobalance()
    {
        $username = Auth::User()->user_name;
        $companyId = 1;//$request->company_id;
        $userId = Auth::User()->id;
        
        $user = $username.'@'.$companyId;
        $url = 'https://api.luckylivegames.com';
        $apiToken = '1978b7d8c8fe297078bb149d97099aa6';
        $casinoKey = 'z6ut2hgsmrpje9bj';
        $params = "/api/ecashier?cCode=RWA&ecID=$casinoKey&euID=$user&output=1";
        
        $this->userAuthTransfer($username, $companyId, 1);
        
        $fullUrl = $url.$params;
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => $fullUrl,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $xml = simplexml_load_string($response);
        
        $data = json_decode(json_encode($xml),true);
        
        if($data['tbalance'] <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET evo_turnover = ? WHERE user_id = ?",array(0, $userId));
        }
        
        return number_format($data['tbalance'], 2);
    }
    
    private function userAuthTransfer($username, $companyId, $isMobile)
    {
        $url = 'https://api.luckylivegames.com';
        $apiToken = '1978b7d8c8fe297078bb149d97099aa6';
        $casinoKey = 'z6ut2hgsmrpje9bj';
        $fullUrl = "$url/ua/v1/$casinoKey/$apiToken";//."/ua/v1/".$casinoKey."/".$apiToken;
        $mobile = false;
        if($isMobile == 1)
        {
            $mobile = true;
        }
        
        if($isMobile == 0)
        {
            $mobile = false;
        }
        
        $ip = request()->ip();
        
        $authData = array(
            'uuid' => rand(),
            'player' => array(
                'id' => $username.'@'.$companyId,
                'update' => true,
                'firstName' => $username,
                'lastName' => $username,
                'nickname' => $username,
                'country' => 'MY',
                'language' => 'EN',
                'currency' => 'MYR',
                'session' => array(
                    'id' => '1234567890asfdkygzxv',
                    'ip' => $ip,
                ),
                'group' => array(
                    'id' => 'qdqifr7lwucakxeb',
                    'action' => 'assign'
                ),
            ),
            'config' => array(
                'brand' => array(
                    'id' => '1',
                    'skin' => '1',
                ),
                'game' => array(),
                'channel' => array(
                    'wrapped' => false,
                    'mobile' => $mobile,
                ),
                'urls' => array(
                    'cashier' => 'http://www.chs.ee',
                    'responsibleGaming' => 'http://www.RGam.ee',
                    'lobby' => 'http://www.lobb.ee',
                    'sessionTimeout' => 'http://www.sesstm.ee',
                    // 'gameHistory' => '',
                    // 'realityCheckURL' => '',
                )
            ),
        );
        
        //return $authData;
        
        $res = $this->postData($fullUrl, $authData);
        
        return $res;
    }
    
    private function postData($url,$data,$header = '')
    {
        $ch = curl_init();
        
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_POST, 1);
        
        if($header == '')
        {
            $header = array('Content-Type: application/json');
        }
        
        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
        
        if (is_array($data))
        {
            $data = json_encode($data);
        }
        
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        return $response;
    }
    
    public function jokerbalance()
    {
        $username = Auth::User()->user_name;
        $userId = Auth::User()->id;
        
        $this->launchJokerTransferGame2('cuarr8e1ncebn');
        
        $AppID = 'F7FG';
        $SecretKey = 'bfaysomme8aok';
        $ApiUrl = 'http://api688.net/';
        $GameUrl = 'http://www.gwc688.net/';
        
        $fields = [
            'Method' => 'GC',
            'Timestamp' => time(),
            'Username'  => $username
        ];
        
        $signature = $this->GetSignature($fields);
        
        $url = $ApiUrl."?AppID=".$AppID."&Signature=".$signature;
        
        $postData = json_encode($fields);
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postData);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json')
        );
        
        $data = curl_exec($curl);
        
        if(curl_errno($curl)){
            //Log::Error('Curl error: ' . curl_error($curl));
            return "Maintenance";
        }
        
        curl_close($curl);
        
        $result = json_decode($data, true);
        
        if($result['Credit'] <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET joker_turnover = ? WHERE user_id = ?",array(0, $userId));
        }
        
        return number_format($result['Credit'], 2);
    }
    
    private function launchJokerTransferGame2($gameCode)
    {
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/jokerGetPlayGameUrl";
        $companyId = env('COMPANY_ID', '1');
        
        $data = array(
            'user_name' => Auth::User()->user_name,
            'game_code' => $gameCode,
            'is_mobile' => "false"
        );
        
        $curl = curl_init();
        
        if ($curl === false)
        {
            throw new Exception('failed to initialize');
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: XSRF-TOKEN=eyJpdiI6ImIwbXFzbXFJZXlcL0pva3hhRW53SlwvUT09IiwidmFsdWUiOiI5cFJQWktpa1BiNXhZTlBqWXpSMnR4M0pJWWRtYzViT2VqRXBqQkRnUzFNY3VaYTJEM2FobjZcL25lNlV1ajhFOCIsIm1hYyI6IjU1ZTM5OGFkNjFkN2YyMzM1YzAwYWE1Njk1YmYzOTdlOTc1NGQ5ZjdiZjRjYTBkN2E0OGI5NzlkMzU0MzJhYmQifQ%3D%3D; laravel_session=eyJpdiI6IjhXVG8rakU4ZmRLcXFudnc5UG1hSGc9PSIsInZhbHVlIjoiZUR0U29CMVNFc1pzXC9TS05qcTJhRkphbjhVYW1yMDdpYUwwQjNhMVZCSmRtYjNad2tLbVVWYzVtYldtQVBmTzciLCJtYWMiOiIxZWM4ZjhjN2E0N2RjNDI1MjY2N2NmYzAyODM0MWI5ZTg1NWQ3NDcyNjM0NDdiN2Q1ZGQ5NDJjMTY1NGExNzA5In0%3D'
            ),
        ));
        
        $response = curl_exec($curl);
        
        //Check the return value of curl_exec(), too
        if ($response === false)
        {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        
        curl_close($curl);
    }
    
    private function GetSignature($fields)
    {
        $AppID = 'F7FG';
        $SecretKey = 'bfaysomme8aok';
        $ApiUrl = 'http://api688.net/';
        $GameUrl = 'http://www.gwc688.net/';
        
        ksort($fields);
        $signature = urlencode(base64_encode(hash_hmac("sha1", urldecode(http_build_query($fields,'', '&')), $SecretKey, TRUE)));
        
        return $signature;
    }
    
    public function megabalance()
    {
        //return "Maintenance";
        $userId = Auth::User()->id;
        
        $db = DB::SELECT("SELECT a.user_name, a.mega_login_id, a.mega_password, b.balance FROM users as a
            INNER JOIN users_wallets as b ON a.id = b.user_id WHERE a.id = ?",array($userId));
            
            $uname = $db[0]->user_name;
            
            $createAcc = $this->createMemberMega888($uname, 1);
            
            $loginId = $db[0]->mega_login_id;
            
            $curl = curl_init();
            $url = 'http://mpleti.tjzhmhs.com/mega-cloud/api/';
            
            $sn = 'ld00';
            $agentLoginId = 'Mega1-1639';
            $random = rand();
            $secretCode = '7fygKdIAIq3tAwDcqjB+0VtvxcE=';
            
            $array = array(
                'id' => $random,
                'method' => 'open.mega.balance.get',
                'params' => array(
                    'random' => $random,
                    'digest' => md5($random.$sn.$loginId.$secretCode),
                    'sn' => $sn,
                    'loginId' => $loginId,
                ),
                'jsonrpc' => '2.0'
            );
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://mpleti.tjzhmhs.com/mega-cloud/api/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($array, true),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            
            $response = curl_exec($curl);
            
            if($response === null)
            {
                return 'Maintenance';
            }
            
            $data = json_decode($response, true);
            
            if($data['result'] <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET mega_min_withdraw = ? WHERE user_id = ?",array(0, $userId));
            }
            
            curl_close($curl);
            
            return number_format($data['result'], 2);
            //}
    }
        
    private function createMemberMega888($userName, $companyId)
    {
        /*
        * need to check if already create account for this member , then cannot create anymore
        *
        *
        */
        // $userName = $request->user_name;
        // $companyId = $request->company_id;
        
        //check member already created or not
        $db = DB::SELECT("SELECT a.mega_login_id FROM users as a
                        INNER JOIN users_details as b ON a.id = b.user_id
                        WHERE a.user_name = ?",array($userName));
        
        //Log::Error($db);
        
        //ok
        if(Count($db) == 0)
        {
            $array = array(
                'status' => 2,
                'message' => 'Invalid member id'
            );
            
            return json_encode($array, true);
        }
        
        //ok
        if(!(is_null($db[0]->mega_login_id)))
        {
            $array2 = array(
                'status' => 1,
                'message' => 'Already create mega888 account for this member'
            );
            
            return json_encode($array2, true);
        }
        else
        {
            $curl = curl_init();
            $url = 'http://mgt3.36ozhushou.com/mega-cloud/api/';
            
            $sn = 'ld00';
            $nickname = $userName.'w';
            $agentLoginId = 'Mega1-1639';
            $random = rand();//$userName.'1234567890';
            $secretCode = '7fygKdIAIq3tAwDcqjB+0VtvxcE=';
            
            $array = array(
                'id' => $random,
                'method' => 'open.mega.user.create',
                'params' => array(
                    'random' => $random,
                    'digest' => md5($random.$sn.$secretCode),
                    'sn' => $sn,
                    'nickname' => $nickname,
                    'agentLoginId' => $agentLoginId
                ),
                'jsonrpc' => '2.0'
            );
            
            //Log::Error(json_encode($array, true));
            
            curl_setopt_array($curl, array(
                CURLOPT_URL => 'http://mpleti.tjzhmhs.com/mega-cloud/api/',
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS =>json_encode($array, true),
                CURLOPT_HTTPHEADER => array(
                    'Content-Type: application/json'
                ),
            ));
            
            $response = curl_exec($curl);
            
            //Log::Error("anjing");
            // Log::Error($response);
            
            curl_close($curl);
            
            $data = json_decode($response, true);
            
            //check if successfull =y created , then only update mega_login_id
            //else , throw error or something u moron!!
            $loginId = $data['result']['loginId'];
            
            //Log::Error($loginId);
            
            //update member
            DB::UPDATE("UPDATE users SET mega_login_id = ?, mega_password = ? WHERE user_name = ?",array($loginId, $userName.rand(111,999), $userName));
                
            return $response;
        }
    }
                
    public function fourdeebalance()
    {
        $userName = Auth::User()->user_name;
        
        $db2019 = DB::SELECT("SELECT fourdee_username , created_at FROM users WHERE user_name = ?",array($userName));
        
        if($db2019[0]->created_at > '2023-04-05 00:00:00')
        {
            $userName = $db2019[0]->fourdee_username;
        }
        
        $userId = Auth::User()->id;
        $apiUser = "r8gaming";
        $apiPass = "r8gaming@win2021";
        $user = "R8GAMING";
        $pass = "168168168";//"445577";
        $loginID = "91".$userName;
        
        $param = "apiUser=$apiUser&apiPass=$apiPass&user=$user&pass=$pass&loginID=$loginID";
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'http://api2.mb99.co/getProfile.aspx',
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
        
        //return $response;
        
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);
        
        //return $array;
        
        curl_close($curl);
        
        if($array['balance'] <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET fourdee_turnover = ? WHERE user_id = ?",array(0, $userId));
        }
        
        return $array['balance'];
    }
                
    public function create4dPlayer()
    {
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/fourDeeCreatePlayer";
        $companyId = env('COMPANY_ID', '1'); //test
        
        $data = array(
            'user_name' => Auth::User()->user_name,
        );
        
        $curl = curl_init();
        
        if ($curl === false)
        {
            throw new Exception('failed to initialize');
        }
        curl_setopt_array($curl, array(
            CURLOPT_URL => $url,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: XSRF-TOKEN=eyJpdiI6ImIwbXFzbXFJZXlcL0pva3hhRW53SlwvUT09IiwidmFsdWUiOiI5cFJQWktpa1BiNXhZTlBqWXpSMnR4M0pJWWRtYzViT2VqRXBqQkRnUzFNY3VaYTJEM2FobjZcL25lNlV1ajhFOCIsIm1hYyI6IjU1ZTM5OGFkNjFkN2YyMzM1YzAwYWE1Njk1YmYzOTdlOTc1NGQ5ZjdiZjRjYTBkN2E0OGI5NzlkMzU0MzJhYmQifQ%3D%3D; laravel_session=eyJpdiI6IjhXVG8rakU4ZmRLcXFudnc5UG1hSGc9PSIsInZhbHVlIjoiZUR0U29CMVNFc1pzXC9TS05qcTJhRkphbjhVYW1yMDdpYUwwQjNhMVZCSmRtYjNad2tLbVVWYzVtYldtQVBmTzciLCJtYWMiOiIxZWM4ZjhjN2E0N2RjNDI1MjY2N2NmYzAyODM0MWI5ZTg1NWQ3NDcyNjM0NDdiN2Q1ZGQ5NDJjMTY1NGExNzA5In0%3D'
            ),
        ));
        
        $response = curl_exec($curl);
        
        // Check the return value of curl_exec(), too
        if ($response === false)
        {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        
        curl_close($curl);
        
        return $response;
    }
                
}
