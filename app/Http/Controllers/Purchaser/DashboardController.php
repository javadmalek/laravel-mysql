<?php

namespace App\Http\Controllers\Purchaser;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Channel;
//use App\RfqOffer;

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
        if ($user->type == 'PURCHASER' ) {
            $channels = Channel::all()->where('_company_id', $user->_company_id);
            $myoffers = Auth::user()->company->offersIn;
            if ($channels)
                return View::make('purchaser.dashboard', ['channels' => $channels, 'offers' => $myoffers, '_company_id' => $user->_company_id, 'filter_key' => '']);
            return response()->view('errors.403');
        }
        else if ($user->type == 'SUPPLIER')
            return response()->view('errors.403');
    }
}
