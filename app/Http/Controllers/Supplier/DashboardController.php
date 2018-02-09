<?php

namespace App\Http\Controllers\Supplier;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Channel;
use Validator, Input, Redirect, Session;
use View;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        if ($user->type == 'SUPPLIER') {
            $channels = Channel::all();
            $myoffers = Auth::user()->company->offersOut;
            if ($channels)
                return View::make('supplier.dashboard', ['channels' => $channels, 'offers' => $myoffers, '_company_id' => $user->_company_id, 'filter_key' => '']);
            return response()->view('errors.403');
        }
        else if ($user->type == 'PURCHASER')
            return response()->view('errors.403');
    }
}
