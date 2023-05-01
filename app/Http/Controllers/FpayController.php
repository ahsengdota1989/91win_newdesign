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
use App\Transaction;

class FpayController extends Controller
{
    // Username: 91win88G
    // Password: Qwer@1234
    // API key
    // tf0HsZEj4BoRKxHjQ5zE
    // Secret Key
    // CmgDxEZ4ujBhEbU
    
    private function auth()
    {
        $username = "91win88G"; //Merchant username
        $api_key = "tf0HsZEj4BoRKxHjQ5zE"; //Api key get from panel settings page
        $send = array('username' => $username , 'api_key' => $api_key);
        $apiurl = "https://liveapi.fpay.support/merchant/auth";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        return $response['auth'];

    }
    
    public function submitFpay(request $request)
    {
        $userId = Auth::User()->id;
        $username = Auth::User()->user_name; //Customer Username
        $auth = $this->auth(); //Get from auth api
        $amount = $request->amount; //Price amount
        $currency = "MYR"; //Currency code
        
        $email = "apiwebsite.working@gmail.com"; //Customer Email
        $phone_number = Auth::User()->phone_number; //Customer Phone number
        
        $url2 = url()->full();
        $url2 =  parse_url($url2, PHP_URL_HOST);
        $domains = explode('.', $url2);
        $agentCode =  $domains[count($domains)-2];
    
        $redirect_url = "https://91win88.com";
        // $redirect_url = "https://$domain"; //Optional. For those who need redirect to different URL only.
        $currDate = date("Y-m-d H:i:s");

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
        
        if($amount > 10000)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than RM10,000.00'
            );

