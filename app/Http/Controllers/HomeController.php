<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
        return view('sports');
    }

    public function fishing()
    {
        return view('fishing');
    }
}
