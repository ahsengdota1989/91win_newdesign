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

class TelcoController extends Controller
{
    public function telcoDeposit(request $request)
    {
        $curl = curl_init();
        
        $apiUrl = "https://api.telcopay.asia/api/Payment/Deposit";
        
        $telcoProvider = $request->provider;
        $pinNumber = $request->pin_number;
        $amount = $request->amount;
        $apiCode = "NhocJtP0dECZYsNHqjDdqA";
        $gatewayType = 1;
        $userName = Auth::User()->user_name;
        $userId = Auth::User()->id;
        $currDate = date("Y-m-d H:i:s");
        $amount2 = 0;
        
        if($amount < 5)
        {
            $arrr = array(
                'Code' => 1,
                'Message' => 'Amount must be more than RM5'
            );
            
            return json_encode($arrr, true);
        }
                
        if($amount == '')
        {
            $arrr = array(
                'Code' => 1,
                'Message' => 'Please fill in amount'
            );
            
            return json_encode($arrr, true);
        }
                        
        if($pinNumber == '')
        {
            $arrr = array(
                'Code' => 1,
                'Message' => 'Please fill in pin number'
            );
            
            return json_encode($arrr, true);
        }

        $transaction = Transaction::create([
            'user_id' =>$userId,
            'amount' => $amount,
            'type' => 1,
            'company_id' => 1,
            'status' => 3,
            'promotion_id' => 0,
            'bank_id' => 0,
            'remark' => "Telco Payment",
            'approved_by' => 0,
            'created_at' => $currDate,
            'transaction_time' => $currDate,
            'receipt_path' => '',
            'approval_remark' => "",
            'isPromotion' => 0,
            'deposit_device' => 1
        ]);
        
        $orderid = $transaction->id; //Merchant order ID 
        
        //sign format
        //Sign
        //MD5(Amount+ReloadPinNumber+ApiCode+MerchantTransactionSerial+TelcoProviderCode+GatewayType)
        $sign = md5($amount2.$pinNumber.$apiCode.$orderid.$telcoProvider.$gatewayType);
        
        $params = array(
            'MerchantCode' => "91win_api",
            'MerchantTransactionSerial' => $orderid,
            'MerchantMemberCode' => $userName,
            'GatewayType' => $gatewayType,
            'TelcoProviderCode' => $telcoProvider,
            'ReloadPinNumber' => $pinNumber,
            'Amount' => number_format($amount2, 2),
            'Sign' => $sign,
        );

        curl_setopt_array($curl, array(
          CURLOPT_URL => $apiUrl,
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($params, true),
          CURLOPT_HTTPHEADER => array(
            'ApiKey: 261c1a36f4d340749962c347aa30dda8',
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }
}
