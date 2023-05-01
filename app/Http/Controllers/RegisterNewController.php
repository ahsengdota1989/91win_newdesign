<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Helper;
use App\Transaction;
use Facades;
use Session;
use Redirect;
use Nexmo;
use Log;
use Auth;


class RegisterNewController extends Controller
{
        //register validations :: 27/02/2023 11:57am :: glen ah seng dota 2 very pro
    public function checkphoneregister(request $request)
    {
        $phoneNo = $request->phone_number;
        
        //check phone number already exist or not
        $checkPhoneNumber = DB::SELECT("SELECT phone_number FROM users WHERE phone_number = ?",array($phoneNo));
        if(Count($checkPhoneNumber) > 0)
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone Number already exist'
            );
            
            return json_encode($response, true);
        }
                
        if($phoneNo == '')
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone number cannot be empty'
            );
            
            return json_encode($response, true);
        }
        
        if($phoneNo[0] != 0)
        {
            $response = array(
                'status' => 1,
                'message' => 'First digit of phone number is invalid'
            );
            
            return json_encode($response, true);
        }
        
        if($phoneNo[1] != 1)
        {
            $response = array(
                'status' => 1,
                'message' => '2nd digit of phone number is invalid'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($phoneNo) < 9)
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone number must be more than 9 digits'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($phoneNo) > 11)
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone number cannot be more than 11 digits'
            );
            
            return json_encode($response, true);
        }
        
        $response = array(
            'status' => 0,
            'message' => 'approved'
        );
        
        return json_encode($response, true);
    }
    
    public function checkusernameregister(request $request)
    {
        $userName = $request->user_name;
        
        //check if email address, username , company id is already exist or not
        $usersTBL = DB::select("SELECT * FROM users as a INNER JOIN users_details as b ON a.id = b.user_id
                    WHERE a.user_name = ? AND b.company_id = ?",
                    array($userName, 1));
        
        //USERNAME VALIDATIONS
        if($userName == '')
        {
            $response = array(
                'status' => 1,
                'message' => 'User name cannot be empty'
            );
            
            return json_encode($response, true);
        }
        
        if(Count($usersTBL) == 1)
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($userName) < 6)
        {
            $response = array(
                'status' => 1,
                'message' => 'Username must be more than 7 characters'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($userName) > 11)
        {
            $response = array(
                'status' => 1,
                'message' => 'Username cannot be more than 11 characters'
            );
            
            return json_encode($response, true);
        }
        
        if(is_numeric($userName))
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        if(is_numeric($userName[0]))
        {
            $response = array(
                'status' => 1,
                'message' => 'Username first character cannot be a number'
            );
            
            return json_encode($response, true);
        }
        
        if ($userName == trim($userName) && strpos($userName, ' ') !== false)
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $userName))
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        $response = array(
            'status' => 0,
            'message' => 'approved'
        );
        
        return json_encode($response, true);
    }
    
    public function checkemailregister(request $request)
    {
        $email = $request->email;
        
        //check if email address, username , company id is already exist or not
        $usersTBL = DB::select("SELECT email FROM users WHERE email = ?",array($email));
        
        if(Count($usersTBL) == 1)
        {
            $response = array(
                'status' => 1,
                'message' => 'Email already exist'
            );
            
            return json_encode($response, true);
        }
        
        $response = array(
            'status' => 0,
            'message' => 'approved'
        );
        
        return json_encode($response, true);
    }
    
    public function checknameregister(request $request)
    {
        $fullName = $request->full_name;
        
        //FULL NAME VALIDATIONS
        if($fullName == '')
        {
            $response = array(
                'status' => 1,
                'message' => 'Name cannot be empty'
            );
            
            return json_encode($response, true);
        }
                        
        $isThereNumber = false;
        for ($i = 0; $i < strlen($fullName); $i++) {
            if ( ctype_digit($fullName[$i]) ) {
                $isThereNumber = true;
                break;
            }
        }
        
        if($isThereNumber)
        {
            $response = array(
                'status' => 1,
                'message' => 'Full name cannot contain numbers/special characters'
            );
            
            return json_encode($response, true);
        }
                
        $response = array(
            'status' => 0,
            'message' => 'approved'
        );
        
        return json_encode($response, true);
    }
    
    public function checkpasswordregister(request $request)
    {
        $password = $request->password;
        $cpassword = $request->cpassword;
        
        if($password != $cpassword)
        {
            $response = array(
                'status' => 1,
                'message' => 'Please check your password'
            );
            
            return json_encode($response, true);
        }
                
        $response = array(
            'status' => 0,
            'message' => 'approved'
        );
        
        return json_encode($response, true);
    }
    
    private function getIp()
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
    
    private function getCode($phoneNumber)
    {
        $phoneNo = $phoneNumber;
        $code = mt_rand(100000,999999);
        $currDate = date("Y-m-d H:i:s");
        
        if($phoneNo == '')
        {
            $array = array(
                'status' => 1,
                'message' => "Please enter phone number"
            );
            
            return json_encode($array , true);
        }
        
        //check if number already exist or not
        $db = DB::SELECT("SELECT phone_number FROM users WHERE phone_number = ?",array($phoneNo));
        if(Count($db) > 0)
        {
            $array = array(
                'status' => 1,
                'message' => "Phone number already exist"
            );
            
            return json_encode($array , true);
        }

        //send text messages to the phone number
        // Helper::sendMessage($phoneNo, $code);
        // Helper::sendMessageTwo($phoneNo, $code);
        // Helper::sendMessageThree($phoneNo, $code);
        Helper::sendMessageFour($phoneNo, $code);
        
        //verfication code part
        DB::INSERT("INSERT INTO verification_code (code , phone_number, status, created_at)
            VALUES (?,?,?,?)",array($code, $phoneNo, 1, $currDate));
    }
    
    private function verifyRegisterProcess($phoneNo, $code)
    {
        if($code == '')
        {
            //please return the code
            return 2;
        }
        
        //$db = DB::SELECT("SELECT code, phone_number FROM verification_code WHERE code = ? AND phone_number = ? ORDER BY id DESC",array($code, $phoneNo));
        $db = DB::SELECT("SELECT code, phone_number FROM verification_code WHERE code = ?",array($code));

        if(Count($db) == 0)
        {
            //invalid code
            return 1;
        }
        else
        {
            //success
            return 0;
        }
    }

    public function forgotpassword()
    {
        return view('auth.forgotpassword');
    }

    public function resetPassword(request $request)
    {
        $phoneNo = $request->phone_number;

        if($phoneNo == '')
        {
            $array = array(
                'status' => 1,
                'message' => 'Please fill in your phone number!'
            );

            return json_encode($array, true);
        }

        $resetPass = mt_rand(100000,999999);

        DB::UPDATE('UPDATE users SET password = ? WHERE phone_number = ?',array(Hash::make($resetPass), $phoneNo));

        //send message to phone number
        Helper::sendMessageForgot($phoneNo, $resetPass);
        Helper::sendMessageForgotTwo($phoneNo, $resetPass);

        $array = array(
            'status' => 0,
            'message' => 'Your password has been reset. Please check your SMS for the reset password'
        );

        return json_encode($array, true);
    }
    
    public function hideregisterform(request $request)
    {
        $userName = strtolower($request->user_name);
        $userName = str_replace(' ', '', $userName);
        $phoneNo = $request->phone_number;
        $password = $request->password;
        $password2 = $request->password2;
        $fullName = $request->full_name;
        $email = $request->email;
        $refId = strtolower($request->ref_id);
        $companyId = env('COMPANY_ID', '1');
        $ipAdd = $this->getIp();
         
        //check if email address, username , company id is already exist or not
        $usersTBL = DB::select("SELECT * FROM users as a INNER JOIN users_details as b ON a.id = b.user_id
                    WHERE a.user_name = ? AND b.company_id = ?",
                    array($userName, $companyId));
        
        //USERNAME VALIDATIONS
        if($userName == '')
        {
            $response = array(
                'status' => 1,
                'message' => 'User name cannot be empty'
            );
            
            return json_encode($response, true);
        }
        
        if(Count($usersTBL) == 1)
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($userName) < 6)
        {
            $response = array(
                'status' => 1,
                'message' => 'Username must be more than 7 characters'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($userName) > 11)
        {
            $response = array(
                'status' => 1,
                'message' => 'Username cannot be more than 11 characters'
            );
            
            return json_encode($response, true);
        }
        
        if(is_numeric($userName))
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        if(is_numeric($userName[0]))
        {
            $response = array(
                'status' => 1,
                'message' => 'Username first character cannot be a number'
            );
            
            return json_encode($response, true);
        }
        
        if ($userName == trim($userName) && strpos($userName, ' ') !== false)
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        if (preg_match('/[\'^£$%&*()}{@#~?><>,|=_+¬-]/', $userName))
        {
            $response = array(
                'status' => 1,
                'message' => 'Invalid username'
            );
            
            return json_encode($response, true);
        }
        
        if($phoneNo == '')
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone number cannot be empty'
            );
            
            return json_encode($response, true);
        }
        
        if($phoneNo[0] != 0)
        {
            $response = array(
                'status' => 1,
                'message' => 'First digit of phone number is invalid'
            );
            
            return json_encode($response, true);
        }
        
        if($phoneNo[1] != 1)
        {
            $response = array(
                'status' => 1,
                'message' => '2nd digit of phone number is invalid'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($phoneNo) < 9)
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone number must be more than 9 digits'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($phoneNo) > 11)
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone number cannot be more than 11 digits'
            );
            
            return json_encode($response, true);
        }
        
                
        //check phone number already exist or not
        $checkPhoneNumber = DB::SELECT("SELECT phone_number FROM users WHERE phone_number = ?",array($phoneNo));
        if(Count($checkPhoneNumber) > 0)
        {
            $response = array(
                'status' => 1,
                'message' => 'Phone Number already exist'
            );
            
            return json_encode($response, true);
        }
        
        //PASSWORD VALIDATIONS
        if($password == '')
        {
            $response = array(
                'status' => 1,
                'message' => 'Password cannot be empty'
            );
            
            return json_encode($response, true);
        }
        
        if(strlen($password) < 8)
        {
            $response = array(
                'status' => 1,
                'message' => 'Password must be more than 8 characters'
            );
            
            return json_encode($response, true);
        }
        
        if($password != $password2)
        {
            $response = array(
                'status' => 1,
                'message' => 'Password and confirm password is not the same'
            );
            
            return json_encode($response, true);
        }
        
        //FULL NAME VALIDATIONS
        if($fullName == '')
        {
            $response = array(
                'status' => 1,
                'message' => 'Name cannot be empty'
            );
            
            return json_encode($response, true);
        }
        
        $isThereNumber = false;
        for ($i = 0; $i < strlen($fullName); $i++) {
            if ( ctype_digit($fullName[$i]) ) {
                $isThereNumber = true;
                break;
            }
        }
        
        if($isThereNumber)
        {
            $response = array(
                'status' => 1,
                'message' => 'Full name cannot contain numbers/special characters'
            );
            
            return json_encode($response, true);
        }
        
        //REF ID VALIDATIONS
        if($refId == '')
        {
            //something here
        }
        else
        {
            $db10 = DB::SELECT("SELECT a.user_name, b.agent FROM users as a inner join users_details as b on a.id = b.user_id WHERE a.user_name = ?",array($refId));

            if(Count($db10) == 0)
            {
                DB::Rollback();

                $response = array(
                    'status' => 1,
                    'message' => 'Invalid referral ID'
                );

                return json_encode($response, true);
            }
        }
        
        //get sms code
        $this->getCode($phoneNo);

        $response = array(
            'status' => 0,
            'message' => 'Validation successful!'
        );

        return json_encode($response, true);
    }

    public function newRegisterProcess(request $request)
    {
        DB::BeginTransaction();
        // try
        // {
            $userName = strtolower($request->user_name);
            $userName = str_replace(' ', '', $userName);
            $phoneNo = $request->phone_number;
            $password = $request->password;
            $password2 = $request->password2;
            $fullName = $request->full_name;
            $email = $request->email;
            $refId = strtolower($request->ref_id);
            $companyId = env('COMPANY_ID', '1');
            $code = $request->otp;
            $ipAdd = $this->getIp();
            
            Log::Error($code);
            
            //verify code starts here
            $verify = $this->verifyRegisterProcess($phoneNo, $code);
            
            if($verify == 1)
            {
                DB::Rollback();
                
                $response = array(
                    'status' => 1,
                    'message' => 'Invalid OTP code'
                );
                
                return json_encode($response, true);
            }
            
            if($verify == 2)
            {
                DB::Rollback();
                
                $response = array(
                    'status' => 1,
                    'message' => 'Please enter OTP code'
                );
                
                return json_encode($response, true);
            }

            //REF ID VALIDATIONS
            if($refId == '')
            {
                $agentCodeee = "";
            }
            else
            {
                $db10 = DB::SELECT("SELECT a.user_name, b.agent FROM users as a inner join users_details as b on a.id = b.user_id WHERE a.user_name = ?",array($refId));

                $agentCodeee = $db10[0]->agent;
            }
            
            //get fourdee username and change the status to 1
            $getusernameTwo = DB::SELECT("SELECT user_name FROM usernames WHERE status = ? LIMIT 1",array(0));
            $userNameTwo = $getusernameTwo[0]->user_name;
    
            $megaPassRand = mt_rand(1000,9999);
            $countryCode = env('COUNTRY_CODE', '0');
    
            $user = User::create([
                'name' => $fullName,
                'user_name' => $userName,
                'email' => $email,
                'password' => Hash::make($password),
                'country_code' => $countryCode,
                'phone_number' => $phoneNo,
                'mega_password' => $userName.$megaPassRand,
                'fourdee_username' => $userNameTwo
            ]);
    
            $userId = $user->id;
            $currDate = date("Y-m-d H:i:s");
    
            //status 1=active , 2=inactive
            DB::INSERT('INSERT INTO users_details (user_id, company_id, referral_id,
                  last_login, last_ip_address, status, minimum_bet, maximum_bet, created_at, member_batch , agent)
                  VALUES (?,?,?,?,?,?,?,?,?,?,?)',
                  array(
                        $userId
                      , $companyId
                      , $refId
                      , $currDate
                      , $ipAdd
                      , 1
                      , 1000
                      , 100000
                      , $currDate
                      , 1
                      , $agentCodeee
            ));
            
            DB::UPDATE("UPDATE usernames SET status = ? WHERE user_name = ?",array(1, $userNameTwo));
            
            DB::INSERT('INSERT INTO users_wallets (user_id, balance, currency, created_at) VALUES (?,?,?,?)', array($userId, 0, 1, $currDate));
    
            DB::Commit();
            
            Auth::login($user);
    
            $response = array(
                'status' => 0,
                'message' => 'Register successful!'
            );
    
            return json_encode($response, true);
        // }
        // catch(\Exception $ex)
        // {
        //     DB::Rollback();
            
        //     $response = array(
        //         'status' => 1,
        //         'message' => 'Failed. Please contact our customer service for assistance'
        //     );
            
        //     return json_encode($response, true);
        // }
    }

    public function checkLoginStatus(request $request)
    {
        $phoneNo = $request->phone_number;

        $db = DB::SELECT("SELECT b.status FROM users as a
                INNER JOIN users_details as b ON a.id = b.user_id
                WHERE a.phone_number = ?",array($phoneNo));

        if(Count($db) == 1)
        {
            if($db[0]->status == 2)
            {
                //not verified
                return 0;
            }
            else
            {
                //verified
                return 1;
            }
        }
        else
        {
            //not exist
            return 2;
        }
    }
    
    public function checkLoginPassword(request $request)
    {
        $password = $request->password;
        $userName = $request->user_name;
        $countryCode = env('COUNTRY_CODE', '1');

        //check phone number first
        $db = DB::SELECT("SELECT a.id, a.country_code, b.status,a.password FROM users as a
                  INNER JOIN users_details as b ON a.id = b.user_id
                  WHERE a.user_name = ?",array($userName));

        if(Count($db) == 1)
        {
            //check country code
            if($db[0]->country_code != $countryCode)
            {
                $array = array(
                    'status' => 1,
                    'message' => 'Login failed. Please change website country'
                );

                return json_encode($array, true);
            }
            
            if($db[0]->status == 2)
            {
                $array = array(
                    'status' => 1,
                    'message' => 'Phone number is not verified'
                );

                return json_encode($array, true);
            }
            else
            {
                if(Hash::check($password, $db[0]->password))
                {
                    $array = array(
                        'status' => 0,
                        'message' => 'Logged in!'
                    );
                      
                    Auth::loginUsingId($db[0]->id);
                    // Auth::login($db);

                    return json_encode($array, true);
                }
                else
                {
                    $array = array(
                        'status' => 1,
                        'message' => 'Incorrect password'
                    );

                    return json_encode($array, true);
                }
            }
        }
        else
        {
            $array = array(
                'status' => 1,
                'message' => 'Invalid username'
            );

            return json_encode($array, true);
        }
    }

    public function checkReferralId(request $request)
    {
        $ref = $request->referral_id;

        $db = DB::SELECT("SELECT user_name FROM users WHERE user_name = ?",array($ref));

        if(Count($db) == 0)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function checkPassword(request $request)
    {
        $password = $request->password;

        if($password == '')
        {
            return 1;
        }
        else if(strlen($password) < 8)
        {
            return 1;
        }
        else
        {
            return 0;
        }
    }

    public function checkPhoneNo(request $request)
    {
        $phoneNo = $request->phone_number;

        $db = DB::SELECT("SELECT * FROM users WHERE phone_number = ?",array($phoneNo));

        if(Count($db) == 1)
        {
            return 1;
        }
        else
        {
            if($phoneNo == '')
            {
                return 1;
            }
            else if($phoneNo[0] != 0)
            {
                return 1;
            }
            else if($phoneNo[1] != 1)
            {
                return 1;
            }
            else if(strlen($phoneNo) < 9)
            {
                return 1;
            }
            else if(strlen($phoneNo) > 11)
            {
                return 1;
            }
            else
            {
                return 0;
            }
        }
    }
}
