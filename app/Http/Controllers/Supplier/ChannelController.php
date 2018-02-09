<?php

namespace App\Http\Controllers\Supplier;

use App\ChannelVariable;
use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Channel;
use App\User;

use Validator, Input, Redirect, Session;
use View;


class ChannelController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $channels = Channel::orderBy('id', 'desc')
                        ->paginate(10);
        return View::make('channels.supplier.index',['channels'=> $channels, 'filter_key'=>'']);
    }

    public function show($id)
    {
        $_company_id = Auth::user()->_company_id;
        $channel = Channel::find($id);

        if ($channel)
            return View::make('channels.supplier.show', ['channel' => $channel, '_company_id' => $_company_id]);
        return response()->view('errors.403');
    }

    public function filter()
    {
        $filter_key = Input::get('filter_key');
        if ($filter_key) {
            $myChannels = Channel::orderBy('id', 'desc')
                                ->paginate(10);
            return View::make('channels.supplier.index',['channels'=> $myChannels, 'filter_key'=>$filter_key]);
        } else
            return $this->index();
    }

    public function showall()
    {
        $_company_id = Auth::user()->_company_id;
        $channels = Channel::orderBy('id', 'desc')
                        ->paginate(10);
        if ($channels)
            return View::make('channels.supplier.showall', ['channels' => $channels, '_company_id' => $_company_id, 'filter_key' => '']);
        return response()->view('errors.403');
    }

    public function filterShowall()
    {
        $filter_key = Input::get('filter_key');
        if ($filter_key != '') {
            $_company_id = Auth::user()->_company_id;
            $channels = Channel::orderBy('id', 'desc')
                            ->paginate(10);
            if ($channels)
                return View::make('channels.supplier.showall', ['channels' => $channels, '_company_id' => $_company_id, 'filter_key' => $filter_key]);
            return response()->view('errors.403');
        } else
            return $this->showall();
    }
}