<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Helper;
use App\Http\Controllers\HelperFourdee;
use Mail;
use Auth;
use Hash;
use App\User;
use Redirect;

class AuthNewController extends Controller
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
    
    public function spinwheel()
    {
        return view('spinwheel');
    }
    
    public function mainwallet()
    {
        $userId = Auth::User()->id;
        
        $db = DB::SELECT("SELECT balance FROM users_wallets WHERE user_id = ?",array($userId));
        
        return number_format($db[0]->balance, 2);
    }
    
    public function gettokenbalance()
    {
        $userId = Auth::User()->id;
        
        $db = DB::SELECT("SELECT token FROM users_wallets WHERE user_id = ?",array($userId));
        
        return $db[0]->token;
    }

    public function pragmaticLobby()
    {
        return view('pragmaticLobby');
    }
    
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
                 //"GameAlias"=> $gameArr['GameAlias'],
                 //"Specials"=> $gameArr['Specials'],
                 //"SupportedPlatForms"=> $gameArr['SupportedPlatForms'],
                 "Image1"=> $gameArr['Image1']
             );

             array_push($array, $arr);
         }

         //get all the things here ??
         return view('jokerLobby')->with('gameLists', $array);
     }
     
    public function launch4D()
    {
        $username = Auth::User()->user_name;
                
        $db2019 = DB::SELECT("SELECT fourdee_username , created_at FROM users WHERE user_name = ?",array($username));
        
        if($db2019[0]->created_at > '2023-04-05 00:00:00')
        {
            $username = $db2019[0]->fourdee_username;
        }
        
        $response = HelperFourdee::login4D($username);

        return Redirect::to($response);
    }
    
    public static function launchM8()
    {
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/m8LaunchGame";
        $companyId = env('COMPANY_ID', '1');

        $data = array(
            'user_name' => Auth::User()->user_name,
            'company_id' => $companyId,
            'is_mobile' => 0
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
        
        return Redirect::to($response, 301);

        return view('m8sports')->with('url',$response);
    }
    
    public function launchAB()
    {
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/ABlaunchgame";
        $companyId = env('COMPANY_ID', '1');

        $data = array(
            'user_name' => Auth::User()->user_name,
            'company_id' => $companyId,
            'is_mobile' => 0
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
    
    public function launchPragmaticLiveCasino()
    {
         //this url will put in env file
         $url = "https://91win999.com/sites/gameApi/public/launchPPLiveCasino";
         $companyId = env('COMPANY_ID', '1');

         $data = array(
             'token' => Auth::User()->user_name,
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

        return Redirect::to($response);//redirect((string)$response);
     }

    public function launchPragmaticSlots($gameCode)
    {
         //this url will put in env file
         $url = "https://91win999.com/sites/gameApi/public/launchPragmaticGame";
         $companyId = env('COMPANY_ID', '1');

         $data = array(
             'token' => Auth::User()->user_name,
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

        //return $response;

        return Redirect::to($response);//redirect((string)$response);
     }
     
    public function ptslots()
    {
         //$this->playtechDeposit();

         $db = DB::SELECT("SELECT * FROM playtech_slots order by id desc");
         $userId = Auth::User()->id;

         //get playtech password from users table
         $db2 = DB::SELECT("SELECT * FROM users WHERE id = ?",array($userId));

         $array = array();
         foreach($db as $slots)
         {
             $arr = array(
                 'game_name' => $slots->game_name,
                 'game_code' => $slots->game_code,
                 'image_path' => $slots->image_path,
                 'user_name' => 'MFK'.strtoupper($db2[0]->user_name),
                 'password' => $db2[0]->playtech_password,
             );

             array_push($array, $arr);
         }

         return view('ptslots')->with('array', $array);
     }
     
    public function launchPTLive()
    {
         //transfer all main wallet to playtech
         //$this->playtechDeposit();

         $userId = Auth::User()->id;

         //get playtech password from users table
         $db2 = DB::SELECT("SELECT * FROM users WHERE id = ?",array($userId));

         $username = 'MFK'.strtoupper($db2[0]->user_name);
         $password = $db2[0]->playtech_password;

         return view('launchPTLive')->with('username', $username)->with('password', $password);
     }
     
    public function launchEVO()
    {
        // if(Auth::User()->id == 6749)
        // {
        //     return "This game is under maintenance";
        // }
        
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/evoLaunchGameTransfer";
        $companyId = env('COMPANY_ID', '1');

        $data = array(
            'user_name' => Auth::User()->user_name,
            'company_id' => $companyId,
            'is_mobile' => 0
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

        return Redirect::to($response);//redirect((string)$response);
    }
    
    public function launchJokerTransferGame($gameCode)
    {
        //transfer all main wallet to joker
        //$this->mainToJoker();
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

        return Redirect::to($response);
    }
}
