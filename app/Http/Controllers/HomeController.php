<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('home');
    }

    public function welcome()
    {
        if(Auth::user()) {
            $userType = Auth::user()->type;
            if ($userType == 'PURCHASER')
                return redirect()->guest('purchaser');
            else if ($userType == 'SALESPERSON')
                return redirect()->guest('salesperson');
        }

        return view('welcome');
    }
}
