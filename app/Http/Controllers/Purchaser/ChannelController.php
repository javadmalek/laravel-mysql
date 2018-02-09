<?php

namespace App\Http\Controllers\Purchaser;

use App\ChannelVariable;
use App\Http\Requests;
use App\Rfq;
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
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannels = Channel::where([
                ['_company_id', '=', Auth::user()->company->id],
            ])
                ->orderBy('id', 'desc')
                ->paginate(10);
            return View::make('channels.purchaser.index', ['channels' => $myChannels, 'filter_key' => '']);
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function filter()
    {
        $filter_key = Input::get('filter_key');
        if ($filter_key) {
            $userType = Auth::user()->type;
            if ($userType == 'PURCHASER') {
                $myChannels = Channel::where([
                    ['_company_id', '=', Auth::user()->company->id],
                    ['title', 'like', '%' . $filter_key . '%'],
                ])
                    ->orderBy('id', 'desc')
                    ->paginate(10);
                return View::make('channels.purchaser.index', ['channels' => $myChannels, 'filter_key' => $filter_key]);
            } else if ($userType == 'SUPPLIER')
                return response()->view('errors.403');
        } else
            return $this->index();
    }

    public function filterRfqs($_channel_id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($_channel_id);
            if ($myChannel) {
                $whereArray = array(['_channel_id', '=', $_channel_id]);
                $filter_key = Input::get('filter_key');
                $rfqs = Rfq::where('_channel_id', '=', $_channel_id)
                    ->orderBy('id', 'desc')
                    ->paginate(10);

                return View::make('channels.purchaser.show', ['channel' => $myChannel, 'rfqs' => $rfqs, 'filter_key' => $filter_key]);
            } else
                return response()->view('errors.403');
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function create()
    {
        return View::make('channels.purchaser.create');
    }

    public function store(Request $request)
    {
        $rules = array(
            'title' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('purchaser/channels/create')
                ->withErrors($validator);
        } else {
            $channel = new Channel();
            $channel->title = Input::get('title');
            $channel->keywords = Input::get('keywords');
            $channel->description = Input::get('description');
            $channel->_company_id = Auth::user()->_company_id;
            $channel->save();

            Session::flash('message', 'Successfully created channel!');
            return Redirect::to('purchaser/channels');
        }
    }

    public function show($id)
    {
        // get the channel
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($id);
            if ($myChannel) {
                $variables = ChannelVariable::where('_channel_id','=',$myChannel->id);
                return View::make('channels.purchaser.show', ['channel' => $myChannel, 'rfqs' => $myChannel->rfqs, 'filter_key' => '']);//)->with('channel', $myChannel);
            }
            else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist

        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function edit($id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($id);
            if ($myChannel) {
                $variables = ChannelVariable::where('_channel_id','=',$myChannel->id);
                return View::make('channels.purchaser.edit', ['channel' => $myChannel, 'variables' => $variables]);
            } else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function update(Request $request, $id)
    {
        $rules = array(
            'title' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('purchaser/channels/create')
                ->withErrors($validator);
        } else {
            // store
            $channel = new Channel();
            $channel = Channel::where('id', '=', $id)
                ->where('_company_id', Auth::user()->_company_id)->first();
            if ($channel) {
                $channel->title = Input::get('title');
                $channel->keywords = Input::get('keywords');
                $channel->description = Input::get('description');
                $channel->save();

                //Auth::user()->company = $company;
                Session::flash('message', 'Successfully updated channel!');
                return Redirect::to('purchaser/channels');
            } else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
        }
    }

    public function destroy($id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {

            $channel = Channel::where('id', $id)
                ->where('_company_id', Auth::user()->_company_id)->first();
            if ($channel) {
                if ($channel->canDelete()) {
                    $channel->delete();
                    $channel->variables()->delete();

                    Session::flash('message', 'Successfully deleted the channel!');
                    return Redirect::to('purchaser/channels');
                } else {
                    Session::flash('message', 'Not succeed to DELETE CHANNEL because there is an RFQ for the requested CHANNEL!');
                    return Redirect::to('purchaser/channels/');
                }
            } else
                return response()->view('errors.403');

        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function showall()
    {
        $_company_id = Auth::user()->_company_id;
        $channels = Channel::where('_company_id', $_company_id)->paginate(10);
        if ($channels)
            return View::make('channels.purchaser.showall', ['channels' => $channels, '_company_id' => $_company_id, 'filter_key' => '']);
        return response()->view('errors.403');
    }

    public function filterShowall()
    {
        $filter_key = Input::get('filter_key');
        if ($filter_key != '') {
            $_company_id = Auth::user()->_company_id;
            $channels = Channel::where('_company_id', $_company_id)->paginate(10);
            if ($channels)
                return View::make('channels.purchaser.showall', ['channels' => $channels, '_company_id' => $_company_id, 'filter_key' => $filter_key]);
            return response()->view('errors.403');
        } else
            return $this->showall();
    }
}
