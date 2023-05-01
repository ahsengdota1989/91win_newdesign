<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Facades;
use Illuminate\Support\Facades\DB;

class WithdrawalController extends Controller
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

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //return view('deposit');
    }
    
        
    public function getIp()
    {
        foreach (array('HTTP_CLIENT_IP', 'HTTP_X_FORWARDED_FOR', 'HTTP_X_FORWARDED', 'HTTP_X_CLUSTER_CLIENT_IP', 'HTTP_FORWARDED_FOR', 'HTTP_FORWARDED', 'REMOTE_ADDR') as $key){
            if (array_key_exists($key, $_SERVER) === true){
                foreach (explode(',', $_SERVER[$key]) as $ip){
                    $ip = trim($ip); // just to be safe
                    if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE) !== false){
                        return $ip;
                    }
                }
            }
        }
        return request()->ip(); // it will return server ip when no client ip found
    }

    public function withdrawalProcess(Request $Request)
    {
        DB::BeginTransaction();
        try
        {
            $userId = Auth::User()->id;
            $withBank = $Request->with_bank;
            $withAmount = $Request->with_amount;
            $companyId = env('COMPANY_ID', '1');
            $currDate = date("Y-m-d H:i:s");
            
            // $ipAdd = $this->getIp();
            
            //check ip address 1st
            // $ip = DB::SELECT("SELECT ip FROM ip_whitelists WHERE ip = ?",array($ipAdd));
            
            // if(count($ip) > 0)
            // {
            //     $response = array(
            //         'status'=> 1
            //         ,'message'=> 'Your ip has been blocked. Please contact customer service for assistance. Thank you / 你的ip被封了。请联系客服寻求帮助。谢谢'
            //     );
    
            //     DB::Rollback();
        
            //     return json_encode($response);
            // }

            $balance = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            
            //check min_withdrawal
            if($withAmount < $balance[0]->reward_winover)
            {
                DB::Rollback();

                $response = array(
                    'status'=> 1
                    ,'message'=>'You have not meet the reward minimum withdrawal requirement'
                );

                return json_encode($response);
            }
            
            if($withBank == '')
            {
                DB::Rollback();

                $response = array(
                    'status'=> 1
                    ,'message'=>'Please create new bank.'
                );

                return json_encode($response);
            }

            if($withAmount == '')
            {
                DB::Rollback();

                $response = array(
                    'status'=> 1
                    ,'message'=>'Please fill all the required fields.'
                );

                return json_encode($response);
            }
            else if($withAmount < 99)
            {
                DB::Rollback();

                $response = array(
                    'status'=> 1
                    ,'message'=>'Withdraw amount must be more than RM100.00'
                );

                return json_encode($response);
            }
            else if($withAmount > 100000)
            {
                DB::Rollback();

                $response = array(
                    'status'=> 1
                    ,'message'=>'Withdrawal amount cannot be more than RM100K per transactions'
                );

                return json_encode($response);
            }
            else if($withAmount > $balance[0]->balance)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=>'Insufficient balance.'
                );

                DB::Rollback();

                return json_encode($response);
            }
            else
            {
                $valid = DB::SELECT("SELECT * FROM transactions WHERE type = ? AND status = ? AND user_id = ?",array(2,3,$userId));

                if(Count($valid) > 0)
                {
                    DB::Rollback();

                    $response = array(
                        'status'=> 1
                        ,'message'=>'Unable to process double withdrawal'
                    );

                    return json_encode($response);
                }
                
                $dateNow = date('Y-m-d 00:00:00');
                $dateThen = date('Y-m-d 23:59:59'); 
                
                //check in 1 day , can only withdraw 100k 
                $checkoneday = DB::SELECT("SELECT sum(amount) as total_with 
                                           FROM transactions WHERE type = ? AND status = ? AND user_id = ? 
                                           AND created_at BETWEEN ? AND ?",array(2,1,$userId, $dateNow, $dateThen));
                $totalWith = $withAmount + $checkoneday[0]->total_with;
                if($checkoneday[0]->total_with > 100000)
                {
                    DB::Rollback();

                    $response = array(
                        'status'=> 1
                        ,'message'=>'You have exceeded the amount allowed to withdraw per day. Please make the withdrawal tomorrow.Thank you'
                    );

                    return json_encode($response);
                }
                
                if($totalWith > 100000)
                {
                    DB::Rollback();

                    $response = array(
                        'status'=> 1
                        ,'message'=>'You have exceeded the amount allowed to withdraw per day. Please make the withdrawal tomorrow.Thank you'
                    );

                    return json_encode($response);
                }

                //check if turnover havent finish , cannot do withdrawal
                DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                     promotion_id, bank_id, remark, approved_by, created_at)
                     VALUES (?,?,?,?,?,?,?,?,?,?)",
                     array(
                         $userId
                         ,$withAmount
                         ,2
                         ,$companyId
                         ,3
                         ,0
                         ,0
                         ,"Withdrawal to ".$withBank
                         ,0
                         ,$currDate
                     ));

                 DB::UPDATE("UPDATE users_wallets SET balance = balance - ?, min_withdrawal = ? WHERE user_id = ?",array($withAmount, 0, $userId));

                 DB::Commit();

                 $response = array(
                     'status'=> 0
                     ,'message'=>'Withdrawal Success.'
                 );

                 return json_encode($response);
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Withdrawal failed!Please contact customer service for assistance!Thank you.'
            );

            return json_encode($response);
        }
    }

    public function addNewBank(request $request)
    {
        DB::BeginTransaction();

        try
        {
            $bankName = $request->bank_name;
            $accNo = $request->account_number;
            $userId = Auth::User()->id;
            $date = date('Y-m-d H:i:s');

            if($accNo == '')
            {
                DB::Rollback();

                $response = array(
                    'status'=> 1
                    ,'message'=> 'Please enter account number'
                );

                return json_encode($response);
            }

            DB::INSERT("INSERT INTO users_banks (user_id , bank_name, account_number, created_at)
                VALUES (?,?,?,?)",array($userId, $bankName, $accNo, $date));

            DB::Commit();

            $response = array(
                'status'=>0
                ,'message'=> 'Success'
            );

            return json_encode($response);
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Failed.Please contact our cs via live chat.'
            );

            return json_encode($response);
        }
    }
}
