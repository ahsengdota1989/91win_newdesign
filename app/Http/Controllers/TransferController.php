<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Facades;
use Validator;
use Log;
use App\Http\Controllers\Helper;
use App\Http\Controllers\HelperFourdee;

class TransferController extends Controller
{
    //done check for new server 05/08/2022
    public function transferGameProcess(request $request)
    {
        $userId = Auth::User()->id;
        $companyId = env('COMPANY_ID', '1');
        $from = $request->from;
        $to = $request->to;
        $promotion = $request->promotion;
        $amount = is_numeric($request->amount);

        if($amount <= 0 || $amount = '')
        {
            $response = array(
                'status'=> 1
                ,'message'=>'Please enter transfer amount / 请输入转账金额'
            );

            return json_encode($response);
        }

        if($from == $to)
        {
            $response = array(
                'status'=> 1
                ,'message'=>'Cannot transfer to the same game'
            );

            return json_encode($response);
        }

        if($from == '' || $to == '')
        {
            $response = array(
                'status'=> 1
                ,'message'=> 'Please select game from and to transfer'
            );

            return json_encode($response);
        }
        
        if($request->promotion != 0)
        {
            $response = array(
                'status'=> 1
                ,'message'=>'Bonus & promotions currently not available.'
            );

            return json_encode($response);
        }

        //main wallet
        //check balance
        if($from == 1)
        {
            //check main wallet balance
            $db = DB::SELECT("SELECT balance FROM users_wallets where user_id = ?",array($userId));

            if($amount > $db[0]->balance)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'Transfer amount is more than wallet balance'
                );

                return json_encode($response);
            }

