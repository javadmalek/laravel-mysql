<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    public function __construct()
    {
    }

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
            else if ($userType == 'SUPPLIER')
                return redirect()->guest('supplier');
        }
        return view('welcome');
    }
}
