<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\MaxbetController as IBC;
use App\Http\Controllers\AuthNewController as M8;

class HomeController extends Controller
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
    public function index()
    {
        return view('home');
    }

    public function livecasino()
    {
        return view('livecasino');
    }

    public function slots()
    {
        return view('slots');
    }

    public function sports()
    {
        header('Access-Control-Allow-Origin: *');
        
        //get m8sporst
        
        //this url will put in env file
        $url = "https://91win999.com/sites/gameApi/public/m8LaunchGame";
        $companyId = env('COMPANY_ID', '1');

        $data = array(
            'user_name' => Auth::User()->user_name,
            'company_id' => $companyId,
            'is_mobile' => 0
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
        
        //get maxbet url
        // $m8url = M8::launchM8();
        $ibcurl = IBC::login();

        return view('sports')->with('url',$response)->with('ibcurl', $ibcurl);
    }

    public function fishing()
    {
        return view('fishing');
    }
    
    public function fourdee()
    {
        
        return view('fourdee');
    }

    public function promotions()
    {
        return view('promotions');
    }

    public function tutorials()
    {
        return view('tutorials');
    }

    public function profile()
    {
        return view('profile');
    }
}
