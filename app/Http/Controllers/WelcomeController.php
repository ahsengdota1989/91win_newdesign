<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Facades;
use Illuminate\Support\Facades\DB;
use Redirect;
// use Illuminate\Support\Facades\Auth;

class WelcomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
     
    public function welcome3()
    {
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

        return view('welcome2');
    }
    
    public function welcome()
    {
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

        return view('welcome');
    }

    public function welcome2()
    {
        return view('welcome2');
    }

    public function terms()
    {
        $title = "Terms and Confditions From The Best Gambling Site | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('terms')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }

    public function tutorial()
    {
        //check if it is mobile
        $iphone = strpos($_SERVER['HTTP_USER_AGENT'],"iPhone");
        $android = strpos($_SERVER['HTTP_USER_AGENT'],"Android");
        $palmpre = strpos($_SERVER['HTTP_USER_AGENT'],"webOS");
        $berry = strpos($_SERVER['HTTP_USER_AGENT'],"BlackBerry");
        $ipod = strpos($_SERVER['HTTP_USER_AGENT'],"iPod");

        if ($iphone || $android || $palmpre || $ipod || $berry == true)
        {
            $url = "https://m.91win88.com/tutorial";
            return redirect::to($url);
        }
        
        $title = "No 1 and The Best Online Casino | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('tutorial')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    
    public function vip()
    {
        $title = "The Most Famous VIP Online Casino | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('vip')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function help()
    {
        $title = "The Best Customer Support For Online Gambling | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('help')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function about()
    {
        $title = "Everything About The Best Online Casino Malaysia | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('about')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function responsible()
    {
        
        $title = "The Most Responsible Gambling Site Malaysia | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('responsible')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function faq()
    {
        
        $title = "Ask Us about Gambling Malaysia | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('faq')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);    
    }
    
    public function blog()
    {
        
        $title = "Top 4 Online Gambling Sites Malaysia | 91Win";
        $descriptions = "Play online live dealer games at 91Win casino Malaysia. The best online Roulette, Baccarat, Poker, Blackjack, Dragon Tiger, Sic Bo, and more!";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('blog')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function bloglisting()
    {
        
        $title = "Blog | 91Win";
        $descriptions = "";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('bloglisting')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function best_4_online_casino_in_malaysia()
    {
        
        $title = "Play Me88|Eclbet|Bk8 with best Online Casino Platform - 91win88";
        $descriptions = "The most trusted place to play Me88|Eclbet|Bk8 in Malaysia. Visit the website for a perfect casino experience.";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('best_4_online_casino_in_malaysia')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
    
    public function top_3_casino_game_provider_in_malaysia()
    {
        
        $title = "Play 918kiss malaysia | Mega888 casino | Pussy888 Casino Games in Malaysia - 91win88";
        $descriptions = "91win is the most trusted place to play online casino games like- 918kiss,Pussy888 and Mega888 Casino Games.";
        $keywords = "trusted online casino malaysia ,online casino malaysia 2023 ,Buy 4D online ,Slot Machine online ,baccarat live game malaysia ,baccarat online malaysia ,roulette live game malaysia ,roulette online malaysia ,4D betting online ,sportbook malaysia ,live casino malaysia ,trusted live casino malaysia ,top malaysia casino ,online casino malaysia ,best online casino malaysia  ,top slot game malaysia ,trusted online slots malaysia ,best slot game malaysia ,best slot online malaysia ,best online slot game malaysia ,online slot game malaysia ,online slot malaysia ,malaysia online slot ,malaysia slot game ,eclbet malaysia ,bk8 malaysia ,me88 malaysia ,918kiss malaysia ,mega888 malaysia ,pussy888 malaysia";
        
        return view('top_3_casino_game_provider_in_malaysia')->with('title', $title)->with('descriptions', $descriptions)->with('keywords', $keywords);
    }
}
