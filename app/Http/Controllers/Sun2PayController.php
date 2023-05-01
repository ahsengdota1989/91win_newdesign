<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Facades;
use Illuminate\Support\Facades\DB;
use Validator;
use App\Transaction;

class Sun2PayController extends Controller
{
    private function launchJokerTransferGame2($gameCode)
    {
        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/jokerGetPlayGameUrl";
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

    private function playtechGetBalance()
    {
        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/playtech/getbalance";

        $data = array(
            'user_name' => Auth::User()->user_name,
        );

        $curl = curl_init();

        if ($curl === false)
        {
            return 0;
            //throw new Exception('failed to initialize');
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
            return 0;
           //throw new Exception(curl_error($curl), curl_errno($curl));
        }

        curl_close($curl);

        //echo $response->getAttribute( 'href' );

        $res = json_decode($response, true);

        $balance = $res['result']['balance'];

        return number_format($balance, 2);
        //return view('playtechLobby');
    }

    private function getJokerBalance()
    {
        $this->launchJokerTransferGame2('cuarr8e1ncebn');

        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/jokerGetUserCredit";

        $userName = Auth::User()->user_name;

        $data = array(
            'user_name' => $userName,
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

        return number_format($response, 2);
    }

    private function evoBalance()
    {
        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/evoGetBalance";

        $userId = Auth::User()->id;

        $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance FROM users as a
                          INNER JOIN users_wallets as b ON a.id = b.user_id
                          INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));

        $data = array(
            'user_name' => $db[0]->user_name,
            'company_id' => $db[0]->company_id,
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

        $xml = simplexml_load_string($response);

        $data = json_decode(json_encode($xml),true);

        return $data['tbalance'];
    }

    private function getMegaBalance()
    {
        //return 0;
        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/getBalanceMega888";

        $userId = Auth::User()->id;

        $db = DB::SELECT("SELECT mega_login_id FROM users WHERE id = ?",array($userId));

        $data = array(
            'mega_login_id' => $db[0]->mega_login_id,
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

        $data = json_decode($response, true);

        curl_close($curl);

        return $data['result'];
    }
    
        
    //***********************************
    //	4D STARTS
    //*********************************** 
     
    private function fourDeeWithdraw()
    {
        DB::BeginTransaction();
        
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/fourDeeWithdraw";

        $userId = Auth::User()->id;

        //get balance from users_wallets table
        $fourDeeBal = $this->fourDeebalance2();

        $data = array(
            'user_name' => Auth::User()->user_name,
            'amount' => $fourDeeBal
        );

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
          CURLOPT_POSTFIELDS => json_encode($data),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json',
            'Cookie: laravel_session=eyJpdiI6IktqeFRQYlFhQVRuSHF5SFNUak5ET2c9PSIsInZhbHVlIjoiWldsc2xZcFZydXpKVVVpTGxJTjFlMkM5cG1CbG10YUtZK1JEYWVaNm9FNUo0N0NMUyszSndMaWZcL25aMlZOUHYiLCJtYWMiOiIyZTU4MTkzYWZlNjAyNTFjODk4NGZlODVhNDc0MDNlMmJkNzA2N2MzNDg0MTI4YjA5NTc5ZmZhMzYzZTNkOWM3In0%3D'
          ),
        ));

        $response = curl_exec($curl);

        if ($response === false)
        {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }

        //check errorCode
        $xml = simplexml_load_string($response);
        $json = json_encode($xml);
        $array = json_decode($json,TRUE);

        if($array['errorCode'] == 0)
        {
            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($fourDeeBal, $userId));

            DB::Commit();

