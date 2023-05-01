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

class AllbetController extends Controller
{
    // Product: Allbet
    // Brand: 91win
    // Wallet: Transfer Wallet
    // **Production Account**
    // 
    // BO: https://ams.allbetgaming.net/
    // Username: 91winyh
    // PW: qwer1234

    // AMS Website	https://ams.allbetgaming.net
    // AMS UserName	91winyh
    // API URL	"https://mw2.absvc.net
    // backup domain:
    // https://mw2-1.absvc.net
    // https://mw2-2.absvc.net
    // https://mw2-3.absvc.net
    // https://mw2-4.absvc.net
    // https://mw2-5.absvc.net"
    // OperatorID	9399976
    // API Key	/p3Eq6Uk5muwbiS7x96jGgVnhGUGI2tKMW1U1HMmj6jymTmIQFWuE8m/k76PncoohDfBqiYNfZuiiFCk7cKJrw==
    // Whitelist IP (API)	162.240.217.211,162.240.218.16
    // Player Account Suffix	3ia

    public function CheckOrCreate()
    {
        $username = "cekmek"; //test
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
        
        return $response;
    }

    public function login()
    {
        $username = Auth::User()->user_name;
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/Login"; //api interface @ which function to be called 
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
        
        return Redirect::to($res['data']['gameLoginUrl']);
    }

    public function deposit()
    {
        $username = "cekmek"; //test
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/Transfer"; //api interface @ which function to be called 
        $client = $username.'_'.$companyId;
        $contentType = "application/json";
        $httpMethod = "POST";
        $accSuffix = "3ia";
        $amount = "10.00";
        
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
            'sn' => $rand,
            'agent' => $agent,
            'type' => 1,
            'player' => $client.$accSuffix,
            'amount' => $amount
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
        
        return $res;
    }

    public function withdraw()
    {
        $username = "cekmek"; //test
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/Transfer"; //api interface @ which function to be called 
        $client = $username.'_'.$companyId;
        $contentType = "application/json";
        $httpMethod = "POST";
        $accSuffix = "3ia";
        $amount = "10.00";
        
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
            'sn' => $rand,
            'agent' => $agent,
            'type' => 0,
            'player' => $client.$accSuffix,
            'amount' => $amount
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
        
        return $res['data']['gameLoginUrl'];
    }

    public function getbalance()
    {
        $username = "cekmek"; //test
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/GetBalances"; //api interface @ which function to be called 
        $client = $username.'_'.$companyId;
        $contentType = "application/json";
        $httpMethod = "POST";
        $accSuffix = "3ia";
        $amount = "10.00";
        
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
            'pageSize' => 1,
            'pageIndex' => 1,
            'recursion' => 1,
            'player' => array($client.$accSuffix)
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

        return number_format($res['data']['list'][0]['amount']);

    }
    
}
