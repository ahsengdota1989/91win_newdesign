<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use Auth;
use Validator;
use Log;

class PaymentController extends Controller
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
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function payment()
    {
        $promotion = DB::SELECT("select * from promotions where status = ? and id IN(2,3,4,11,17) order by position desc",array(1));

        $promoArr = array();
        foreach($promotion as $promo1)
        {
            $arr = array(
                'id' => $promo1->id,
                'name' => $promo1->name,
                'details' => $promo1->details,
                'turnover' => $promo1->turnover,
                'minimum_deposit' => $promo1->minimum_deposit,
                'banner' => $promo1->banner,
                'short_description' => $promo1->short_description,
            );

            array_push($promoArr, $arr);
        }
        
        //get reward balance and main wallet balance
        $db = DB::SELECT("select balance , reward_balance FROM users_wallets WHERE user_id = ?",array(Auth::User()->id));
        $mainBalance = number_format($db[0]->balance, 2);
        $rewardBalance = number_format($db[0]->reward_balance, 2);
        
        return view('payment')->with('promoArr', $promoArr)->with('mainBalance', $mainBalance)->with('rewardBalance', $rewardBalance);
    }

    public function deposit()
    {
        $userId = Auth::User()->id;
        $companyId = env('COMPANY_ID', '1');
        
        //get users details
        $db = DB::SELECT("SELECT a.created_at, b.balance, c.member_batch FROM users as a
                          inner join users_wallets as b on a.id = b.user_id
                          inner join users_details as c on a.id = c.user_id WHERE a.id = ?",array($userId));
        
        $db2 =  DB::SELECT("SELECT reward_balance FROM users_wallets WHERE user_id = ?",array($userId));

        //get bank details here 
        $getbanks = DB::SELECT("SELECT * FROM banks WHERE status = ? and user_level = ?",array(1, $db[0]->member_batch));
        $banksArray = array();
        foreach($getbanks as $bvbb)
        {
            $arrr = array(
                'id' => $bvbb->id,
                'bank_name' => $bvbb->bank_name,
                'account_number' => $bvbb->account_number,
                'account_holder_name' => strtoupper($bvbb->account_holder_name),
                'bank_image' => $bvbb->bank_image
            );
            
            array_push($banksArray, $arrr);
        }
        
        return view('payment_deposit')->with('banksArray', $banksArray);
    }
    
    public function depositProcess(Request $Request)
    {
        DB::BeginTransaction();

        try
        {
            if($Request->file('dep_receipt') == '')
            {
                $response = array(
                    'status'=> 1 
                    ,'message'=>'Please upload receipt file (png, jpg, jpeg ONLY).'
                );

                DB::Rollback();

                return json_encode($response);
            }

            $validation = Validator::make($Request->all(), [
                //'dep_receipt' => 'required|image|mimes:jpeg,jpg,png,gif'
            ]);

            if($validation->passes())
            {
                $userId = Auth::User()->id;
                $depBank = $Request->dep_bank;
                $depAmount = $Request->dep_amount;
                $depPromo = $Request->dep_promo;
                $companyId = env('COMPANY_ID', '1');
                $currDate = date("Y-m-d H:i:s");
                $depositDevice = 1; //1 == desktop , 2 = mobile

                //receipt
                $depReceipt = $Request->file('dep_receipt');
                $new_name = rand() . '.' . $depReceipt->getClientOriginalExtension();
                $depReceipt->move(public_path('images/receipt'), $new_name);

                //check other 3rd party balance

                if($depBank == 0)
                {
                    $response = array(
                        'status'=> 1
                        ,'message'=>'Please select bank.'
                    );

                    DB::Rollback();

                    return json_encode($response);
                }
                else if($depAmount == '')
                {
                    $response = array(
                        'status'=> 1
                        ,'message'=>'Please fill all the required fields.'
                    );

                    DB::Rollback();

                    return json_encode($response);
                }
                else if($depAmount < 30)
                {
                    $response = array(
                        'status'=> 1
                        ,'message'=>'Deposit amount cannot be less than RM30.'
                    );

                    DB::Rollback();

                    return json_encode($response);
                }
                else
                {
                    //check if still got existing deposit havent approve, cannot make another deposit
                    //if still got balance more than rm10 , cannot make deposit
                    //if turnover havent finish , cannot deposit
                    $valid = DB::SELECT("SELECT * FROM transactions WHERE type = ? AND status = ? AND user_id = ?",array(1,3,$userId));
                    $wallet = DB::SELECT("SELECT balance, turnover_balance,is_promotion
                                            FROM users_wallets WHERE user_id = ?",array($userId));
                    
                    if(Count($valid) > 0)
                    {
                        $response = array(
                            'status'=> 1
                            ,'message'=>'Unable to process double deposit, please check your transaction history'
                        );
            
                        return json_encode($response);
                    }

                    //insert normal deposit
                    DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                          promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device)
                          VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?)",
                          array(
                              $userId
                              ,$depAmount
                              ,1
                              ,$companyId
                              ,3
                              ,0
                              ,$depBank
                              ,"Deposit from "
                              ,0
                              ,$currDate
                              ,$currDate
                              ,$new_name
                              ,$depositDevice
                          ));

                    $response = array(
                        'status'=> 0
                        ,'message'=> 'Deposit Success'
                    );

                    DB::Commit();

                    return json_encode($response);
                }
            }
            else
            {
                DB::Rollback();

                $response = array(
                    'status'=> 1
                    ,'message'=> $validation->errors()->all()
                );

                return json_encode($response);
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            $response = array(
                'status'=> 1
                ,'message'=> 'Deposit failed! Please contact customer service for assistance! Thank you.'
            );

            return json_encode($response);
        }
    }

    public function withdraw()
    {
        $userId = Auth::User()->id;
        
        //this if for withdrawal
        $userBanks = DB::SELECT("SELECT * FROM users_banks WHERE user_id = ?",array($userId));

        $userBankArray = array();
        foreach($userBanks as $userBank)
        {
            $arr5 = array(
                'id' => $userBank->id,
                'bank_name' => $userBank->bank_name,
                'account_number' => $userBank->account_number,
            );

            array_push($userBankArray, $arr5);
        }
        
                //get reward balance and main wallet balance
        $db = DB::SELECT("select balance , reward_balance FROM users_wallets WHERE user_id = ?",array($userId));
        $mainBalance = number_format($db[0]->balance, 2);
        $rewardBalance = number_format($db[0]->reward_balance, 2);
        
        return view('payment_withdraw')->with('userBankArray', $userBankArray)->with('mainBalance', $mainBalance)->with('rewardBalance', $rewardBalance);
    }

    public function history()
    {
        return view('payment_history');
    }

    public function referral()
    {
        $userName = Auth::User()->user_name;
        
        $db = DB::SELECT("SELECT a.created_at as cat, a.name , a.user_name , a.phone_number FROM users as a INNER JOIN users_details as b ON a.id = b.user_id WHERE b.referral_id = ?",array($userName));
        $refArray = array();
        
        foreach($db as $ref)
        {
            $arr = array(
                'created_at' => $ref->cat, 
                'name' => $ref->name,
                'user_name' => $ref->user_name,
                'phone_number' => $ref->phone_number
            );
            
            array_push($refArray, $arr);
        }
        
        return view('payment_referral')->with('refArray', $refArray)->with('totalReferral', Count($db));
    }
}