            return json_encode($response);
        }
        
        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $amount,
            'type' => 1,
            'company_id' => 1,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "FPAY - Online Banking",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        $orderid = $transaction->id; //Merchant order ID 
        
        $send = array(
        	  'username' => $username, 
        	  'auth' => $auth, 
        	  'amount' => $amount, 
        	  'currency' => $currency, 
        	  'orderid' => $orderid,
        	  'email' => $email, 
        	  'phone_number' => $phone_number,
        	  'redirect_url' => $redirect_url
        	);
        	
        $apiurl = "https://liveapi.fpay.support/merchant/generate_orders";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        $purl = $response['p_url'];
        
        $ress = array(
            'status' => 0,
            'message' => 'You will be redirected to payment site.Please dont close your browser',
            'url' => $purl
        );
        
        return json_encode($ress, true);
        
        // return Redirect::to($purl, 301);
    }
    
    private function duitnowauth()
    {
        $username = "91win88D"; //Merchant username
        $api_key = "fJJizIZH5tBMkxuiLFri"; //Api key get from panel settings page
        $send = array('username' => $username , 'api_key' => $api_key);
        $apiurl = "https://liveapi.fpay.support/merchant/auth";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        return $response['auth'];

    }
    
    public function submitFpayDuitNow(request $request)
    {
        $userId = Auth::User()->id;
        $username = Auth::User()->user_name; //Customer Username
        $auth = $this->duitnowauth(); //Get from auth api
        $amount = $request->amount; //Price amount
        $currency = "MYR"; //Currency code
        
        $email = "apiwebsite.working@gmail.com"; //Customer Email
        $phone_number = Auth::User()->phone_number; //Customer Phone number
        
        $url2 = url()->full();
        $url2 =  parse_url($url2, PHP_URL_HOST);
        $domains = explode('.', $url2);
        $agentCode =  $domains[count($domains)-2];
    
        $redirect_url = "https://91win88.com";
        // $redirect_url = "https://$domain"; //Optional. For those who need redirect to different URL only.
        $currDate = date("Y-m-d H:i:s");

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
        
        if($amount > 10000)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than RM10,000.00'
            );

            return json_encode($response);
        }
        
        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $amount,
            'type' => 1,
            'company_id' => 1,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "FPAY - DuitNow",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        $orderid = $transaction->id; //Merchant order ID 
        
        $send = array(
        	  'username' => $username, 
        	  'auth' => $auth, 
        	  'amount' => $amount, 
        	  'currency' => $currency, 
        	  'orderid' => $orderid,
        	  'email' => $email, 
        	  'phone_number' => $phone_number,
        	  'redirect_url' => $redirect_url
        	);
        	
        $apiurl = "https://liveapi.fpay.support/merchant/generate_orders";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        $purl = $response['p_url'];
        
        $ress = array(
            'status' => 0,
            'message' => 'You will be redirected to payment site.Please dont close your browser',
            'url' => $purl
        );
        
        return json_encode($ress, true);
        
        // return Redirect::to($purl, 301);
    }
    
    private function ewalletauth()
    {
        $username = "91win88E"; //Merchant username
        $api_key = "7U8mOpBA0FOdXsb454UE"; //Api key get from panel settings page
        $send = array('username' => $username , 'api_key' => $api_key);
        $apiurl = "https://liveapi.fpay.support/merchant/auth";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        return $response['auth'];

    }
    
    public function submitFpayEwallet(request $request)
    {
        $userId = Auth::User()->id;
        $username = Auth::User()->user_name; //Customer Username
        $auth = $this->ewalletauth(); //Get from auth api
        $amount = $request->amount; //Price amount
        $currency = "MYR"; //Currency code
        
        $email = "apiwebsite.working@gmail.com"; //Customer Email
        $phone_number = Auth::User()->phone_number; //Customer Phone number
        
        $url2 = url()->full();
        $url2 =  parse_url($url2, PHP_URL_HOST);
        $domains = explode('.', $url2);
        $agentCode =  $domains[count($domains)-2];
    
        $redirect_url = "https://91win88.com";
        // $redirect_url = "https://$domain"; //Optional. For those who need redirect to different URL only.
        $currDate = date("Y-m-d H:i:s");

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
        
        if($amount > 10000)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than RM10,000.00'
            );

            return json_encode($response);
        }
        
        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $amount,
            'type' => 1,
            'company_id' => 1,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "FPAY - E Wallet",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        $orderid = $transaction->id; //Merchant order ID 
        
        $send = array(
        	  'username' => $username, 
        	  'auth' => $auth, 
        	  'amount' => $amount, 
        	  'currency' => $currency, 
        	  'orderid' => $orderid,
        	  'email' => $email, 
        	  'phone_number' => $phone_number,
        	  'redirect_url' => $redirect_url
        	);
        	
        $apiurl = "https://liveapi.fpay.support/merchant/generate_orders";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        $purl = $response['p_url'];
        
        $ress = array(
            'status' => 0,
            'message' => 'You will be redirected to payment site.Please dont close your browser',
            'url' => $purl
        );
        
        return json_encode($ress, true);
        
        // return Redirect::to($purl, 301);
    }
    
    private function usdtauth()
    {
        $username = "91win88U"; //Merchant username
        $api_key = "HSkYdh8OOO0YnOby6dW8"; //Api key get from panel settings page
        $send = array('username' => $username , 'api_key' => $api_key);
        $apiurl = "https://liveapi.fpay.support/merchant/auth";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        return $response['auth'];

    }
    
    public function submitFpayUSDT(request $request)
    {
        $userId = Auth::User()->id;
        $username = Auth::User()->user_name; //Customer Username
        $auth = $this->usdtauth(); //Get from auth api
        $amount = $request->amount; //Price amount
        $currency = "USDT"; //Currency code
        
        $email = "apiwebsite.working@gmail.com"; //Customer Email
        $phone_number = Auth::User()->phone_number; //Customer Phone number
        
        $url2 = url()->full();
        $url2 =  parse_url($url2, PHP_URL_HOST);
        $domains = explode('.', $url2);
        $agentCode =  $domains[count($domains)-2];
    
        $redirect_url = "https://91win88.com";
        // $redirect_url = "https://$domain"; //Optional. For those who need redirect to different URL only.
        $currDate = date("Y-m-d H:i:s");

        if($amount == '')
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Please fill all the required fields.'
            );

            return json_encode($response);
        }
        
        if($amount < 10)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Deposit amount cannot be less than USDT10.'
            );

            return json_encode($response);
        }
        
        if($amount > 5000)
        {
            //DB::Rollback();

            $response = array(
                'status'=> 1
                ,'message'=>'Amount cannot be more than USDT5000'
            );

            return json_encode($response);
        }
        
        //rate
        $rate = 4.1;
        $newamount = $amount * $rate;
        
        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $newamount,
            'usdt_amount' => $amount,
            'type' => 1,
            'company_id' => 1,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "FPAY - USDT",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        $orderid = $transaction->id; //Merchant order ID 
        
        $send = array(
        	  'username' => $username, 
        	  'auth' => $auth, 
        	  'amount' => $amount, 
        	  'currency' => $currency, 
        	  'orderid' => $orderid,
        	  'email' => $email, 
        	  'phone_number' => $phone_number,
        	  'redirect_url' => $redirect_url
        	);
        	
        $apiurl = "https://liveapi.fpay.support/merchant/generate_orders";
        
        $curl = curl_init($apiurl);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_TIMEOUT, 400); 
        curl_setopt($curl, CURLOPT_POSTFIELDS, $send);
        curl_setopt($curl, CURLOPT_HTTPHEADER, array("Content-Type: multipart/form-data"));
        
        $response = curl_exec($curl);
        curl_close($curl);
        
        $response = json_decode($response, true);
        
        // return $response;
        
        $purl = $response['p_url'];
        
        $ress = array(
            'status' => 0,
            'message' => 'You will be redirected to payment site.Please dont close your browser',
            'url' => $purl
        );
        
        return json_encode($ress, true);
        
        // return Redirect::to($purl, 301);
    }
}
