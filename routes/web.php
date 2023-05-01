<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'welcome']);
// Route::get('/', 'WelcomeController@welcome')->name('welcome');
// Route::get('/welcome2', 'WelcomeController@welcome2');
// Route::get('/welcome3', 'WelcomeController@welcome3');
// Route::get('/login', 'Auth\AuthController@showLoginForm');
// Route::get('/terms', 'WelcomeController@terms');
// Route::get('/faq', 'WelcomeController@faq');
// // Route::get('/tutorial', 'WelcomeController@tutorial');
// Route::get('/vip', 'WelcomeController@vip');
// Route::get('/contact-us', 'WelcomeController@help');
// Route::get('/about', 'WelcomeController@about');
// Route::get('/blog', 'WelcomeController@bloglisting');
// Route::get('/blog/best-4-online-casino-in-malaysia', 'WelcomeController@best_4_online_casino_in_malaysia');
// Route::get('/blog/top-3-casino-game-provider-in-malaysia', 'WelcomeController@top_3_casino_game_provider_in_malaysia');
// // Route::get('/best-7-online-casino-in-malaysia', 'WelcomeController@blog');
// Route::get('/responsible', 'WelcomeController@responsible');

// Route::get('/', function () {
//     return view('welcome');
// });

// Route::get('sendSMS', [App\Http\Controllers\TwilioSMSController::class, 'index']);

//login
Route::post('/checkLoginStatus', [App\Http\Controllers\RegisterNewController::class, 'checkLoginStatus']);
Route::post('/checkLoginPassword', [App\Http\Controllers\RegisterNewController::class, 'checkLoginPassword']);

//new register process
Route::post('/newRegisterProcess', [App\Http\Controllers\RegisterNewController::class, 'newRegisterProcess']);
Route::post('/hideregisterform', [App\Http\Controllers\RegisterNewController::class, 'hideregisterform']);
// Route::post('/newRegisterProcess', 'RegisterNewController@newRegisterProcess')->name('newRegisterProcess');
// Route::post('/verifyRegisterProcess', 'RegisterNewController@verifyRegisterProcess');
// Route::get('/verifyregister/{phoneNumber}', 'RegisterNewController@verifyregister');
// Route::get('/send', 'RegisterNewController@send');
// Route::get('/forgotpassword', 'RegisterNewController@forgotpassword');
// Route::post('/resetPassword', 'RegisterNewController@resetPassword');
// Route::post('/getCode', 'RegisterNewController@getCode');

//register validation
Route::post('/checkReferralId', [App\Http\Controllers\RegisterNewController::class, 'checkReferralId']);
Route::post('/checkphoneregister', [App\Http\Controllers\RegisterNewController::class, 'checkphoneregister']);
Route::post('/checkusernameregister', [App\Http\Controllers\RegisterNewController::class, 'checkusernameregister']);
Route::post('/checknameregister', [App\Http\Controllers\RegisterNewController::class, 'checknameregister']);
Route::post('/checkpasswordregister', [App\Http\Controllers\RegisterNewController::class, 'checkpasswordregister']);
Route::post('/checkemailregister', [App\Http\Controllers\RegisterNewController::class, 'checkemailregister']);


