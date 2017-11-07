<?php

namespace App\Http\Controllers\Purchaser;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
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
     * @return \Illuminate\Http\Response
     * errors.403 : Access denied...
     */
    public function index()
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER')
            return view('purchaser.dashboard');
        else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }
}
