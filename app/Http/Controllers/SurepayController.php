<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Helper;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use App\Transaction;
use Auth;
use Facades;

class SurepayController extends Controller
{
    public function testsurepay(request $request)
    {
        //DB::BeginTransaction();

        $bankId = 5;
        $amount = $request->amount;
        $userId = Auth::User()->id;
        $companyId = env('COMPANY_ID', '1');
        $currDate = date("Y-m-d H:i:s");
        $depositDevice = 2;

        if($amount == '')
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Please fill all the required fields.'
            );

            return json_encode($response);
        }
        
        if($amount < 30)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Deposit amount cannot be less than RM30.'
            );

            return json_encode($response);
        }
        
        if($amount > 5000)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than RM5,000.00'
            );

            return json_encode($response);
        }

        //check if still got existing deposit havent approve, cannot make another deposit
        //if still got balance more than rm10 , cannot make deposit
        //if turnover havent finish , cannot deposit
        // $valid = DB::SELECT("SELECT * FROM transactions WHERE type = ? AND status = ? AND user_id = ?",array(1,3,$userId));
        $wallet = DB::SELECT("SELECT balance, turnover_balance,is_promotion
                               FROM users_wallets WHERE user_id = ?",array($userId));

        // if(Count($valid) > 0)
        // {
        //     //DB::Rollback();

        //     $response = array(
        //         'status'=> 1
        //         ,'message'=>'Unable to process double deposit, please check your transaction history'
        //     );

        //     return json_encode($response);
        // }

        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $amount,
            'type' => 1,
            'company_id' => $companyId,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "Surepay - Online Banking",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        //return $transaction;

        //api url
        // pgw3.surepay88.com/fundtransfer
        // my.surepay.live/fundtransfer
        $merchant = "SPRMRR2006";
        //$amount = '1.00';
        $customer = Auth::User()->user_name;
        $apikey = "bbc7b676f36e47461c4ae215b108ed95";
        $currency = "MYR";
        $ip = "192.168.1.1";
        $refId = $transaction->id;
        $token = md5($merchant.$amount.$refId.$customer.$apikey.$currency.$ip);

        return view('testsurepay')->with('refId', $refId)->with('token', $token)->with('customer', $customer)->with('amount', $amount);
    }
    
    public function tng(request $request)
    {
        //DB::BeginTransaction();

        $bankCode = $request->surepay_bank_selected;//5;
        $amount = $request->amount;
        $userId = Auth::User()->id;
        $companyId = env('COMPANY_ID', '1');
        $currDate = date("Y-m-d H:i:s");
        $depositDevice = 2;

        if($amount == '')
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Please fill all the required fields.'
            );

            return json_encode($response);
        }
        
        if($amount < 30)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Deposit amount cannot be less than RM30.'
            );

            return json_encode($response);
        }
        
        if($amount > 5000)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than RM5,000.00'
            );

            return json_encode($response);
        }

        //check if still got existing deposit havent approve, cannot make another deposit
        //if still got balance more than rm10 , cannot make deposit
        //if turnover havent finish , cannot deposit
        // $valid = DB::SELECT("SELECT * FROM transactions WHERE type = ? AND status = ? AND user_id = ?",array(1,3,$userId));
        $wallet = DB::SELECT("SELECT balance, turnover_balance,is_promotion
                               FROM users_wallets WHERE user_id = ?",array($userId));

        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $amount,
            'type' => 1,
            'company_id' => $companyId,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "Surepay - TNG",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        //return $transaction;

        //api url
        // pgw3.surepay88.com/fundtransfer
        // my.surepay.live/fundtransfer
        $merchant = "SPRMRR2006";
        //$amount = '1.00';
        $customer = Auth::User()->user_name;
        $apikey = "bc24fe67638d058ddb3ca83bc6db2b81";
        $currency = "MYR";
        $ip = "192.168.1.1";
        $refId = $transaction->id;
        $token = md5($merchant.$amount.$refId.$customer.$apikey.$currency.$ip);
        $url = url()->full();

        return view('tng')->with('refId', $refId)->with('token', $token)->with('customer', $customer)
                          ->with('amount', $amount)->with('bankCode', $bankCode)->with('url', $url);
    }
    
    public function duitnow(request $request)
    {
        $bankCode = $request->surepay_bank_selected;//5;
        $amount = $request->amount;
        $userId = Auth::User()->id;
        $companyId = env('COMPANY_ID', '1');
        $currDate = date("Y-m-d H:i:s");
        $depositDevice = 2;

        if($amount == '')
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Please fill all the required fields.'
            );

            return json_encode($response);
        }
        
        if($amount < 30)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Deposit amount cannot be less than RM30.'
            );

            return json_encode($response);
        }
        
        if($amount > 5000)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than RM5,000.00'
            );

            return json_encode($response);
        }

        //check if still got existing deposit havent approve, cannot make another deposit
        //if still got balance more than rm10 , cannot make deposit
        //if turnover havent finish , cannot deposit
        // $valid = DB::SELECT("SELECT * FROM transactions WHERE type = ? AND status = ? AND user_id = ?",array(1,3,$userId));
        $wallet = DB::SELECT("SELECT balance, turnover_balance,is_promotion
                               FROM users_wallets WHERE user_id = ?",array($userId));

        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $amount,
            'type' => 1,
            'company_id' => $companyId,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "Surepay - DuitNow",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        //return $transaction;

        //api url
        // pgw3.surepay88.com/fundtransfer
        // my.surepay.live/fundtransfer
        $merchant = "SPRMRR2006";
        //$amount = '1.00';
        $customer = Auth::User()->user_name;
        $apikey = "bc24fe67638d058ddb3ca83bc6db2b81";
        $currency = "MYR";
        $ip = "192.168.1.1";
        $refId = $transaction->id;
        $token = md5($merchant.$amount.$refId.$customer.$apikey.$currency.$ip);
        $url = url()->full();

        return view('duitnow')->with('refId', $refId)->with('token', $token)->with('customer', $customer)
                          ->with('amount', $amount)->with('bankCode', $bankCode)->with('url', $url);
    }
    
    public function tng_test(request $request)
    {
        // $amount = $request->amount;
        // //api url
        // // pgw3.surepay88.com/fundtransfer
        // // my.surepay.live/fundtransfer
        // $merchant = "w991w";
        // $customer = "seveneleven";
        // $apikey = "c95a85c0de5cc555bd1731901a26e402026dc50b";
        // $currency = "MYR";
        // $ip = "192.168.1.1";
        // $refId = rand(100,999999999999999);
        // $token = md5($merchant.$amount.$refId.$customer.$apikey.$currency.$ip);

        // return view('tng_test')->with('refId', $refId)->with('token', $token)->with('customer', $customer);
    }
}