            $fromResponse = $this->fromMainWallet(); // will always return 1 , if got balance inside main wallet
        }

        //reward wallet
        if($from == 99)
        {
            if($to == 10)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=>'Reward  wallet cannot transfer to 4D'
                );
    
                return json_encode($response);
            }
            
            if($to == 1)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=>'Reward wallet cannot transfer to Main Wallet'
                );
    
                return json_encode($response);
            }
            
            if($request->promotion != 0)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=>'Reward wallet cannot apply promotions'
                );
    
                return json_encode($response);
            }

            $fromResponse = $this->fromRewardWallet($request->amount); // will always return 1 , if got balance inside main wallet
        }
        
        //1 is main wallet
        if($to != 1)
        {
            //example : from main wallet 1, to mega 7, promotion 11, amount 10
            $promoValidate = $this->promotionValidation($from, $to, $request->promotion, $request->amount);
            
            if($promoValidate == 18)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=>'You are no longer entitled for this promotion'
                );
    
                return json_encode($response);
            }
            
            if($promoValidate == 10)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=>'You are no longer entitled to take 168% welcome bonus'
                );
    
                return json_encode($response);
            }
            
            if($promoValidate == 11)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=>'You are not entitled to take Slot Bonus for this game'
                );
    
                return json_encode($response);
            }
            
            if($promoValidate == 12)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'You can only select 10% bonus 1 time per day for this game'
                );
    
                return json_encode($response);
            }
        }
        
        if($to == 10 && $request->promotion != 0)
        {
            $response = array(
                'status'=> 1
                ,'message'=> '4D cannot take this promotion'
            );

            return json_encode($response);
        }
        
        if($to == 14)
        {
            if($request->amount < 20)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'Minimum amount to transfer to Allbet Casino is RM20'
                );
    
                return json_encode($response);
            }
        }
        
        //other games cannot take 10 percent sports bonus
        if($request->promotion == 17 && $request->promotion != 0)
        {
            if($to == 1 || $to == 3 || $to == 4 || $to == 5 || $to == 6 || $to == 8 || $to == 9 || 
            $to == 10 || $to == 11 || $to == 14 || $to == 16 || $to == 7 || $to == 12 || $to == 13)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'This game cannot choose 10% Sports Bonus Promotion'
                );
    
                return json_encode($response);
            }
        }
        
        //other games cannot take 50 percent slot bonus
        if($request->promotion == 11 && $request->promotion != 0)
        {
            if($to == 1 || $to == 2 || $to == 3 || $to == 4 || $to == 5 || $to == 6 || $to == 8 || $to == 9 || 
            $to == 10 || $to == 11 || $to == 14 || $to == 15 || $to == 16 || $to == 17)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'This game cannot choose 50% Slot Bonus Promotion'
                );
    
                return json_encode($response);
            }
        }
        
        if($request->promotion != 11 && $request->promotion != 0)
        {
            if($to == 7 || $to == 12 || $to == 13)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'This game cannot select this promotion'
                );
    
                return json_encode($response);
            }
        }
        
        //check if agent , then cannot take promotions
        $checkIfAgent = DB::SELECT("SELECT agent FROM users_details WHERE user_id = ?",array($userId));
        if($request->promotion != 0 && $checkIfAgent[0]->agent != null)
        {
            $response = array(
                'status'=> 1
                ,'message'=>'You cannot take promotions. Please contact your agent'
            );

            return json_encode($response);
        }
        
        //sbo
        if($from == 15)
        {
            // $fromResponse = $this->sbowithdrawal($request->amount);
        }
        
        //ibc maxbet
        if($from == 17)
        {
            $fromResponse = $this->ibcwithdrawal($request->amount);
        }
        
        //spadegaming
        if($from == 3)
        {
            $fromResponse = $this->spadewithdrawal($request->amount);
        }

        //evo
        if($from == 5)
        {
            $fromResponse = $this->evoToMain($request->amount);
        }

        //playtech
        if($from == 8)
        {
            $fromResponse = $this->playtechWithdraw($request->amount);
        }

        //joker
        if($from == 6)
        {
            $fromResponse = $this->jokerToMain($request->amount);
        }

        //4d
        if($from == 10)
        {
            $fromResponse = $this->fourDeeWithdraw($request->amount);
        }

        //mega
        if($from == 7)
        {
            $fromResponse = $this->megaToMainWallet($request->amount);
        }

        //sexy
        if($from == 4)
        {
            $fromResponse = $this->sexywithdraw($request->amount);
        }
        
        //asia gaming
        if($from == 11)
        {
            $fromResponse = $this->agwithdraw($request->amount);
        }
        
        //pussy888
        if($from == 12)
        {
            $fromResponse = $this->pussywithdraw($request->amount);
        }
        
        //918kiss
        if($from == 13)
        {
            $fromResponse = $this->nineoneeightwithdraw($request->amount);
        }
        
        if($from == 16)
        {
            $fromResponse = $this->microwithdraw($request->amount);
        }
        
        if($from == 14)
        {
            $fromResponse = $this->allbetwithdraw($request->amount);
        }
        
        //seamless wallet
        if($from == 9 || $from == 2)
        {
            $fromResponse = $this->seamlessWithdrawal($from, $to, $request->amount);
        }

        if($fromResponse == 1)
        {
            $toResponse = $this->to($from, $to, $request->amount, 0);

            if($toResponse == 1)
            {
                if($request->promotion != 0)
                {
                    $promoRes = $this->checkPromotion($from, $to, $request->promotion, $request->amount);
                    //if 1 , then it is success
                    if($promoRes == 1)
                    {
                        $response = array(
                            'status'=> 0
                            ,'message'=> 'Transfer Success - with promotion'
                        );
        
                        return json_encode($response);
                    }
                    else
                    {
                        $response = array(
                            'status'=> 1
                            ,'message'=> 'Transfer success, but promotion amount failed to be credited into your account. Please try again'
                        );
        
                        return json_encode($response);
                    }
                }
                else
                {
                    $response = array(
                        'status'=> 0
                        ,'message'=> 'Success'
                    );
    
                    return json_encode($response);
                }
            }
            else if($toResponse == 3)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'Error - promotion turnover requirement not reached'
                );
    
                return json_encode($response);
            }
            else if($toResponse == 4)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'Error - Minimum withdrawal not met'
                );
    
                return json_encode($response);
            }
            //only for mega
            else if($toResponse == 2)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'The promotion that u selected cannot transfer to this game.'
                );

                return json_encode($response);
            }
            else if($toResponse == 5)
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'IBC Maxbet minimum trasfer is 5.00'
                );

                return json_encode($response);
            }
            else
            {
                $response = array(
                    'status'=> 1
                    ,'message'=> 'Error - Please try again / Insufficient balance'
                );

                return json_encode($response);
            }
        }
        else if($fromResponse == 3)
        {
            $response = array(
                'status'=> 1
                ,'message'=> 'Error - promotion turnover requirement not reached'
            );

            return json_encode($response);
        }
        else if($fromResponse == 4)
        {
            $response = array(
                'status'=> 1
                ,'message'=> 'Error - Minimum withdrawal not met'
            );

            return json_encode($response);
        }
        else if($fromResponse == 5)
        {
            $response = array(
                'status'=> 1
                ,'message'=> 'IBC Maxbet minimum transfer is 5.00'
            );

            return json_encode($response);
        }
        else
        {
            $response = array(
                'status'=> 1
                ,'message'=> 'Error - Please contact customer service via whatsapp or live chat'
            );

            return json_encode($response);
        }
    }

    //done check for new server 05/08/2022
    private function to($from, $to, $amount, $isPromo)
    {
        if($to == 9 || $to == 2)
        {
            $toResponse = $this->seamlessDeposit($from, $to, $amount, $isPromo);
        }
        
        if($to == 1)
        {
            Helper::transferLog($from, $to, 1, $amount);

            $toResponse = 1;
        }
        
        //promo ok
        if($to == 16)
        {
            $toResponse = $this->microdeposit($from, $to, $amount, $isPromo);
        }
        
        //promo ok
        if($to == 3)
        {
            $toResponse = $this->spadedeposit($from, $to, $amount, $isPromo);
        }
        
        //promo ok
        if($to == 15)
        {
            // $toResponse = $this->sbodeposit($from, $to, $amount, $isPromo);
        }
                
        //promo ok
        if($to == 17)
        {
            $toResponse = $this->ibcdeposit($from, $to, $amount, $isPromo);
        }
        
        //promo ok
        if($to == 5)
        {
            $toResponse = $this->mainToEvo($from, $to, $amount, $isPromo);
        }

        //playtech
        //promo ok
        if($to == 8)
        {
            $toResponse = $this->playtechDeposit($from, $to, $amount, $isPromo);
        }

        //joker
        //promo  ok
        if($to == 6)
        {
            $toResponse = $this->mainToJoker($from, $to, $amount, $isPromo);
        }

        //4d
        if($to == 10)
        {
            $toResponse = $this->fourDeeDeposit($from, $to, $amount, $isPromo);
        }

        //mega
        //promo ok
        if($to == 7)
        {
            $toResponse = $this->transferToMega($from, $to, $amount, $isPromo);
        }

        //sexy
        //promo ok
        if($to == 4)
        {
            $toResponse = $this->sexydeposit($from, $to, $amount, $isPromo);
        }
        
        //asia gaming
        //promo ok
        if($to == 11)
        {
            $toResponse = $this->agdeposit($from, $to, $amount, $isPromo);
        }
        
        //pussy
        //promo ok
        if($to == 12)
        {
            $toResponse = $this->pussydeposit($from, $to, $amount, $isPromo);
        }
        
        //918kiss
        //promo ok
        if($to == 13)
        {
            $toResponse = $this->nineoneeightdeposit($from, $to, $amount, $isPromo);
        }

        //allbet
        if($to == 14)
        {
            $toResponse = $this->allbetdeposit($from, $to, $amount, $isPromo);
        }

        return $toResponse;
    }

    //done check for new server 05/08/2022
    private function promotionValidation($from, $to, $depPromo, $amount)
    {
        $userId = Auth::User()->id;

        //168% welcome bonus
        if($depPromo == 2)
        {
            //check if already take 68%
            $checkAlready68 = DB::SELECT("SELECT * FROM transactions WHERE promotion_id = ? and status = ? and user_id = ? 
                and isSixtyEight = ?",array(2, 1, $userId, 1));
            
            Log::Error("Ah pundekkkkkk");
            
            if(Count($checkAlready68) > 0)
            {
                //check from transactions if already choose 100% welcome bonus then cannot anymore
                $check100 = DB::SELECT("SELECT * FROM transactions WHERE promotion_id = ? and status = ? and user_id = ? 
                    and isSixtyEight = ?",array(2, 1, $userId, 0));
                            Log::Error("Ah pundekkkkkk 2");
                if(Count($check100) > 0)
                {
                    Log::Error("Ah pundekkkkkk 3");
                    return 10;
                }
            }
        }
        
        //10% sportsbook daily promotion
        if($depPromo == 17)
        {
            $startToday = date('Y-m-d 00:00:00');
            $endToday = date('Y-m-d 23:59:59');
            
            //slots bonus
            $checkSportsBonus = DB::SELECT("SELECT * FROM transactions WHERE promotion_id = ? and status = ? 
                and user_id = ? and transfer_game_id = ? AND created_at >= ? AND created_at <= ?",array(17, 1, $userId, $to, $startToday, $endToday));

            if(Count($checkSportsBonus) > 0)
            {
                return 12;
            }
        }

        //50% slots bonus
        //only for mega, 918kiss and pussy888
        if($depPromo == 11)
        {
            //slots bonus
            $checkMegaBonus = DB::SELECT("SELECT * FROM transactions WHERE promotion_id = ? and status = ? 
                and user_id = ? and transfer_game_id = ?",array(11, 1, $userId, $to));

            if(Count($checkMegaBonus) > 0)
            {
                return 11;
            }
        }

        //10% daily deposit
        if($depPromo == 3)
        {
            $startToday = date('Y-m-d 00:00:00');
            $endToday = date('Y-m-d 23:59:59');

            $check10 = DB::SELECT("SELECT * FROM transactions 
                                   WHERE promotion_id = ? AND status = ? AND created_at >= ? AND created_at <= ? 
                                   AND user_id = ?",array(3, 1, $startToday, $endToday, $userId));

            Log::Error("Babiiii");
            Log::Error(Count($check10));
            if(Count($check10) > 0)
            {
                Log::Error("Babiiii 2");
                return 12;
            }
        }
    }

    //done check for new server 05/08/2022
    private function checkPromotion($from, $to, $depPromo, $amount)
    {
        DB::BeginTransaction();
        
        try
        {
            $currDate = date("Y-m-d H:i:s");
            $depositDevice = 2;
            $userId = Auth::User()->id;

            //add turnover balance in users_wallets table
            $promo = DB::SELECT("SELECT * FROM promotions WHERE id = ?",array($depPromo));

            $promotionPercentage = $promo[0]->promotion_percentage;
            $turnover = $promo[0]->turnover;
            $isSixtyEight = 0;
            
            if($depPromo == 2)
            {
                $promotionPercentage = 68;
                $turnover = 18;
                $isSixtyEight = 1;
                //check is68 == 1 exist or not
                $checkSixtyEight = DB::SELECT("SELECT id FROM transactions WHERE promotion_id = ? and status = ? and user_id = ? 
                    and isSixtyEight = ?",array(2, 1, $userId, 1));
                
                if(Count($checkSixtyEight) == 1)
                {
                    $isSixtyEight = 0;
                    $promotionPercentage = 100;
                    $turnover = 22;
                }
            }

            //promotion amount
            $promoAmount = ($amount * $promotionPercentage) / 100;
            
            if($promoAmount > 168)
            {
                $promoAmount = 168;
            }

            //$totalDeposit = $promoAmount;
            $totalDeposit = $promoAmount + $amount;
            $turnoverBal = $totalDeposit * $turnover;
            $minWith = $totalDeposit * 4;

            //this is only for slot (50% slots bonus)
            //other game's providers cannot take this slot
            if($depPromo == 11)
            {
                //update min withdrawal
                //mega
                if($to == 7)
                {
                    $res = $this->transferToMega($from, $to, $promoAmount,1);

                    //once successfully transfered to mega then only process this
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET mega_min_withdraw = ? WHERE user_id = ?",array($minWith, $userId));
                        
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"50% Slots Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                    ));
                                                            
                        DB::Commit();
                        
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }

                //pussy
                if($to == 12)
                {
                    $res = $this->pussydeposit($from, $to, $promoAmount, 1);

                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET pussy_min_withdraw = ? WHERE user_id = ?",array($minWith, $userId));
                                                
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"50% Slots Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                    ));
                        
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }

                //918kiss
                if($to == 13)
                {
                    $res = $this->nineoneeightdeposit($from, $to, $promoAmount, 1);
                    
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET nine_min_withdraw = ? WHERE user_id = ?",array($minWith, $userId));
                                                
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
            }
            else // this is for other games , 918kiss, mega888 and pussy888 cannot take these promotions
            {
                //pragmatic slots and live casino 
                if($to == 9)
                {
                    $res = $this->seamlessDeposit($from, $to, $promoAmount, 1);

                    if($res == 1)
                    {
                        //Log::Error("pragmatic hereeee");
                        $thislanjiao = DB::UPDATE("UPDATE users_wallets SET pragmatic_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }

                //allbet live casino
                if($to == 14)
                {
                    //need to create a new one for allbet
                    $res = $this->allbetdeposit($from, $to,  $promoAmount, 1);
                    
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET allbet_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }

                //spade gaming slots
                if($to == 3)
                {
                    $res = $this->seamlessDeposit($from, $to,  $promoAmount, 1);
                    
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET spade_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }

                //m8sporsts
                if($to == 2)
                {
                    $res = $this->seamlessDeposit($from, $to, $promoAmount, 1);
                    
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET m8_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                
                //evolution live casino
                if($to == 5)
                {
                    $res = $this->mainToEvo($from, $to, $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        $lanjiao = DB::UPDATE("UPDATE users_wallets SET evo_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        //insert promotion transactions
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {   
                        DB::Rollback();
            
                        return 0;
                    }
                }
        
                //playtech slots and live casino
                if($to == 8)
                {
                    $res = $this->playtechDeposit($from, $to, $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET playtech_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        //insert promotion transactions
                          DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
        
                //joker slots
                if($to == 6)
                {
                    $res = $this->mainToJoker($from, $to,  $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET joker_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
        
                //4d
                //4d cannot take any promotions
                if($to == 10)
                {
                    return 0;
                    $res = $this->fourDeeDeposit($from, $to,  $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET fourdee_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        DB::Rollback();
                        
                        return 0;
                    }
                }
        
                //sexy
                if($to == 4)
                {
                    $res = $this->sexydeposit($from, $to, $promoAmount, 1);
                    
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET sexy_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                        
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                
                //asia gaming slots and live casino
                if($to == 11)
                {
                    $res = $this->agdeposit($from, $to, $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET ag_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                
                //sbo sportsbook
                if($to == 15)
                {
                    $res = $this->sbodeposit($from, $to, $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET sbo_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                                
                //ibc sportsbook
                if($to == 17)
                {
                    $res = $this->ibcdeposit($from, $to, $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET ibc_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
                
                //microgaming slots and live casino
                if($to == 16)
                {
                    $res = $this->microdeposit($from, $to, $promoAmount, 1);
                                        
                    if($res == 1)
                    {
                        DB::UPDATE("UPDATE users_wallets SET micro_turnover = ? WHERE user_id = ?",array($turnoverBal, $userId));
                                                
                        DB::INSERT("INSERT INTO transactions (user_id, amount, type, company_id, status,
                                    promotion_id, bank_id, remark, approved_by, created_at,transaction_time, receipt_path, deposit_device, isPromotion, transfer_game_id, isSixtyEight)
                                    VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)",
                                    array(
                                        $userId
                                        ,$promoAmount
                                        ,5
                                        ,1
                                        ,1
                                        ,$depPromo
                                        ,0
                                        ,"Transfer Promotion"
                                        ,0
                                        ,$currDate
                                        ,$currDate
                                        ,""
                                        ,0
                                        ,1
                                        ,$to
                                        ,$isSixtyEight
                                    ));
                                                            
                        DB::Commit();
                                                            
                        return 1;
                    }
                    else
                    {
                        return 0;
                    }
                }
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            
            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function fromMainWallet()
    {
        return 1;
    }

    //done check for new server 05/08/2022
    private function fromRewardWallet($amount)
    {
        DB::BeginTransaction();

        try
        {
            $userId = Auth::User()->id;

            $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.reward_balance FROM users as a
                              INNER JOIN users_wallets as b ON a.id = b.user_id
                              INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));

            $rewardBal = $db[0]->reward_balance;
            
            //check if amount is sufficient or not
            if($amount > $rewardBal)
            {
                DB::Rollback();

                return 0;
            }

            Helper::transferLog(99, 1, 1, $amount);

            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ?, reward_balance = reward_balance - ? WHERE user_id = ?",array($amount,$amount, $userId));

            DB::Commit();

            return 1;
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            
            return 0;
        }
    }
    
    //send amount to main wallet
    //done check for new server 05/08/2022
    private function seamlessWithdrawal($from, $to, $amount)
    {
        //9 = pp,
        //14 = allbet,
        //2 = m8sports,
        
        DB::BeginTransaction();
        try
        {
            $userId = Auth::User()->id;
            
            //pp
            if($from == 9)
            {
                // return 0;
                $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
                $ppBal = $db[0]->pp_balance;
                
                if($amount > $ppBal)
                {
                    DB::Rollback();
                    
                    return 0;
                }
                
                //check turnover is met or not
                if($ppBal > 0 && $db[0]->pragmatic_turnover > 0)
                {
                    return 3;
                }
                
                DB::UPDATE("UPDATE users_wallets SET pp_balance = pp_balance - ?, balance = balance + ? WHERE user_id = ?",array($amount, $amount, $userId));
                
                $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
                $ppBal2 = $db2[0]->pp_balance;
                
                Helper::transferLogNew($from, $to, 1, $amount, $ppBal2);
                
                DB::Commit();
                
                return 1;
            }
            
            //m8sports
            if($from == 2)
            {
                return 0;
                $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
                $m8Bal = $db[0]->m8_balance;
                
                if($amount > $m8Bal)
                {
                    DB::Rollback();
                    
                    return 0;
                }
                
                //check turnover is met or not
                if($m8Bal > 0 && $db[0]->m8_turnover > 0)
                {
                    return 3;
                }
                
                DB::UPDATE("UPDATE users_wallets SET m8_balance = m8_balance - ?, balance = balance + ? WHERE user_id = ?",array($amount, $amount, $userId));
                
                $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
                $m8Bal2 = $db2[0]->m8_balance;
                
                Helper::transferLogNew($from, $to, 1, $amount, $m8Bal2);
                
                DB::Commit();
                
                return 1;
            }
            
            return 1;
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            
            return 0;
        }

    }
    
    //send amount to game wallet
    //done check for new server 05/08/2022
    private function seamlessDeposit($from, $to, $amount, $isPromo)
    {
        //9 = pp,
        //2 = m8sports,

        DB::BeginTransaction();
        
        try
        {
            $userId = Auth::User()->id;
            
            $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            $bal = $db[0]->balance;
            
            // if($isPromo == 0)
            // {
                if($amount > $bal)
                {
                    DB::Rollback();
                    
                    return 0;
                }
            // }

            //pp
            if($to == 9)
            {
                // return 0;
                if($db[0]->pp_balance <= 5)
                {
                    DB::UPDATE("UPDATE users_wallets SET pragmatic_turnover = ? WHERE user_id = ?",array(0, $userId));
                }
                
                //once the balance is below rm5, then this condition is no longer valid
                //once turnover is below 0, then this condition is no longer valid
                //turnover
                if($db[0]->pp_balance > 5 && $db[0]->pragmatic_turnover > 0)
                {
                    DB::Rollback();
                    
                    return 3;
                }
                
                if($isPromo == 1)
                {
                    DB::UPDATE("UPDATE users_wallets SET pp_balance = pp_balance + ? WHERE user_id = ?",array($amount, $userId));
                    
                    DB::Commit();
                    
                    return 1;
                }
                
                // sleep(1);
                
                Helper::transferLog($from, $to, 1, $amount);
                
                DB::UPDATE("UPDATE users_wallets SET pp_balance = pp_balance + ?, balance = balance - ? WHERE user_id = ?",array($amount, $amount, $userId));
                
                DB::Commit();
                
                return 1;
            }
            
            //m8sports
            if($to == 2)
            {      
                if($db[0]->m8_balance <= 5)
                {
                    DB::UPDATE("UPDATE users_wallets SET m8_turnover = ? WHERE user_id = ?",array(0, $userId));
                }
                
                if($db[0]->m8_balance > 0 && $db[0]->m8_turnover > 0)
                {
                    DB::Rollback();
                    
                    return 3;
                }
                
                if($isPromo == 1)
                {
                    DB::UPDATE("UPDATE users_wallets SET m8_balance = m8_balance + ? WHERE user_id = ?",array($amount, $userId));
                
                    DB::Commit();
                    
                    return 1;
                }
                
                Helper::transferLog($from, $to, 1, $amount);
                
                DB::UPDATE("UPDATE users_wallets SET m8_balance = m8_balance + ?, balance = balance - ? WHERE user_id = ?",array($amount, $amount, $userId));
                
                DB::Commit();
                
                return 1;
            }

            return 0;
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            
            return 0;
        }
    }
    
    //done check for new server 05/08/2022
    private function nineoneeightdeposit($from, $to, $amount, $isPromo)
    {
        DB::BeginTransaction();

        try
        {
            $userId = Auth::User()->id;
        
            $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            $mainWalletBal = $db2[0]->balance;
                    
            $nineoneeightbal = $this->nineoneeightbalance();
            
            // if($isPromo == 0)
            // {
                if($amount > $mainWalletBal)
                {
                    DB::Rollback();

                    return 0;
                }
            // }

            if($nineoneeightbal <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET nine_min_withdraw = ? WHERE user_id = ?",array(0, $userId));
            }
            
            //check turnover is met or not
            if($nineoneeightbal < $db2[0]->nine_min_withdraw)
            {
                DB::Rollback();

                return 4;
            }
            
            $db88 = DB::SELECT("SELECT phone_number FROM users WHERE id = ?",array($userId)); 

            $phoneNum = $db88[0]->phone_number;
                    
            $params = array(
                "phoneno" => $phoneNum,
                "userid" => $userId,
                "amount" => $amount
            );

            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://91win999.com/918kiss/transferin.php',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS =>json_encode($params , true),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json'
            ),
            ));
            
            $response = curl_exec($curl);
            
            curl_close($curl);
            
            if($response == '')
            {
                DB::Rollback();

                return 0;
            }
            else
            {
                $res = json_decode($response, 1);
                
                if($res['success'] == true)
                {
                    if($isPromo == 1)
                    {
                        return 1;
                    }
                    
                    // sleep(1);
                    
                    Helper::transferLog($from, $to, 1, $amount);
                        
                    DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

                    DB::Commit();
                    
                    return 1;
                }
                else
                {
                    DB::Rollback();

                    return 0;
                }
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function nineoneeightwithdraw($amount)
    {
        $userId = Auth::User()->id;
        
        $nineoneeightbal = $this->nineoneeightbalance();
        
        if($amount > $nineoneeightbal)
        {
            return 0;
        }
        
        //should join this table
        $db88 = DB::SELECT("SELECT phone_number FROM users WHERE id = ?",array($userId)); 
        $db33 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        
        //check turnover is met or not
        if($amount < $db33[0]->nine_min_withdraw)
        {
            DB::Rollback();
            
            return 4;
        }
        
        $phoneNum = $db88[0]->phone_number;
                
        $params = array(
            "phoneno" => $phoneNum,
            "userid" => $userId,
            "amount" => $amount*-1
        );

        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://91win999.com/918kiss/transferout.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($params , true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        if($response == '')
        {
            return 0;
        }
        else
        {
            $res = json_decode($response, 1);
            
            if($res['success'] == true)
            {
                // sleep(1);
                Helper::transferLogNew(13, 1, 1, $amount, $this->nineoneeightbalance());
                
                DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));
                    
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }

    //done check for new server 05/08/2022
    private function nineoneeightbalance()
    {
        $userId = Auth::User()->id;
        
        //get mega password
        $db = DB::SELECT("SELECT phone_number FROM users WHERE id = ?",array($userId));

        $phoneNum = $db[0]->phone_number;  
        
        $params = array(
            "phoneno" => $phoneNum,
            "userid" => $userId
        );
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://91win999.com/918kiss/balance.php',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($params, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);

        if(curl_errno($curl))
        {
            return 0;
        }
        
        curl_close($curl);
        
        return $response;
    }
    
    //done check for new server 05/08/2022
    private function pussydeposit($from, $to, $amount, $isPromo)
    {
        $userId = Auth::User()->id;
        
        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
                
        $pussybal = $this->pussybalance();
        
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                return 0;
            }
        // }

        if($pussybal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET pussy_min_withdraw = ? WHERE user_id = ?",array(0, $userId));
        }

        //check turnover is met or not
        if($pussybal < $db2[0]->pussy_min_withdraw)
        {
            return 4;
        }

        $agent = 'psyapi91w';
        $dd = 'myr'.$userId;
        $authCode = "gXSJqWgYfEpuEmbcfwBA";
        $secretkey = "a543dfh2649tn793V6hQ";
        $time = time()*1000;
        $sign = strtolower($authCode.$dd.$time.$secretkey); //what is wrong with this part ???
        $sign2 = strtoupper(md5($sign));
        $random = mt_rand(100000,99999999999);
        //$amount = $amount;
        $actionUser = "admin";
        $actionIp = "103.6.198.129";

        $url = "http://api.pussy888.com/ashx/account/setScore.ashx?";
        $param = "action=setServerScore&orderid=$random&scoreNum=$amount&userName=$dd&ActionUser=$actionUser&ActionIp=$actionIp&time=$time&authcode=$authCode&sign=$sign2";
        
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
            $res = json_decode($response, 1);
            
            if($res['success'] == true)
            {
                if($isPromo == 1)
                {
                    return 1;
                }
                
                // sleep(1);
                
                Helper::transferLog($from, $to, 1, $amount);
                    
                DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));
                
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }

    //need check the success message then only add balance to main wallet
    //done check for new server 05/08/2022
    private function pussywithdraw($amount)
    {
        $userId = Auth::User()->id;
        
        $pussybal = $this->pussybalance();
        
        if($amount > $pussybal)
        {
            return 0;
        }
   
        $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        
        //check turnover is met or not
        if($amount < $db[0]->pussy_min_withdraw)
        {
            DB::Rollback();
            
            return 4;
        }

        $agent = 'psyapi91w';
        $dd = 'myr'.$userId;
        $authCode = "gXSJqWgYfEpuEmbcfwBA";
        $secretkey = "a543dfh2649tn793V6hQ";
        $time = time()*1000;
        $sign = strtolower($authCode.$dd.$time.$secretkey); //what is wrong with this part ???
        $sign2 = strtoupper(md5($sign));
        $random = mt_rand(100000,99999999999);
        $amount2 = $amount*-1;
        $actionUser = "admin";
        $actionIp = "103.6.198.129";

        $url = "http://api.pussy888.com/ashx/account/setScore.ashx?";
        $param = "action=setServerScore&orderid=$random&scoreNum=$amount2&userName=$dd&ActionUser=$actionUser&ActionIp=$actionIp&time=$time&authcode=$authCode&sign=$sign2";
        
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
            return 0;
        }

        curl_close($curl);
                
        $resss = json_decode($response, true);
        if($resss['code'] == 0)
        {
            // sleep(1);
            
            Helper::transferLogNew(12, 1, 1, $amount, $this->pussybalance());
            
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));
                
            return 1; 
        }
        
        return 0;
    }

    //done check for new server 05/08/2022
    private function pussybalance()
    {
        $userId = Auth::User()->id;

        $agent = 'psyapi91w';
        $dd = 'myr'.$userId;
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
        
        $res = json_decode($response, true);

        return $res['results'][0]['MoneyNum'];
    }
    
    //asia gaming
    //done check for new server 05/08/2022
    private function agwithdraw($amount)
    {
        $userId = Auth::User()->id;

        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        
        $agbal = $this->aggetbalance();
        
        if($amount > $agbal)
        {
            return 0;
        }
        
        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));

        //check turnover is met or not
        if($agbal > 0 && $db2[0]->ag_turnover > 0)
        {
            return 3;
        }
        
        $userName = strtolower($db[0]->user_name);
        $operatorCode = 'rwin';
        $secretkey = '4197e4b9e0aca56a067f3c8226d48c1b';
        $providerCode = 'AG';
        $password = 'AAaa1234';
        $referenceid = mt_rand(100000,999999);
        //$amount = $agbal;
        $type = 1;//withdraw
        
        $signature = md5($amount.$operatorCode.$password.$providerCode.$referenceid.$type.$userName.$secretkey);
        $sign = strtoupper($signature);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mdapi.world3333.com/makeTransfer.aspx?operatorcode=$operatorCode&providercode=$providerCode&username=$userName&password=$password&referenceid=$referenceid&type=$type&amount=$amount&signature=$sign",
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
        
        $ress = json_decode($response, true);
        
        if($ress['errCode'] == 0)
        {
                            
            // sleep(1);
            Helper::transferLogNew(11, 1, 1, $amount, $this->aggetbalance());
            
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));
                
            return 1;
        }
        
        return 0;

    }

    //done check for new server 05/08/2022
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

    //done check for new server 05/08/2022
    private function agdeposit($from, $to, $amount, $isPromo)
    {
        $userId = Auth::User()->id;
        
        $agbal = $this->aggetbalance();
                
        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        
        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                return 0;
            }  
        // }

        if($agbal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET ag_turnover = ? WHERE user_id = ?",array(0, $userId));
        }
        
        //check turnover is met or not
        if($agbal > 0 && $db2[0]->ag_turnover > 0)
        {
            return 3;
        }
        
        $userName = strtolower($db[0]->user_name);
        $operatorCode = 'rwin';
        $secretkey = '4197e4b9e0aca56a067f3c8226d48c1b';
        $providerCode = 'AG';
        $password = 'AAaa1234';
        $referenceid = mt_rand(100000,999999);
        //$amount = $mainWalletBal;
        $type = 0;//deposit
        
        $signature = md5($amount.$operatorCode.$password.$providerCode.$referenceid.$type.$userName.$secretkey);
        $sign = strtoupper($signature);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "http://mdapi.world3333.com/makeTransfer.aspx?operatorcode=$operatorCode&providercode=$providerCode&username=$userName&password=$password&referenceid=$referenceid&type=$type&amount=$amount&signature=$sign",
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
        
        //need to check if success , then only deduct amount from main wallet
        $res = json_decode($response, 1);
        
        if($res['errMsg'] == "SUCCESS")
        {
            if($isPromo == 1)
            {
                return 1;
            }
            
                            
            // sleep(1);
            //store transfer logs
            Helper::transferLog($from, $to, 1, $amount);
                
            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));
            
            return 1;
        }
        else
        {
            return 0;
        }
    }

    //SEXY
    //done check for new server 05/08/2022
    private function sexywithdraw($amount)
    {
        $cert = 'Hu1lPAqC6XG3wFsuXIb';
        $agentId = 'sb91win88';
        $userId = Auth::User()->id;

        $sexybal = $this->sexygetbalance();
        
        if($amount > $sexybal)
        {
            return 0;
        }
        
        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));

        //check turnover is met or not
        if($amount > 0 && $db2[0]->sexy_turnover > 0)
        {
            return 3;
        }

        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = $db[0]->user_name;
        $resetPass = mt_rand(100000,999999999999999);

        $curl = curl_init();
        
                
        $arrr = array(
            'messagesexy' => $amount
        );
        
        // Log::Error(json_encode($arrr , true));

        curl_setopt_array($curl, [
          CURLOPT_URL => "https://api.onlinegames22.com/wallet/withdraw",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "cert=$cert&agentId=$agentId&userId=$userName&txCode=$resetPass&withdrawType=0&transferAmount=$amount",
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
            // sleep(1);
            
            Helper::transferLogNew(4, 1, 1, $amount, $this->sexygetbalance());
            
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
        else
        {
            return 0;
        }
    }

    //done check for new server 05/08/2022
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

        return $res2['results'][0]['balance'];
    }

    //done check for new server 05/08/2022
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

    //need to double check the success code , check with skype group
    //done check for new server 05/08/2022
    private function sexydeposit($from, $to, $amount, $isPromo)
    {
        $cert = 'Hu1lPAqC6XG3wFsuXIb';
        $agentId = 'sb91win88';
        $userId = Auth::User()->id;

        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        $sexybal = $this->sexygetbalance();
        
        //this part ok
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                //Log::Error("amount is---".$amount);
                return 0;
            } 
        // }

        //this part ok
        if($sexybal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET sexy_turnover = ? WHERE user_id = ?",array(0, $userId));
        }

        //check turnover is met or not
        //this part ok
        if($sexybal > 0 && $db2[0]->sexy_turnover > 0)
        {
            return 3;
        }

        //get from users table
        $db = DB::SELECT("SELECT user_name FROM users WHERE id = ?",array($userId));
        $userName = $db[0]->user_name;
        $resetPass = mt_rand(100000,99999999999999);
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
          CURLOPT_POSTFIELDS => "cert=$cert&agentId=$agentId&userId=$userName&transferAmount=$amount&txCode=$resetPass",
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
            if($isPromo == 1)
            {
                return 1;
            }
            
                                        
            // sleep(1);
            
            //store transfer logs
            Helper::transferLog($from, $to, 1, $amount);

            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));
            
            // Log::Error('0000');
            return 1;
        }
        else
        {
            // Log::Error('not 0000');
            return 0;
        }
    }

    private function CheckOrCreate($username)
    {
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/CheckOrCreate"; //api interface @ which function to be called 
        $client = $username.'_'.$companyId;
        $contentType = "application/json";
        $httpMethod = "POST";
        $accSuffix = "3ia";

        //Please replace with your Operator ID
        $propertyId = "9399976";
        //Please replace with your AllBet API Key
        $allbetApiKey = "/p3Eq6Uk5muwbiS7x96jGgVnhGUGI2tKMW1U1HMmj6jymTmIQFWuE8m/k76PncoohDfBqiYNfZuiiFCk7cKJrw==";

        //okay
        $date   = new \DateTime("now", new \DateTimeZone("UTC"));
        $requestTime = $date->format('D, d M Y H:m:s T'); // "Wed, 28 Apr 2021 06:13:54 UTC"; 
        
        //okay
        $postArray = array(
            'agent' => $agent,
            'player' => $client.$accSuffix
        );

        //okay
        $requestBodyString = json_encode($postArray, true);
        $contentMD5 =  base64_encode(pack('H*', md5($requestBodyString)));
        
        //The steps to generate HTTP authorization headers
        $stringToSign = $httpMethod . "\n"
          . $contentMD5 . "\n"
          . $contentType . "\n"
          . $requestTime . "\n"
          . $path;

          
        //Use HMAC-SHA1 to sign and generate the authorization
        $deKey = base64_decode($allbetApiKey);
        $hash_hmac = hash_hmac("sha1", $stringToSign, $deKey, true);
        $encrypted = base64_encode($hash_hmac);
        $authorization = "AB" . " " . $propertyId . ":" . $encrypted;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiURL . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestBodyString,
            CURLOPT_HTTPHEADER => array(
                'Accept: '.$contentType,
                'Authorization: '.$authorization,
                'Content-MD5: '.$contentMD5,
                'Content-Type: '.$contentType,
                'Date:'.$requestTime
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $res = json_decode($response, true);
        
        return $res['resultCode'];
    }

    private function allbetbalance()
    {
        $username = Auth::User()->user_name;

        $create = $this->CheckOrCreate($username);

        if($create == 'OK' || $create == 'PLAYER_EXIST')
        {
            $companyId = 1; //test
            $apiURL = "https://mw2.absvc.net";
            $agent = "91winyh";
            $path = "/GetBalances"; //api interface @ which function to be called 
            $client = $username.'_'.$companyId;
            $contentType = "application/json";
            $httpMethod = "POST";
            $accSuffix = "3ia";
            $amount = "10.00";
            
            //Please replace with your Operator ID
            $propertyId = "9399976";
            $rand = mt_rand(1000000000000,9999999999999);
            $rand2 = $propertyId.$rand;
            
            //Please replace with your AllBet API Key
            $allbetApiKey = "/p3Eq6Uk5muwbiS7x96jGgVnhGUGI2tKMW1U1HMmj6jymTmIQFWuE8m/k76PncoohDfBqiYNfZuiiFCk7cKJrw==";
    
            //okay
            $date   = new \DateTime("now", new \DateTimeZone("UTC"));
            $requestTime = $date->format('D, d M Y H:m:s T'); // "Wed, 28 Apr 2021 06:13:54 UTC"; 
            
            //okay
            $postArray = array(
                'pageSize' => 1,
                'pageIndex' => 1,
                'recursion' => 1,
                'players' => array($client.$accSuffix)
            );
    
            //okay
            $requestBodyString = json_encode($postArray, true);
            $contentMD5 =  base64_encode(pack('H*', md5($requestBodyString)));
            
            //The steps to generate HTTP authorization headers
            $stringToSign = $httpMethod . "\n"
              . $contentMD5 . "\n"
              . $contentType . "\n"
              . $requestTime . "\n"
              . $path;
    
            //Use HMAC-SHA1 to sign and generate the authorization
            $deKey = base64_decode($allbetApiKey);
            $hash_hmac = hash_hmac("sha1", $stringToSign, $deKey, true);
            $encrypted = base64_encode($hash_hmac);
            $authorization = "AB" . " " . $propertyId . ":" . $encrypted;
    
            $curl = curl_init();
    
            curl_setopt_array($curl, array(
                CURLOPT_URL => $apiURL . $path,
                CURLOPT_RETURNTRANSFER => true,
                CURLOPT_ENCODING => '',
                CURLOPT_MAXREDIRS => 10,
                CURLOPT_TIMEOUT => 0,
                CURLOPT_FOLLOWLOCATION => true,
                CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
                CURLOPT_CUSTOMREQUEST => 'POST',
                CURLOPT_POSTFIELDS => $requestBodyString,
                CURLOPT_HTTPHEADER => array(
                    'Accept: '.$contentType,
                    'Authorization: '.$authorization,
                    'Content-MD5: '.$contentMD5,
                    'Content-Type: '.$contentType,
                    'Date:'.$requestTime
                ),
            ));
    
            $response = curl_exec($curl);
    
            curl_close($curl);
    
            $res = json_decode($response, true);
    
            return $res['data']['list'][0]['amount'];
        }
    }

    //allbet
    private function allbetwithdraw($amount)
    {
        //return 0;
        $userId = Auth::User()->id;

        $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.allbet_turnover FROM users as a
                          INNER JOIN users_wallets as b ON a.id = b.user_id
                          INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));
        
        $allbetBal = $this->allbetbalance();      
        
        if($amount > $allbetBal)
        {
            return 0;
        }
        
        //check turnover is met or not
        if($amount > 0 && $db[0]->allbet_turnover > 0)
        {
            return 3;
        }
        
        $username = Auth::User()->user_name;
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/Transfer"; //api interface @ which function to be called 
        $client = $username.'_'.$companyId;
        $contentType = "application/json";
        $httpMethod = "POST";
        $accSuffix = "3ia";

        //Please replace with your Operator ID
        $propertyId = "9399976";
        $rand = mt_rand(1000000000000,9999999999999);
        $rand2 = $propertyId.$rand;
        
        //Please replace with your AllBet API Key
        $allbetApiKey = "/p3Eq6Uk5muwbiS7x96jGgVnhGUGI2tKMW1U1HMmj6jymTmIQFWuE8m/k76PncoohDfBqiYNfZuiiFCk7cKJrw==";

        //okay
        $date   = new \DateTime("now", new \DateTimeZone("UTC"));
        $requestTime = $date->format('D, d M Y H:m:s T'); // "Wed, 28 Apr 2021 06:13:54 UTC"; 
        
        //okay
        $postArray = array(
            'sn' => $rand2,
            'agent' => $agent,
            'type' => 0,
            'player' => $client.$accSuffix,
            'amount' => $amount
        );

        //okay
        $requestBodyString = json_encode($postArray, true);
        $contentMD5 =  base64_encode(pack('H*', md5($requestBodyString)));
        
        //The steps to generate HTTP authorization headers
        $stringToSign = $httpMethod . "\n"
          . $contentMD5 . "\n"
          . $contentType . "\n"
          . $requestTime . "\n"
          . $path;

        //Use HMAC-SHA1 to sign and generate the authorization
        $deKey = base64_decode($allbetApiKey);
        $hash_hmac = hash_hmac("sha1", $stringToSign, $deKey, true);
        $encrypted = base64_encode($hash_hmac);
        $authorization = "AB" . " " . $propertyId . ":" . $encrypted;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiURL . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestBodyString,
            CURLOPT_HTTPHEADER => array(
                'Accept: '.$contentType,
                'Authorization: '.$authorization,
                'Content-MD5: '.$contentMD5,
                'Content-Type: '.$contentType,
                'Date:'.$requestTime
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $res = json_decode($response, true);
        
        if($res['resultCode'] == 'OK')
        {
            
            // sleep(1);
            Helper::transferLog(14, 1, 1, $amount);

            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
    }

    private function allbetdeposit($from, $to, $amount, $isPromo)
    {
        //return 0;
        $userId = Auth::User()->id;

        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        $allbetBal = $this->allbetbalance();
        
        //this part ok
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                return 0;
            } 
        // }
        
        //this part ok
        if($allbetBal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET allbet_turnover = ? WHERE user_id = ?",array(0, $userId));
        }

        //check turnover is met or not
        //this part ok
        if($allbetBal > 0 && $db2[0]->allbet_turnover > 0)
        {
            return 3;
        }
        
        $username = Auth::User()->user_name;
        $companyId = 1; //test
        $apiURL = "https://mw2.absvc.net";
        $agent = "91winyh";
        $path = "/Transfer"; //api interface @ which function to be called 
        $client = $username.'_'.$companyId;
        $contentType = "application/json";
        $httpMethod = "POST";
        $accSuffix = "3ia";

        //Please replace with your Operator ID
        $propertyId = "9399976";
        $rand = mt_rand(1000000000000,9999999999999);
        $rand2 = $propertyId.$rand;
        
        //Please replace with your AllBet API Key
        $allbetApiKey = "/p3Eq6Uk5muwbiS7x96jGgVnhGUGI2tKMW1U1HMmj6jymTmIQFWuE8m/k76PncoohDfBqiYNfZuiiFCk7cKJrw==";

        //okay
        $date   = new \DateTime("now", new \DateTimeZone("UTC"));
        $requestTime = $date->format('D, d M Y H:m:s T'); // "Wed, 28 Apr 2021 06:13:54 UTC"; 
        
        //okay
        $postArray = array(
            'sn' => $rand2,
            'agent' => $agent,
            'type' => 1,
            'player' => $client.$accSuffix,
            'amount' => $amount
        );

        //okay
        $requestBodyString = json_encode($postArray, true);
        $contentMD5 =  base64_encode(pack('H*', md5($requestBodyString)));
        
        //The steps to generate HTTP authorization headers
        $stringToSign = $httpMethod . "\n"
          . $contentMD5 . "\n"
          . $contentType . "\n"
          . $requestTime . "\n"
          . $path;

        //Use HMAC-SHA1 to sign and generate the authorization
        $deKey = base64_decode($allbetApiKey);
        $hash_hmac = hash_hmac("sha1", $stringToSign, $deKey, true);
        $encrypted = base64_encode($hash_hmac);
        $authorization = "AB" . " " . $propertyId . ":" . $encrypted;

        $curl = curl_init();

        curl_setopt_array($curl, array(
            CURLOPT_URL => $apiURL . $path,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'POST',
            CURLOPT_POSTFIELDS => $requestBodyString,
            CURLOPT_HTTPHEADER => array(
                'Accept: '.$contentType,
                'Authorization: '.$authorization,
                'Content-MD5: '.$contentMD5,
                'Content-Type: '.$contentType,
                'Date:'.$requestTime
            ),
        ));

        $response = curl_exec($curl);

        curl_close($curl);
        
        $res = json_decode($response, true);
        
        if($res['resultCode'] == 'OK')
        {
            if($isPromo == 1)
            {
                return 1;
            }
            
                                        
            // sleep(1);

            Helper::transferLogNew($from, $to, 1, $amount, $this->allbetbalance());

            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
        else
        {
            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function sboBalance()
    {
        $username = Auth::User()->user_name;
        
        $param = array(
            "CompanyKey" => "0D199E24C98D4A9CA6B18060DA7109EC",
            "ServerId" => "YY-production",
            "Username" => $username,
        );
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://ex-api-yy.xxttgg.com/web-root/restricted/player/get-player-balance.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($param),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
                
        $res2 = json_decode($response, true);
        
        return $res2['balance'];
    }
    
    //done check for new server 05/08/2022
    private function sbowithdrawal($amount)
    {
        $userId = Auth::User()->id;

        $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.sbo_turnover FROM users as a
                          INNER JOIN users_wallets as b ON a.id = b.user_id
                          INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));
        
        $sboBal = $this->sboBalance();      
        
        if($amount > $sboBal)
        {
            return 0;
        }
        
        //check turnover is met or not
        if($amount > 0 && $db[0]->sbo_turnover > 0)
        {
            return 3;
        }
        
        $username = Auth::User()->user_name;
        $referenceid = mt_rand(100000,999999999);
        
        $param = array(
            "CompanyKey" => "0D199E24C98D4A9CA6B18060DA7109EC",
            "ServerId" => "YY-production",
            "Username" => $username,
            "Amount" => $amount,
            "TxnId" => $referenceid,
            "isFullAmount" => false
        );
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://ex-api-yy.xxttgg.com/web-root/restricted/player/withdraw.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($param),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
                
        $res2 = json_decode($response, true);
        
        $errorId = $res2['error']['id'];
        
        if($errorId == 0)
        {
            // sleep(1);
            Helper::transferLogNew(15, 1, 1, $amount, $this->sboBalance());

            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
    }

    //done check for new server 05/08/2022
    private function sbodeposit($from, $to, $amount, $isPromo)
    {
        $userId = Auth::User()->id;

        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        $sboBal = $this->sboBalance();
        
        //this part ok
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                //Log::Error("amount is---".$amount);
                return 0;
            } 
        // }
        
        //this part ok
        if($sboBal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET sbo_turnover = ? WHERE user_id = ?",array(0, $userId));
        }

        //check turnover is met or not
        //this part ok
        if($sboBal > 0 && $db2[0]->sbo_turnover > 0)
        {
            return 3;
        }
        
        $username = Auth::User()->user_name;
        $referenceid = mt_rand(100000,999999999);
        
        $param = array(
            "CompanyKey" => "0D199E24C98D4A9CA6B18060DA7109EC",
            "ServerId" => "YY-production",
            "Username" => $username,
            "Amount" => $amount,
            "TxnId" => $referenceid,
        );
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://ex-api-yy.xxttgg.com/web-root/restricted/player/deposit.aspx',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => json_encode($param),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res2 = json_decode($response, true);
        
        $errorId = $res2['error']['id'];
        
        if($errorId == 0)
        {
            if($isPromo == 1)
            {
                return 1;
            }
                                        
            // sleep(1);

            Helper::transferLog($from, $to, 1, $amount);

            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    //ibc maxbet starts here
    private function ibcbalance()
    {
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        $walletId = 1;
        
        $url = "http://m4v7api.db5688.com/api/CheckUserBalance";
        
        $param = "vendor_id=$vendorId&vendor_member_ids=$vendorMemberId&wallet_id=$walletId";
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $data = json_decode($response, true);
        
        return $data['Data'][0]['balance'];
    }
    
    private function ibcwithdrawal($amount)
    {
        $userId = Auth::User()->id;

        $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.ibc_turnover FROM users as a
                          INNER JOIN users_wallets as b ON a.id = b.user_id
                          INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));
        
        $ibcBal = $this->ibcbalance();    

        if($amount < 5)
        {
            return 5;
        }
        
        if($amount > $ibcBal)
        {
            return 0;
        }
        
        //check turnover is met or not
        if($amount > 0 && $db[0]->ibc_turnover > 0)
        {
            return 3;
        }
        
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        $walletId = 1;
        $transId = "91w_".mt_rand(100000,999999999);
        $direction = 0; //1=deposit , 0 = withdraw
        
        $url = "http://m4v7api.db5688.com/api/FundTransfer";
        
        $param = "vendor_id=$vendorId&vendor_member_id=$vendorMemberId&wallet_id=$walletId&vendor_trans_id=$transId&amount=$amount&currency=2&direction=$direction";
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);

        $res = json_decode($response, true);
        
        $errorId = $res['error_code'];
        
        if($errorId == 0)
        {
            // sleep(1);
            Helper::transferLogNew(17, 1, 1, $amount, $this->ibcbalance());

            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
    }
    
    private function ibcdeposit($from, $to, $amount, $isPromo)
    {
        $userId = Auth::User()->id;

        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        $ibcBal = $this->ibcbalance();
        
        if($amount < 5)
        {
            return 5;
        }
        
        //this part ok
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                //Log::Error("amount is---".$amount);
                return 0;
            } 
        // }
        
        //this part ok
        if($ibcBal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET ibc_turnover = ? WHERE user_id = ?",array(0, $userId));
        }

        //check turnover is met or not
        //this part ok
        if($ibcBal > 0 && $db2[0]->ibc_turnover > 0)
        {
            return 3;
        }
        
        $vendorId = "kidetu2709";
        $operatorId = "91w";
        $username = Auth::User()->user_name;
        $vendorMemberId = "91w_1".$username;
        $walletId = 1;
        $transId = "91w_1".mt_rand(100000,999999999);
        $direction = 1; //1=deposit , 0 = withdraw
        
        $url = "http://m4v7api.db5688.com/api/FundTransfer";
        
        $param = "vendor_id=$vendorId&vendor_member_id=$vendorMemberId&wallet_id=$walletId&vendor_trans_id=$transId&amount=$amount&currency=2&direction=$direction";
        
        // return $url.$param;
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
          CURLOPT_POSTFIELDS => $param,
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $res = json_decode($response, true);
        
        $errorId = $res['error_code'];
        
        if($errorId == 0)
        {
            if($isPromo == 1)
            {
                return 1;
            }
                                        
            // sleep(1);

            Helper::transferLog($from, $to, 1, $amount);

            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    private function spadeBal()
    {
        $acctId = Auth::User()->user_name;
        $pageIndex = 1;
        $serialNo = mt_rand(10000,999999999);
        $merchantCode = "91W88";
        
        $param = array(
            'acctId' => $acctId,
            'pageIndex' => $pageIndex,
            'serialNo' => $serialNo,
            'merchantCode' => $merchantCode
        );
                
        $securityKey = "91W88O7kyHYDuLcoAoCFE";
        $digest = json_encode($param, true).$securityKey;
        $digest = md5($digest);
        
        $url = "http://merchantapi.silverkirin88.com/api";
        
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
          CURLOPT_POSTFIELDS => json_encode($param, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
          CURLOPT_HTTPHEADER => array(
            'API: getAcctInfo',
            'Datatype: JSON',
            'Content-Type: application/json',
            'Digest:'.$digest
          )
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response, true);
        
        curl_close($curl);
        
        return $response['list'][0]['balance'];
    }
    
    //done check for new server 05/08/2022
    private function spadedeposit($from, $to, $amount, $isPromo)
    {
        $userId = Auth::User()->id;

        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        $spadeBal = $this->spadeBal();
        
        //this part ok
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                //Log::Error("amount is---".$amount);
                return 0;
            } 
        // }
        
        //this part ok
        if($spadeBal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET spade_turnover = ? WHERE user_id = ?",array(0, $userId));
        }

        //check turnover is met or not
        //this part ok
        if($spadeBal > 0 && $db2[0]->spade_turnover > 0)
        {
            return 3;
        }
        
        $acctId = Auth::User()->user_name;
        $serialNo = mt_rand(10000,999999999);
        $merchantCode = "91W88";
        
        $param = array(
            'acctId' => $acctId,
            'currency' => 'MYR',
            'amount' => $amount,
            'merchantCode' => $merchantCode,
            'serialNo' => $serialNo
        );
    
        $securityKey = "91W88O7kyHYDuLcoAoCFE";
        $digest = json_encode($param, true).$securityKey;
        $digest = md5($digest);
        
        $url = "http://merchantapi.silverkirin88.com/api";
        
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
          CURLOPT_POSTFIELDS => json_encode($param, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
          CURLOPT_HTTPHEADER => array(
            'API: deposit',
            'Datatype: JSON',
            'Content-Type: application/json',
            'Digest: '.$digest
          )
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response, true);
        
        curl_close($curl);
        
        if($response['code'] == 0)
        {
            if($isPromo == 1)
            {
                return 1;
            }
                                        
            // sleep(1);

            Helper::transferLog($from, $to, 1, $amount);

            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
        else
        {
            return 0;
        }
    }
    
    //done check for new server 05/08/2022
    private function spadewithdrawal($amount)
    {
        $userId = Auth::User()->id;

        $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.spade_turnover FROM users as a
                          INNER JOIN users_wallets as b ON a.id = b.user_id
                          INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));
        
        $spadeBal = $this->spadeBal();      
        
        if($amount > $spadeBal)
        {
            return 0;
        }
        
        //check turnover is met or not
        if($amount > 0 && $db[0]->spade_turnover > 0)
        {
            return 3;
        }
        
        $acctId = Auth::User()->user_name;
        $serialNo = mt_rand(10000,999999999);
        $merchantCode = "91W88";
        
        $param = array(
            'acctId' => $acctId,
            'currency' => 'MYR',
            'amount' => $amount,
            'merchantCode' => $merchantCode,
            'serialNo' => $serialNo
        );
        
        $securityKey = "91W88O7kyHYDuLcoAoCFE";
        $digest = json_encode($param, true).$securityKey;
        $digest = md5($digest);
        
        $url = "http://merchantapi.silverkirin88.com/api";
        
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
          CURLOPT_POSTFIELDS => json_encode($param, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
          CURLOPT_HTTPHEADER => array(
            'API: withdraw',
            'Datatype: JSON',
            'Content-Type: application/json',
            'Digest: '.$digest
          )
        ));
        
        $response = curl_exec($curl);
        
        $response = json_decode($response, true);
        
        curl_close($curl);
        
        if($response['code'] == 0)
        {
                                        
            // sleep(1);
            
            Helper::transferLogNew(3, 1, 1, $amount, $this->spadeBal());

            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
    }

    //done check for new server 05/08/2022
    private function microwithdraw($amount)
    {
        $userId = Auth::User()->id;

        $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.micro_turnover FROM users as a
                          INNER JOIN users_wallets as b ON a.id = b.user_id
                          INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));
        
        $microBal = $this->microBalance();      
        
        if($amount > $microBal)
        {
            return 0;
        }
        
        //check turnover is met or not
        if($amount > 0 && $db[0]->micro_turnover > 0)
        {
            return 3;
        }

        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
         
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $referenceid = mt_rand(100000,999999);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/WalletTransactions",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => "playerId=$username&type=Withdraw&amount=$amount&idempotencyKey=$referenceid&externalTransactionId=$referenceid",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        //Log::Error($response);
        
        curl_close($curl);
        
        $res = json_decode($response, true);
        
        $errorId = $res['status'];
        
        if($errorId == 'Succeeded')
        {                             
            // sleep(1);
            
            Helper::transferLogNew(16, 1, 1, $amount, $this->microBalance());

            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
    }

    //done check for new server 05/08/2022
    public function microBalance()
    {
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
        
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/players/$username?properties=balance",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'GET',
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        $getBalance = json_decode($response, true);
        
        return $getBalance['balance']['total'];
    }

    //done check for new server 05/08/2022
    private function createtoken()
    {
        $curl = curl_init();
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'https://sts-m8bettw.k2net.io/connect/token',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => 'grant_type=client_credentials&client_id=91win&client_secret=5098337738364912b906108c11619e',
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/x-www-form-urlencoded'
          ),
        ));
        
        $response = curl_exec($curl);
        
        curl_close($curl);
        
        return $response;
    }

    //done check for new server 05/08/2022
    private function microdeposit($from, $to, $amount, $isPromo)
    {
        $userId = Auth::User()->id;

        $db2 = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
        $mainWalletBal = $db2[0]->balance;
        
        $microBal = $this->microBalance();
        
        //this part ok
        // if($isPromo == 0)
        // {
            if($amount > $mainWalletBal)
            {
                //Log::Error("amount is---".$amount);
                return 0;
            } 
        // }
        
        //this part ok
        if($microBal <= 5)
        {
            DB::UPDATE("UPDATE users_wallets SET micro_turnover = ? WHERE user_id = ?",array(0, $userId));
        }

        //check turnover is met or not
        //this part ok
        if($microBal > 0 && $db2[0]->micro_turnover > 0)
        {
            return 3;
        }
        
        $username = Auth::User()->user_name;
        
        $createToken = $this->createtoken();
         
        $createToken = json_decode($createToken, true);
        
        $token = $createToken['access_token'];
        
        $referenceid = mt_rand(100000,999999);
        
        $curl = curl_init();

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://api-m8bettw.k2net.io/api/v1/agents/91win/WalletTransactions",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS => "playerId=$username&type=Deposit&amount=$amount&idempotencyKey=$referenceid&externalTransactionId=$referenceid",
          CURLOPT_HTTPHEADER => array(
            "Authorization: Bearer $token",
            "Content-Type: application/x-www-form-urlencoded"
          ),
        ));
        
        $response = curl_exec($curl);
        
        //Log::Error($response);
        
        curl_close($curl);
        
        $res = json_decode($response, true);
        
        $errorId = $res['status'];
        
        if($errorId == 'Succeeded')
        {
            if($isPromo == 1)
            {
                return 1;
            }
                                        
            // sleep(1);

            Helper::transferLog($from, $to, 1, $amount);

            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

            return 1;
        }
        else
        {
            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function evoToMain($amount)
    {
        DB::BeginTransaction();
        
        //Log::Error($amount);
        
        try
        {
            $userId = Auth::User()->id;

            $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.evo_turnover FROM users as a
                              INNER JOIN users_wallets as b ON a.id = b.user_id
                              INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));

            $evoBal = $this->evoBalance();
            
            //check if amount is sufficient or not
            if($amount > $evoBal)
            {
                DB::Rollback();

                return 0;
            }

            //check turnover is met or not
            if($amount > 0 && $db[0]->evo_turnover > 0)
            {
                DB::Rollback();

                return 3;
            }
            
            //check if got promotion , then check if turnover is met or not

            //this url will put in env file
            $url = "https://91win999.com/sites/gameApi/public/evoTransferIn";

            $data = array(
                'user_name' => $db[0]->user_name,
                'company_id' => $db[0]->company_id,
                'amount' => $amount
            );

            $curl = curl_init();

            if ($curl === false)
            {
                DB::Rollback();

                return 0;
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
                DB::Rollback();

                return 0;
            }

            curl_close($curl);
                                        
            // sleep(1);

            Helper::transferLogNew(5, 1, 1, $amount, $this->evoBalance());

            //add balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

            DB::Commit();

            return 1;
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            
            return 0;
        }
    }
    
    //find out how to check if success for evo , then only transfer
    //done check for new server 05/08/2022
    private function mainToEvo($from, $to, $amount, $isPromo)
    {
        header('Content-Type: application/xml');
        DB::BeginTransaction();

        try
        {
            $userId = Auth::User()->id;

            $db = DB::SELECT("SELECT a.user_name, c.company_id, b.balance, b.evo_turnover FROM users as a
                              INNER JOIN users_wallets as b ON a.id = b.user_id
                              INNER JOIN users_details as c ON a.id = c.user_id WHERE a.id = ?",array($userId));
            
            // if($isPromo == 0)
            // {
                //insufficient balance
                if($amount > $db[0]->balance)
                {
                    DB::Rollback();

                    return 0;
                }
            // }

            $evoBal = $this->evoBalance();
            
            if($evoBal <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET evo_turnover = ? WHERE user_id = ?",array(0, $userId));
            }
            
            //turnover not met
            if($evoBal > 0 && $db[0]->evo_turnover > 0)
            {
                DB::Rollback();

                return 3;
            }

            //this url will put in env file
            $url = "https://91win999.com/sites/gameApi/public/evoTransferOut";

            $data = array(
                'user_name' => $db[0]->user_name,
                'company_id' => $db[0]->company_id,
                'amount' => $amount
            );

            $curl = curl_init();

            if ($curl === false)
            {
                DB::Rollback();

                return 0;
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

            if ($response === false)
            {
                DB::Rollback();

                return 0;
            }

            curl_close($curl);
            
            if($isPromo == 1)
            {
                return 1;
            }
                                        
            // sleep(1);

            //store transfer logs
            Helper::transferLog($from, $to, 1, $amount);

            //deduct balance
            DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

            DB::Commit();

            return 1;
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function evoBalance()
    {
         //this url will put in env file
         $url = "https://91win999.com/sites/gameApi/public/evoGetBalance";

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

    //done check for new server 05/08/2022
    private function playtechWithdraw($amount)
    {
        DB::BeginTransaction();

        try
        {
            $url = "https://91win999.com/sites/gameApi/public/playtech/withdraw";

            $userId = Auth::User()->id;

            //get balance from users_wallets table
            $playtechBal = $this->playtechGetBalance2();
            
            if($amount > $playtechBal)
            {
                DB::Rollback();

                return 0;
            }
            
            $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            
            //check turnover is met or not
            if($playtechBal > 0 && $db[0]->playtech_turnover > 0)
            {
                DB::Rollback();

                return 3;
            }

            $data = array(
                'user_name' => Auth::User()->user_name,
                'amount' => $amount
            );

            $curl = curl_init();

            if ($curl === false)
            {
                DB::Rollback();

                return 0;
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

            if ($response === false)
            {
                DB::Rollback();

                return 0;
                //throw new Exception(curl_error($curl), curl_errno($curl));
            }

            curl_close($curl);

            $arrayCount = Count(json_decode($response, true));

            if($arrayCount == 2)
            {
                DB::Rollback(); 

                return 0;
            }
            else
            {
                                            
                // sleep(1);
            
                //store transfer logs
                Helper::transferLogNew(8, 1, 1, $amount, $this->playtechGetBalance2());
                
                //add balance
                DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

                DB::Commit();

                return 1;
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }
    
    //need to monitor this checking
    //done check for new server 05/08/2022
    public function playtechDeposit($from, $to, $amount, $isPromo)
    {
        DB::BeginTransaction();
        
        try
        {
            //this url will put in env file
            $url = "https://91win999.com/sites/gameApi/public/playtech/deposit";
            $userId = Auth::User()->id;
    
            //get balance from users_wallets table
            $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            
            // if($isPromo == 0)
            // {
                if($amount > $db[0]->balance)
                {
                    DB::Rollback();
                
                    return 0;
                }
            // }
    
            $playtechBal = $this->playtechGetBalance2();
            
            if($playtechBal <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET playtech_turnover = ? WHERE user_id = ?",array(0, $userId));
            }
            
            if($playtechBal > 0 && $db[0]->playtech_turnover > 0)
            {
                DB::Rollback();
                
                return 3;
            }
    
            $data = array(
                 'user_name' => Auth::User()->user_name,
                 'amount' => $amount
            );
    
            $curl = curl_init();
    
            if ($curl === false)
            {
                DB::Rollback();
                
                return 0;
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
            
            Log::Error($response);
    
            if ($response === false)
            {
                DB::Rollback();
                
                return 0;
            }
    
            curl_close($curl);
    
            $arrayCount = Count(json_decode($response, true));
    
            if($arrayCount == 2)
            {
                DB::Rollback();
                
                return 0;
            }
            else
            {
                if($isPromo == 1)
                {
                    return 1;
                }
                                            
                // sleep(1);
                //store transfer logs
                Helper::transferLog($from, $to, 1, $amount);
    
                //deduct balance
                DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));
                
                DB::Commit();
    
                return 1;
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();
            
            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function playtechGetBalance2()
    {
         //this url will put in env file
         $url = "https://91win999.com/sites/gameApi/public/playtech/getbalance";

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

         //echo $response->getAttribute( 'href' );

         $res = json_decode($response, true);

         $balance = $res['result']['balance'];

         return $balance;
    }

    //done check for new server 05/08/2022
    private function mainToJoker($from, $to, $amount, $isPromo)
    {
        DB::BeginTransaction();
        try
        {
            $url = "https://91win999.com/sites/gameApi/public/jokerTransferCreditToJoker";
            $userId = Auth::User()->id;
    
            //get balance from users_wallets table
            $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            
            // if($isPromo == 0)
            // {
                if($amount > $db[0]->balance)
                {
                    DB::Rollback();

                    return 0;
                }
            // }
            
            $jokerBal = $this->getJokerBalance2();
                    
            if($jokerBal <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET joker_turnover = ? WHERE user_id = ?",array(0, $userId));
            }
            
            if($jokerBal > 0 && $db[0]->joker_turnover > 0)
            {
                DB::Rollback();

                return 3;
            }
    
            $data = array(
                 'user_name' => Auth::User()->user_name,
                 'amount' => $amount
            );
    
            $curl = curl_init();
    
            if ($curl === false)
            {
                DB::Rollback();

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
    
            if($response == 'Success')
            {                
                if($isPromo == 1)
                {
                    return 1;
                }
                                            
                // sleep(1);
                //store transfer logs
                Helper::transferLog($from, $to, 1, $amount);
    
                //deduct balance
                DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

                DB::Commit();
    
                return 1;
            }
            else
            {
                DB::Rollback();
                
                return 0;
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function jokerToMain($amount)
    {
        DB::BeginTransaction();

        try
        {
            //this url will put in env file
            $url = "https://91win999.com/sites/gameApi/public/jokerTransferCreditOutJoker";

            $userId = Auth::User()->id;

            //get balance from users_wallets table
            $jokerBal = $this->getJokerBalance2();
            
            if($amount > $jokerBal)
            {
                DB::Rollback();

                return 0;
            }

            //no need check all
            $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            
            //check turnover is met or not
            if($jokerBal > 0 && $db[0]->joker_turnover > 0)
            {
                DB::Rollback();

                return 3;
            }

            $data = array(
                'user_name' => Auth::User()->user_name,
                'amount' => $amount
            );

            $curl = curl_init();

            if ($curl === false)
            {
                DB::Rollback();

                return 0;
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
            
            curl_close($curl);

            if($response == 'Success')
            {                                            
                // sleep(1);
                
                Helper::transferLogNew(6, 1, 1, $amount, $this->getJokerBalance2());
                
                //add balance
                DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

                DB::Commit();

                return 1;
            }
            else
            {
                DB::Rollback();

                return 0;
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function getJokerBalance2()
    {
        //create member 1st ?
        $this->launchJokerTransferGame2('cuarr8e1ncebn');
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/jokerGetUserCredit";

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

        return $response;
    }

    //done check for new server 05/08/2022
    private function launchJokerTransferGame2($gameCode)
    {
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
    }

    //MEGA888
    //done check for new server 05/08/2022
    private function transferToMega($from, $to, $amount, $isPromo)
    {
        DB::BeginTransaction();

        try
        {
            $userId = Auth::User()->id;

            $db = DB::SELECT("SELECT a.user_name, a.mega_login_id, a.mega_password, b.balance, b.mega_min_withdraw FROM users as a
                               INNER JOIN users_wallets as b ON a.id = b.user_id WHERE a.id = ?",array($userId));

            $megaLoginId = $db[0]->mega_login_id;

            $megaBal = $this->getMegaBalance($megaLoginId);
            
            // if($isPromo == 0)
            // {
                if($amount > $db[0]->balance)
                {
                    DB::Rollback();

                    return 0;
                }
            // }

            //this is to reset the mega minimum amount withdraw 
            if($megaBal <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET mega_min_withdraw = ? WHERE user_id = ?",array(0, $userId));
            }

            //check min withdrawal is met or not
            if($megaBal < $db[0]->mega_min_withdraw)
            {
                DB::Rollback();

                return 4;
            }

            $url = "https://91win999.com/sites/gameApi/public/transferBalanceMega888_test";

            $data = array(
                'mega_login_id' => $megaLoginId,
                'amount' => $amount
            );

            $curl = curl_init();

            if ($curl === false)
            {
                DB::Rollback();

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
                DB::Rollback();

                return 0;
            }

            curl_close($curl);

            $data = json_decode($response, true);

            $resErr = $data['error'];

            //need to make sure that the error is really null
            if($resErr == null)
            {
                if($isPromo == 1)
                {
                    return 1;
                }
                                            
                // sleep(1);
                //store transfer logs
                Helper::transferLog($from, $to, 1, $amount);

                //deduct balance
                DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

                DB::Commit();

                return 1;
            }
            else
            {
                DB::Rollback();

                return 0;
            }
         }
         catch(\Exception $ex)
         {
            DB::Rollback();
            
            return 0;
         }
     }
     
    //done check for new server 05/08/2022
    private function megaToMainWallet($amount)
    {
        //check mega is on maintenance or not
        //then disable this function
        DB::BeginTransaction();
        
        //Log::Error('test');
        
        try
        {
             //check if this thing is maintenance , then cannot perform this action at all
            $userId = Auth::User()->id;

            $db = DB::SELECT("SELECT a.user_name, a.mega_login_id, a.mega_password, b.balance, b.mega_min_withdraw FROM users as a
                              INNER JOIN users_wallets as b ON a.id = b.user_id WHERE a.id = ?",array($userId));

            $megaLoginId = $db[0]->mega_login_id;
            $megaBal = $this->getMegaBalance($megaLoginId);
            //$data = json_decode($megaBalance, true);
            //$megaBal = $data['result'];
            
            if($amount > $megaBal)
            {
                DB::Rollback();
                
                return 0;
            }

            //check turnover is met or not
            if($megaBal < $db[0]->mega_min_withdraw)
            {
                DB::Rollback();
                
                return 4;
            }

            //this url will put in env file
            $url = "https://91win999.com/sites/gameApi/public/transferBalanceMega888_test";

            $data = array(
                 'mega_login_id' => $megaLoginId,
                 'amount' => $amount*-1
            );

            $curl = curl_init();

            if ($curl === false)
            {
                DB::Rollback();
                
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
                DB::Rollback();
                
                return 0;
            }

            curl_close($curl);

            $data = json_decode($response, true);

            $errorRes = $data['error'];

            if($errorRes == null)
            {
                // sleep(1);
                
                Helper::transferLogNew(7, 1, 1, $amount, $this->getMegaBalance($megaLoginId));
                
                //add balance
                DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));

                DB::Commit();

                return 1;
            }
            else
            {
                DB::Rollback();

                return 0;
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function getMegaBalance($megaLoginId)
    {
        $curl = curl_init();
        $url = 'http://mpleti.tjzhmhs.com/mega-cloud/api/';

        $sn = 'ld00';
        $agentLoginId = 'Mega1-1639';
        $random = rand();
        $secretCode = '7fygKdIAIq3tAwDcqjB+0VtvxcE=';

        $array = array(
            'id' => $random,
            'method' => 'open.mega.balance.get',
            'params' => array(
                'random' => $random,
                'digest' => md5($random.$sn.$megaLoginId.$secretCode),
                'sn' => $sn,
                'loginId' => $megaLoginId,
            ),
            'jsonrpc' => '2.0'
        );
        
        curl_setopt_array($curl, array(
          CURLOPT_URL => 'http://mpleti.tjzhmhs.com/mega-cloud/api/',
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => '',
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 0,
          CURLOPT_FOLLOWLOCATION => true,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => 'POST',
          CURLOPT_POSTFIELDS =>json_encode($array, true),
          CURLOPT_HTTPHEADER => array(
            'Content-Type: application/json'
          ),
        ));

        $response = curl_exec($curl);
        
        $data = json_decode($response, true);
        
        //Log::Error($data);

        curl_close($curl);
        
        return $data['result'];
    }

    //4D
    //done check for new server 05/08/2022
    public function fourDeeDeposit($from, $to, $amount, $isPromo)
    {
        DB::BeginTransaction();

        try
        {
            $userId = Auth::User()->id;

            //get balance from users_wallets table
            $db = DB::SELECT("SELECT * FROM users_wallets WHERE user_id = ?",array($userId));
            
            if($amount > $db[0]->balance)
            {
                DB::Rollback();

                return 0;
            }
            
            $fourDeeBal = $this->fourDeebalance2();
            
            if($fourDeeBal <= 5)
            {
                DB::UPDATE("UPDATE users_wallets SET fourdee_turnover = ? WHERE user_id = ?",array(0, $userId));
            }
            
            if($fourDeeBal > 0 && $db[0]->fourdee_turnover > 0)
            {
                DB::Rollback();

                return 3;
            }     
            
            $username4d = Auth::User()->user_name;
                                    
            $db2019 = DB::SELECT("SELECT fourdee_username , created_at FROM users WHERE user_name = ?",array($username4d));
            
            if($db2019[0]->created_at > '2023-04-05 00:00:00')
            {
                $username4d = $db2019[0]->fourdee_username;
            }
            
            $response = helperFourdee::fourDeeDeposit($username4d, $amount);
            
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
    
            if($array['errorCode'] == 0)
            {
                if($isPromo == 1)
                {
                    DB::Rollback();

                    return 1;
                }
                                            
                // sleep(1);
                
                //store transfer logs
                Helper::transferLog($from, $to, 1, $amount);
    
                DB::UPDATE("UPDATE users_wallets SET balance = balance - ? WHERE user_id = ?",array($amount, $userId));

                DB::Commit();
    
                return 1;
            }
            else
            {
                DB::Rollback();

                return 0;
            }
        }
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }

    //done check for new server 05/08/2022
    public function fourDeeWithdraw($amount)
    {
        DB::BeginTransaction();

        try
        {
            $userId = Auth::User()->id;

            //get balance from users_wallets table
            $fourDeeBal = $this->fourDeebalance2();

            if(number_format($amount, 2) > $fourDeeBal)
            {
                DB::Rollback();
                
                Log::Error("tak chukop balance boh");
    
                return 0;
            }
            
            $username4d = Auth::User()->user_name;
                            
            $db2019 = DB::SELECT("SELECT fourdee_username , created_at FROM users WHERE user_name = ?",array($username4d));
            
            if($db2019[0]->created_at > '2023-04-05 00:00:00')
            {
                $username4d = $db2019[0]->fourdee_username;
            }
    
            $response = helperFourdee::fourdeewithdraw($username4d, $amount);
    
            //check errorCode
            $xml = simplexml_load_string($response);
            $json = json_encode($xml);
            $array = json_decode($json,TRUE);
    
            if($array['errorCode'] == 0)
            {
                // sleep(1);
                
                Helper::transferLogNew(10, 1, 1, $amount, $this->fourDeebalance2());
                
                //add balance
                DB::UPDATE("UPDATE users_wallets SET balance = balance + ? WHERE user_id = ?",array($amount, $userId));
    
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
        catch(\Exception $ex)
        {
            DB::Rollback();

            return 0;
        }
    }

    //done check for new server 05/08/2022
    private function fourDeebalance2()
    {
        $username4d = Auth::User()->user_name;
                                    
        $db2019 = DB::SELECT("SELECT fourdee_username , created_at FROM users WHERE user_name = ?",array($username4d));
        
        if($db2019[0]->created_at > '2023-04-05 00:00:00')
        {
            $username4d = $db2019[0]->fourdee_username;
        }
            
        $response = helperFourdee::fourDeeGetProfile($username4d);    
        
        return $response;
    }

}
