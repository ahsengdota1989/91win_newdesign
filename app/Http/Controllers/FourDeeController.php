<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\HelperFourdee;
use Mail;
use Auth;
use Hash;
use App\User;
use Redirect;

class FourDeeController extends Controller
{
    public function create4DAccount()
    {
        $username = Auth::User()->user_name;
        
        HelperFourdee::fourDeeCreatePlayer($username);
    }
    
    public function fourdee()
    {
        // header('Access-Control-Allow-Origin: *');
        // header('Access-Control-Allow-Methods: GET, POST, PUT, DELETE, OPTIONS');
        // header('Access-Control-Allow-Headers: Content-Type, X-Auth-Token, Origin, Authorization');
        // header('Access-Control-Allow-Credentials: true');
        
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
        $title = "Live 4D Betting Online in Malaysia | Buy 4D Tickets Online - 91win88";
        $descriptions = "Live Online 4D Betting and Buy 4D Online with 91win88 for Toto, Magnum , Damacai and many more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        $response = HelperFourdee::getFourDeeResult();
        $drawResults = $response['drawResult'];
        
        //4d ONLY
        $resArray = array();
        foreach($drawResults as $key => $drawResult)
        {
            if(count($drawResult) < 10)
            {
                //  
            }
            else
            {
                $drawName = '';
                $logo = '';
                $color = '';
                if($drawResult['drawType'] == 1)
                {
                    $drawName = 'Magnum';
                    $logo = 'magnum.png';
                    $color = '#b8860b';
                }
                
                if($drawResult['drawType'] == 2)
                {
                    $drawName = 'Damacai';
                    $logo = 'damacai.png';
                    $color = '#231f54';
                }
                
                if($drawResult['drawType'] == 3)
                {
                    $drawName = 'Toto';
                    $logo = 'toto.png';
                    $color = '#ec1c24';
                }
                
                if($drawResult['drawType'] == 4)
                {
                    $drawName = 'Singapore';
                    $logo = 'singapore.png';
                    $color = '#2c80fd';
                }
                
                if($drawResult['drawType'] == 5)
                {
                    $drawName = '88';
                    $logo = '88.png';
                    $color = '#2c80fd';
                }
                
                if($drawResult['drawType'] == 6)
                {
                    $drawName = 'Sabah';
                    $logo = 'stc.png';
                    $color = '#fdb913';
                }
                
                if($drawResult['drawType'] == 7)
                {
                    $drawName = 'Sarawak';
                    $logo = 'cash.png';
                    $color = '#ff5400';
                }
                
                if($drawResult['drawType'] == 8)
                {
                    $drawName = 'GDLotto';
                    $logo = 'gdlotto.png';
                    $color = '#ec1c24';
                }
                
                if($drawResult['drawType'] == 9)
                {
                    $drawName = '9 Lotto';
                    $logo = '9lotto.png';
                    $color = '#b8860b';
                }

                
               //return $drawResult['drawType'];
                $arr = array(
                    'name' => $drawName,
                    'logo' => $logo,
                    'color' => $color,
                    'drawType' => $drawResult['drawType'],
                    'drawDate' => $drawResult['drawDate'],
                    'drawNumber1' => $drawResult['drawNumber1'], 
                    'drawNumber2' => $drawResult['drawNumber2'], 
                    'drawNumber3' => $drawResult['drawNumber3'], 
                    'drawNumberS1' => $drawResult['drawNumberS1'], 
                    'drawNumberS2' => $drawResult['drawNumberS2'], 
                    'drawNumberS3' => $drawResult['drawNumberS3'], 
                    'drawNumberS4' => $drawResult['drawNumberS4'], 
                    'drawNumberS5' => $drawResult['drawNumberS5'], 
                    'drawNumberS6' => $drawResult['drawNumberS6'], 
                    'drawNumberS7' => $drawResult['drawNumberS7'], 
                    'drawNumberS8' => $drawResult['drawNumberS8'], 
                    'drawNumberS9' => $drawResult['drawNumberS9'], 
                    'drawNumberS10' => $drawResult['drawNumberS10'], 
                    'drawNumberC1' => $drawResult['drawNumberC1'], 
                    'drawNumberC2' => $drawResult['drawNumberC2'], 
                    'drawNumberC3' => $drawResult['drawNumberC3'], 
                    'drawNumberC4' => $drawResult['drawNumberC4'], 
                    'drawNumberC5' => $drawResult['drawNumberC5'], 
                    'drawNumberC6' => $drawResult['drawNumberC6'], 
                    'drawNumberC7' => $drawResult['drawNumberC7'], 
                    'drawNumberC8' => $drawResult['drawNumberC8'], 
                    'drawNumberC9' => $drawResult['drawNumberC9'], 
                    'drawNumberC10' => $drawResult['drawNumberC10'], 
                ); 
                
                array_push($resArray, $arr); 
            }
        }
        
        //return "4D is on maintenance";
        $username = Auth::User()->user_name;
                
        $db2019 = DB::SELECT("SELECT fourdee_username , created_at FROM users WHERE user_name = ?",array($username));
        
        if($db2019[0]->created_at > '2023-04-05 00:00:00')
        {
            $username = $db2019[0]->fourdee_username;
        }
        
        $responseLogin = HelperFourdee::login4D($username);

        // return Redirect::to($response, 301);
        
        return view('fourdee')->with('resArray', $resArray)->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords)->with('responseLogin', $responseLogin);
     }
     
     public function createAccount()
     {
        DB::BeginTransaction();
        try
        {

            $random2 = mt_rand(1,9999);
            $userName = "four".$random2;
            
            $db2 = DB::SELECT("SELECT user_name FROM usernames WHERE user_name = ?",array($userName)); 
            
            if(Count($db2) == 1)
            {
                $random3 = mt_rand(1,9999);
                $userName = "four".$random3;
            }
            
            //create id in eg 4D
            
            $create = helperFourdee::fourDeeCreatePlayer($userName);
            
            $xml = simplexml_load_string($create);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
            
            if($array['errorCode'] == 0)
            {
                //insert into usernames table
                DB::INSERT("INSERT INTO usernames(user_name, status) VALUES (?,?)",array($userName, 0));
                
                DB::Commit();
                
                return $create;
            }
            
            return "Failed";
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            
            return $ex;
        }
     }
}