            return 1;
        }
        else
        {
            DB::Rollback();

            return 0;
        }

        curl_close($curl);
    }
    
    private function aggetbalance()
    {
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
        
        return $res2['balance'];
    }
    
    private function pussybalance()
    {
        $userId = Auth::User()->id;

        $agent = 'psyapi91w';
        $dd = 'my'.$userId;
        $authCode = "gXSJqWgYfEpuEmbcfwBA";
        $secretkey = "a543dfh2649tn793V6hQ";
        $time = time()*1000;
        $sign = strtolower($authCode.$dd.$time.$secretkey); //what is wrong with this part ???
        $sign2 = strtoupper(md5($sign));

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
            return 0;
        }
        
        curl_close($curl);
        
        if($response == '')
        {
            return 0;
        }
        else
        {
            $res = json_decode($response, true);

            return $res['results'][0]['MoneyNum'];
        }
    }
    
    private function fourDeebalance2()
    {
        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/fourDeeGetProfile";

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
            return 0;
            //throw new Exception(curl_error($curl), curl_errno($curl));
        }

        curl_close($curl);

        return $response;
    }
    
    private function create4dPlayer()
    {
        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/fourDeeCreatePlayer";
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
    
    //***********************************
    //	4D ENDS
    //*********************************** 
    
    //***********************************
    //	SEXY STARTS
    //*********************************** 
    
    private function sexywithdraw()
    {
        $cert = 'Hu1lPAqC6XG3wFsuXIb';
        $agentId = 'sb91win88';
        $userId = Auth::User()->id;
        
        $sexybal = $this->sexygetbalance();
        
        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = $db[0]->user_name;
        $resetPass = mt_rand(100000,999999);
        $amount = $sexybal;
        
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.onlinegames22.com/wallet/withdraw",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "cert=$cert&agentId=$agentId&userId=$userName&txCode=$resetPass&withdrawType=1&transferAmount=$amount",
          CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded"
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        $res2 = json_decode($response, true);
        
        if($res2['status'] == '0000')
        {
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($sexybal, $userId));
            
            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    private function nineoneeightbalance()
    {
        //return 0;
        $userId = Auth::User()->id;

        //get mega password
        $db = DB::SELECT("SELECT phone_number, name, mega_password FROM users WHERE id = ?",array($userId));

        $agent = '918api91w';
        $dd = $db[0]->phone_number.$userId;
        $authCode = "JnGdRVxYNkPHHqXbjQfr";
        $secretkey = "G2h5274675C7hNU57x6J";
        $time = time()*1000;
        $sign = strtolower($authCode.$dd.$time.$secretkey); //what is wrong with this part ???
        $sign2 = strtoupper(md5($sign));

        $url = "http://api.918kiss.com:9991/ashx/account/account.ashx?";
        $param = "action=getSearchUserInfo&userName=$dd&time=$time&authcode=$authCode&sign=$sign2";
        
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
            return 0;
        }
        
        curl_close($curl);
        
        if($response == '')
        {
            return 0;
        }
        else
        {
                    
            $res = json_decode($response, true);
    
            return $res['results'][0]['MoneyNum'];
        }
    }
    
    private function sexygetbalance()
    {
        //create member 1st 
        $this->sexycreateMember();
        
        $cert = 'Hu1lPAqC6XG3wFsuXIb';
        $agentId = 'sb91win88';
        $userId = Auth::User()->id;
        $isMobile = false;
        $platform = 'SEXYBCRT';
        $gameType = 'LIVE';
        $gameCode = '';
        
        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = $db[0]->user_name;
        
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.onlinegames22.com/wallet/getBalance",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "cert=$cert&agentId=$agentId&userIds=$userName&isFilterBalance=0&alluser=0",
          CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded"
          ],
        ]);
        
        $response = curl_exec($curl);
        
        $err = curl_error($curl);
        
        curl_close($curl);

        
        $res2 = json_decode($response, true);
        
        //return $res2['results'];
        
        return $res2['results'][0]['balance'];
    }
    
    private function sexycreateMember()
    {
        $cert = 'Hu1lPAqC6XG3wFsuXIb';
        $agentId = 'sb91win88';
        $userId = Auth::User()->id;
        $betLimit = urlencode('{"SEXYBCRT":{"LIVE":{"limitId":[140101,140102,140103,140104]}}}');
        
        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = $db[0]->user_name;
        
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.onlinegames22.com/wallet/createMember",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "cert=$cert&agentId=$agentId&userId=$userName&currency=MYR&betLimit=$betLimit&language=en&userName=$userName",
          CURLOPT_HTTPHEADER => [
            "content-type: application/x-www-form-urlencoded"
          ],
        ]);
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        $res2 = json_decode($response, true);
        
        return $res2['status'];
    }
    
    //***********************************
    //	SEXY ENDS
    //*********************************** 

    public function deposit(request $request)
    {
        $bankId = 5;
        $amount = $request->amount;
        $promo = $request->promo;
        $userId = Auth::User()->id;
        $companyId = env('COMPANY_ID', '1');
        $currDate = date("Y-m-d H:i:s");
        $depositDevice = 2; //1 == desktop , 2 = mobile

        if($amount == '')
        {
            $response = array(
                'status'=> 1
                ,'message'=>'Please fill all the required fields.'
            );

            return json_encode($response);
        }
        
        if($amount < 30)
        {
            $response = array(
                'status'=> 1
                ,'message'=>'Deposit amount cannot be less than RM30.'
            );

            return json_encode($response);
        }
        
        if($amount > 5000)
        {
            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than RM5,000.00'
            );

            return json_encode($response);
        }

        //check if still got existing deposit havent approve, cannot make another deposit
        //if still got balance more than rm10 , cannot make deposit
        //if turnover havent finish , cannot deposit
        $valid = DB::SELECT("SELECT * FROM transactions WHERE type = ? AND status = ? AND user_id = ?",array(1,3,$userId));
        // $wallet = DB::SELECT("SELECT balance, turnover_balance,is_promotion
        //                       FROM users_wallets WHERE user_id = ?",array($userId));

        // if(Count($valid) > 0)
        // {
        //     $response = array(
        //         'status'=> 1
        //         ,'message'=>'Unable to process double deposit, please check your transaction history'
        //     );

        //     return json_encode($response);
        // }
        
        $response = array(
            'status'=> 0
            ,'message'=>'Success'
        );

        return json_encode($response);
    }

    private function generatePaymentOrder($amount, $transactionId, $bankId)
    {
        //this url will put in env file
        $url = "http://103.6.198.129/~mycom/sites/gameApi/public/payment/generatePaymentOrderNew";

        $data = array(
            'amount' => $amount,
            'transaction_id' => $transactionId,
            'bank_id' => $bankId
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
