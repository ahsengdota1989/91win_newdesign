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

class SexyController extends Controller
{
    // Product : Sexy Baccarat
    // ——————————————————
    // ====*Staging Agent*====
    
    // 后台登入 : https://testag.onlinegames22.com
    // AgentID : demoall
    // Password : Asdf1234
    // Cert : fZk2GvmHu2p9JmyA3Lo
    // 测试环境 API URL : https://tttint.onlinegames22.com
    
    
    // BO URL :  https://ag.onlinegames22.com/
    // User ID : sb91win88
    // Password : Asdf1234
    // Perfix : 91W
    // Cert : Hu1lPAqC6XG3wFsuXIb
    // Wallet : Transfer
    // Currency : MYR
    // IP Whitelist: 103.6.198.129
    
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
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
    
    public function doLoginAndLaunchGame()
    {
        $create = $this->sexycreateMember();
        
        //return $create;
        
        if($create == '0000' || $create == '1001')
        {
            //$this->deposit();
            
            //transfer all amount from main wallet to this game
            //$$db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            $cert = 'Hu1lPAqC6XG3wFsuXIb';
            $agentId = 'sb91win88';
            $userId = Auth::User()->id;
            $isMobile = false;
            $platform = 'SEXYBCRT';
            $gameType = 'LIVE';
            $gameCode = 'MX-LIVE-002';
            $betLimit = urlencode('{"SEXYBCRT":{"LIVE":{"limitId":[140101,140102,140103,140104]}}}');
            
            //get from users table
            $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
            $userName = $db[0]->user_name;
            
            $curl = curl_init();
    
            curl_setopt_array($curl, [
              CURLOPT_URL => "https://api.onlinegames22.com/wallet/doLoginAndLaunchGame",
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "cert=$cert&agentId=$agentId&userId=$userName&gameCode=$gameCode&gameType=$gameType&platform=$platform&isMobileLogin=$isMobile&externalURL=https%253A%252F%252Fwww.google.com.tw%252F&language=en&hall=SEXY&betLimit=$betLimit",
              CURLOPT_HTTPHEADER => [
                "content-type: application/x-www-form-urlencoded"
              ],
            ]);
            
            $response = curl_exec($curl);
            
            //return $response;
            $err = curl_error($curl);
            
            curl_close($curl);
            
            $res2 = json_decode($response, true);
            
            //return $res2;
            
            return Redirect::to($res2['url']);
        }
    }
    
    public function getBalance()
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
        
        //return $res2;
        
        //return $res2['results'];
        
        return number_format($res2['results'][0]['balance'], 2);
    }
    
    public function withdraw()
    {
        $cert = 'Hu1lPAqC6XG3wFsuXIb';
        $agentId = 'sb91win88';
        $userId = Auth::User()->id;
        
        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = $db[0]->user_name;
        $resetPass = mt_rand(100000,999999);
        $amount = '10';
        
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://tttint.onlinegames22.com/wallet/withdraw",
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
        
        return $response;
    }
    
    private function deposit()
    {
        $cert = 'Hu1lPAqC6XG3wFsuXIb';
        $agentId = 'sb91win88';
        $userId = Auth::User()->id;
        
        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = $db[0]->user_name;
        $resetPass = mt_rand(100000,999999);
        //$amount = '10';
        
        $curl = curl_init();

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.onlinegames22.com/wallet/deposit",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "cert=$cert&agentId=$agentId&userId=$userName&transferAmount=$mainWalletBal&txCode=$resetPass",
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
            DB::UPDATE("UPDATE users_wallets SET balance = ? WHERE user_id = ?",array(0, $userId));
        }
    }
    
}
