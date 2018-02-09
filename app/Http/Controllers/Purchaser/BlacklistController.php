<?php

namespace App\Http\Controllers\Purchaser;

use App\Blacklist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\User;

class BlacklistController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $blacklists = Blacklist::where(['_blocker_company_id', '=', Auth::user()->company->id])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return View::make('blacklist.purchaser.index')->with('blacklists', $blacklists);
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function create($_blocked_company_id, $_reason)
    {
        $blacklist = new Blacklist();
        $blacklist->_blocker_company_id = Auth::user()->_company_id;
        $blacklist->_blocked_company_id = $_blocked_company_id;
        $blacklist->reasons = $_reason;
        $blacklist->save();

        Session::flash('message', 'Successfully the company!');
        return Redirect::to('purchaser/blacklist');
    }

    public function destroy(Request $request, $id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $blacklist = Blacklist::where('id', $id)
                ->where('_blocker_company_id', Auth::user()->_company_id)->first();
            if ($blacklist) {
                $blacklist->delete();
                Session::flash('message', 'Successfully deleted the blocked user!');
                return Redirect::to('purchaser/channels');
            }
        } else
            return response()->view('errors.403');
    }
}