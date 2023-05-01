<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Facades;
use Illuminate\Support\Facades\DB;
use Redirect;
use Exception;
use Log;

class GamesController extends Controller
{
    public function fishing()
    {
        //check if it is mobile
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        
        if ($iphone || $android || $palmpre || $ipod || $berry == true)
        {
            $url = "https://m.91win88.com";
            return redirect::to($url);
        }
        
        $title = "Play Online Fishing Malaysia | Free 168% Bonus - 91Win";
        $descriptions = "Play Online Fishing Slot Game and Win Real Money! SA Fishing, SG Fishing, SG Fishing War, GG Fishing &amp; PT Fishing are waiting for you!!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('fishing')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function livecasino()
    {
        //check if it is mobile
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        
        if ($iphone || $android || $palmpre || $ipod || $berry == true)
        {
            $url = "https://m.91win88.com";
            return redirect::to($url);
        }
        
        $title = "Trusted Online Live Casino Malaysia | Best Online Casino with 168% Welcome Bonus - 91Win";
        $descriptions = " Play trusted live casino malaysia at 91Win. Get connected to Evolution Casino, Sexy Baccarat, Allbet Casino, Playtech Live Casino, Pragmatic online in Malaysia.";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('livecasino')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }  
    
    public function slots()
    {
        //check if it is mobile
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        
        if ($iphone || $android || $palmpre || $ipod || $berry == true)
        {
            $url = "https://m.91win88.com";
            return redirect::to($url);
        }
        
        $title = "Trusted Online Slots Games in Malaysia | Slot Machine Providers Online  - 91Win";
        $descriptions = "Best & Trusted Online Slots Games in Malaysia. Top Malaysia online slot games like Joker Slots, Pragmatic Slots, Playtech Slots, etc.";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('slots')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function sports()
    {
        //check if it is mobile
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");
        
        if ($iphone || $android || $palmpre || $ipod || $berry == true)
        {
            $url = "https://m.91win88.com";
            return redirect::to($url);
        }
        
        $title = "Enjoy Sports Betting and Sportsbook Online in Malaysia with 10% Daily Sports Bonus- 91Win";
        $descriptions = "91win88 offers Online Sportsbook betting in Malaysia. Experience Live Betting, Sports Betting, Poker online.";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('sports')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function esports()
    {
        return view('esports');
    }

    public function playtechGetBalance()
    {
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/playtech/getbalance";
        
        $data = array(
            'user_name' => Auth::User()->user_name,
        );
        
        $curl = curl_init();
        
        if ($curl === false)
        {
            return "Maintenance";
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
        
        $arrr = array(
            'messageeee' => $response
        );
        
        Log::Error($arrr);

        if ($response === false)
        {
            return "Maintenance";
        }
        
        if($response == "")
        {
            return "Maintenance";
        }
        
        curl_close($curl);
        
        //echo $response->getAttribute( 'href' );
        
        $res = json_decode($response, true);

        $balance = $res['result']['balance'];
        
        return number_format($balance, 2);
        //return view('playtechLobby');
    }
    
    public function playtechLobby(request $request)
    {
        //1 = live casino , 2 = slots
        $type =  $request->type;
        $gameCode = $request->game_code;
        $username = Auth::User()->user_name;
        $prefix = 'MFK';
        $lang = 'en';
        $client = $request->client;
        $mode = 'offline'; //real
        
        if($type == 1)
        {
            //live casino process here
            
            //redirect to something here
            return view('playtechLobby');
        }
        else
        {
            //slots process here
            
            //redirect to something here
            return view('playtechLobby');
        }
    }
    
    public function launchJoker($gameCode)
    {
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/openGameURL";
        $companyId = env('COMPANY_ID', '1');
        
        $data = array(
            'token' => Auth::User()->user_name.'@'.$companyId,
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
        
        // Check the return value of curl_exec(), too
        if ($response === false)
        {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        
        curl_close($curl);
        //var_dump($response);exit;
        
        return Redirect::to($response);//redirect((string)$response);
    }
    
    public function mega888()
    {
        $userId = Auth::User()->id;
        
        $db = DB::SELECT("SELECT a.user_name, a.mega_login_id, a.mega_password, b.balance FROM users as a
            INNER JOIN users_wallets as b ON a.id = b.user_id WHERE a.id = ?",array($userId));
            
            //check if maintenance or error page , then return something
            return view('mega888')->with('balance', number_format($db[0]->balance, 2))
                                  ->with('mega_login_id', $db[0]->mega_login_id)
                                  ->with('mega_password', $db[0]->mega_password);
    }
            
    public function launchSEXY()
    {
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/sexyLaunchGame";
        $companyId = env('COMPANY_ID', '1');
        
        $data = array(
            'user_name' => Auth::User()->user_name,
            'company_id' => $companyId,
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
        
        // Check the return value of curl_exec(), too
        if ($response === false)
        {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        
        curl_close($curl);
        //var_dump($response);exit;
        
        //return $response;
        
        return Redirect::to($response);//redirect((string)$response);
    }
            
    public function sgLobby()
    {
        return view('sgLobby');
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
            
    //***********************************
    //	Joker Transfer Wallet
    //***********************************
            
    private function getJokerTransferGamesLists()
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://91win999.com/sites/gameApi/public/jokerGetListGame',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: laravel_session=eyJpdiI6IkRublRjd29SUko4S0pPcmdzVVg3cmc9PSIsInZhbHVlIjoiamcwSDZ5SjYrUlQ5QmhNZ1wvaWwybkdxa3RJSERwRmhmK09KblFOZnhnSU1QcmZhQmJcLzJjcXo0b3c0MDNCMHY2IiwibWFjIjoiYWZjODM3OWEwMDEyNDUyMjY2ZDBiNWZjYjE5ODU5Nzk5OGM1OTIxNmY1ZTc0ZjkyM2Y0MGM1OGI1OTk2NzVjYyJ9'
            ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $games = json_decode($response, true);
        
        $gameLists = $games['ListGames'];
        
        return $gameLists;
        
        $gameLists2 = json_encode($gameLists, true);
    }
            
    public function jokerLobby()
    {
        //transfer all main wallet to joker
        //$this->mainToJoker();
        $gameLists = $this->getJokerTransferGamesLists();
        
        $array = array();
        foreach($gameLists as $gameArr)
        {
            $arr = array(
                "GameType" => $gameArr['GameType'],
                "GameCode"=> $gameArr['GameCode'],
                "GameName"=> $gameArr['GameName'],
                "Image1"=> $gameArr['Image1']
            );
            
            array_push($array, $arr);
        }
        
        //get all the things here ??
        return view('jokerLobby')->with('gameLists', $array);
    }
}