Route::get('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//games
Route::get('/live-casino', [App\Http\Controllers\HomeController::class, 'livecasino']);
Route::get('/slots', [App\Http\Controllers\HomeController::class, 'slots']);
Route::get('/sports', [App\Http\Controllers\HomeController::class, 'sports']);
Route::get('/fishing', [App\Http\Controllers\HomeController::class, 'fishing']);
Route::get('/fourdee', [App\Http\Controllers\HomeController::class, 'fourdee']);
Route::get('/promotions', [App\Http\Controllers\HomeController::class, 'promotions']);
Route::get('/tutorials', [App\Http\Controllers\HomeController::class, 'tutorials']);
Route::get('/profile', [App\Http\Controllers\HomeController::class, 'profile']);

//payment function starts here
Route::get('/payments', [App\Http\Controllers\PaymentController::class, 'payment']);
Route::get('/deposit', [App\Http\Controllers\PaymentController::class, 'deposit']);
Route::get('/withdraw', [App\Http\Controllers\PaymentController::class, 'withdraw']);
Route::get('/history', [App\Http\Controllers\PaymentController::class, 'history']);
Route::get('/referral', [App\Http\Controllers\PaymentController::class, 'referral']);

//tranfer process
Route::post('/transferGameProcess', [App\Http\Controllers\TransferController::class, 'transferGameProcess']);

//withdrawal process
Route::post('/withdrawalProcess', [App\Http\Controllers\WithdrawalController::class, 'withdrawalProcess']);
Route::post('/addNewBank', [App\Http\Controllers\WithdrawalController::class, 'addNewBank']);

Route::post('/depositProcess', [App\Http\Controllers\PaymentController::class, 'depositProcess']);


//***********************************
//	SUREPAY
//***********************************
Route::post('/pgdeposit', [App\Http\Controllers\Sun2PayController::class, 'deposit']);
Route::get('/testsurepay', [App\Http\Controllers\SurepayController::class, 'testsurepay']);
Route::get('/tng', [App\Http\Controllers\SurepayController::class, 'tng']);
Route::get('/duitnow', [App\Http\Controllers\SurepayController::class, 'duitnow']);

//***********************************
//	FPAY
//***********************************
// Route::get('/auth', 'FpayController@auth');
// Route::get('/generateOrder', 'FpayController@generateOrder');
Route::post('/submitFpay', [App\Http\Controllers\FpayController::class, 'submitFpay']);
Route::post('/submitFpayDuitNow', [App\Http\Controllers\FpayController::class, 'submitFpayDuitNow']);
Route::post('/submitFpayEwallet', [App\Http\Controllers\FpayController::class, 'submitFpayEwallet']);
Route::post('/submitFpayUSDT', [App\Http\Controllers\FpayController::class, 'submitFpayUSDT']);


//***********************************
//	TELCO
//***********************************
Route::post('/telcoDeposit', 'TelcoController@telcoDeposit');


//***********************************
//	NEW BALANCE FUNCTIONS
//***********************************
Route::post('/balance/evo', [App\Http\Controllers\BalanceController::class, 'evobalance']);
// Route::post('/balance/evo', 'BalanceController@evobalance');
Route::post('/balance/joker', [App\Http\Controllers\BalanceController::class, 'jokerbalance']);
// Route::post('/balance/joker', 'BalanceController@jokerbalance');
// Route::post('/balance/playtech', 'BalanceController@playtechbalance');
Route::post('/balance/4d', [App\Http\Controllers\BalanceController::class, 'fourdeebalance']);
// Route::post('/balance/4d', 'BalanceController@fourdeebalance');
Route::post('/balance/mega', [App\Http\Controllers\BalanceController::class, 'megabalance']);
// Route::post('/balance/mega', 'BalanceController@megabalance');
Route::post('/balance/pussy888', [App\Http\Controllers\BalanceController::class, 'pussybalance']);
// Route::post('/balance/pussy888', 'BalanceController@pussybalance');
Route::post('/balance/nineoneeight', [App\Http\Controllers\BalanceController::class, 'nineoneeightbalance']);
// Route::post('/balance/nineoneeight', 'BalanceController@nineoneeightbalance');
// Route::post('/balance/sbo', 'BalanceController@sbo');
Route::post('/balance/allbet', [App\Http\Controllers\BalanceController::class, 'allbetbalance']);
// Route::post('/balance/allbet', 'BalanceController@allbetbalance'); 
Route::post('/balance/spade', [App\Http\Controllers\BalanceController::class, 'spadebalance']);
// Route::post('/balance/spade', 'BalanceController@spadebalance');
Route::post('/balance/pragmatic', [App\Http\Controllers\BalanceController::class, 'pragmaticbalance']);
// Route::post('/balance/pragmatic', 'BalanceController@pragmaticbalance');
Route::post('/balance/m8Sports', [App\Http\Controllers\BalanceController::class, 'm8sportsbalance']);
// Route::post('/balance/m8Sports', 'BalanceController@m8sportsbalance');
Route::post('/balance/microgaming', [App\Http\Controllers\BalanceController::class, 'microgaming']);
// Route::post('/balance/microgaming', 'BalanceController@microgaming');
Route::post('/balance/ibc', [App\Http\Controllers\BalanceController::class, 'ibc']);
// Route::post('/balance/ibc', 'BalanceController@ibc');
Route::post('/mainwallet', [App\Http\Controllers\AuthNewController::class, 'mainwallet']);

//***********************************
//	M-Sports
//***********************************
Route::post('/m8sports', [App\Http\Controllers\SportsController::class, 'launchM8']);

//***********************************
//	MicroGaming Live Casino
//***********************************
Route::get('mg/sessionlivecasino', [App\Http\Controllers\MicrogamingController::class, 'sessionlivecasino']);
Route::get('microLobby', [App\Http\Controllers\MicrogamingController::class, 'microLobby']);
Route::get('mg/sessionslot/{id}', [App\Http\Controllers\MicrogamingController::class, 'sessionslot']);

//***********************************
//	allbet transfer wallet
//***********************************
Route::get('allbetlogin', [App\Http\Controllers\AllbetController::class, 'login']);

//***********************************
//	PRAGMATIC SEAMLESS
//***********************************
Route::get('/launchPragmaticSlots/{id}', [App\Http\Controllers\AuthNewController::class, 'launchPragmaticSlots']);
Route::get('pragmaticLobby', [App\Http\Controllers\AuthNewController::class, 'pragmaticLobby']);
Route::get('ppcasino', [App\Http\Controllers\AuthNewController::class, 'launchPragmaticLiveCasino']);

//***********************************
//	Evolution Casino
//***********************************
Route::get('launchEVO', [App\Http\Controllers\AuthNewController::class, 'launchEVO']);

//***********************************
//	SEXY Casino Transfer Wallet
//***********************************
Route::get('/sexy/doLoginAndLaunchGame', [App\Http\Controllers\SexyController::class, 'doLoginAndLaunchGame']);
Route::post('/sexy/getBalance', [App\Http\Controllers\SexyController::class, 'getBalance']);

//***********************************
//	Asia Gaming Transfer Wallet
//***********************************
Route::get('/ag/launchgame', [App\Http\Controllers\AsiaGamingController::class, 'launchgame']);
Route::get('/ag/launchSlotgame', [App\Http\Controllers\AsiaGamingController::class, 'launchSlotgame']);
Route::post('/ag/getbalance', [App\Http\Controllers\AsiaGamingController::class, 'getbalance']);

//***********************************
//	Playtech
//***********************************
Route::post('/playtechGetBalance', [App\Http\Controllers\GamesController::class, 'playtechGetBalance']);
Route::get('/playtechLobby', [App\Http\Controllers\GamesController::class, 'playtechLobby']);
Route::get('/ptslots', [App\Http\Controllers\AuthNewController::class, 'ptslots']);
Route::get('/launchPTLive', [App\Http\Controllers\AuthNewController::class, 'launchPTLive']);

//***********************************
//	4D
//***********************************
Route::get('/launch4D', [App\Http\Controllers\AuthNewController::class, 'launch4D']);

//***********************************
//	JOKER SEAMLESS
//***********************************
Route::get('/jokerLobby', [App\Http\Controllers\AuthNewController::class, 'jokerLobby']);
Route::get('/launchJokerTransferGame/{id}', [App\Http\Controllers\AuthNewController::class, 'launchJokerTransferGame']);

//***********************************
//	spade gaming transfer wallet
//***********************************
Route::get('/launchSG/{id}', [App\Http\Controllers\SpadeTransferController::class, 'launchSpadeGaming']);
Route::get('/spadeGamingLobby', [App\Http\Controllers\SpadeTransferController::class, 'spadeGamingLobby']);


