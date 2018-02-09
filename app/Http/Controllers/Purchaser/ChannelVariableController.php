<?php

namespace App\Http\Controllers\Purchaser;

use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Channel;
use App\ChannelVariable;
use App\User;

use Validator, Input, Redirect, Session;
use View;


class ChannelVariableController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return response()->view('errors.503');
    }

    public function create()
    {
        return response()->view('errors.503');
    }

    public function store($_channel_id, Request $request)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($_channel_id);
            if (!$myChannel)
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
            else {
                // validate
                $rules = array(
                    'title' => 'required',
                    'variable' => 'required'
                );
                $validator = Validator::make(Input::all(), $rules);

                // process the login
                if ($validator->fails()) {
                    return Redirect::to('purchaser/channels/' . $_channel_id . '/edit')
                        ->withErrors($validator);
                } else {
                    // store
                    $variable = new ChannelVariable();
                    $variable->_channel_id = $_channel_id;
                    $variable->title = Input::get('title');
                    $variable->variable = Input::get('variable');

                    $variable->save();
                    Session::flash('message', 'Successfully created Variable for a Channel!');
                    return Redirect::to('purchaser/channels/' . $_channel_id . '/edit');
                }
            }
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        return response()->view('errors.503');
    }

    public function update($_channel_id, Request $request, $id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $rules = array(
                'title' => 'required',
            );
            $validator = Validator::make(Input::all(), $rules);

            // process the login
            if ($validator->fails()) {
                return Redirect::to('purchaser/channels/' . $_channel_id . '/edit')
                    ->withErrors($validator);
            } else {
                $variable = new ChannelVariable();
                $variable = ChannelVariable::find($id);
                $variable->title = Input::get('title');

                $variable->save();
                Session::flash('message', 'Successfully updated Variable for a Channel!');
                return Redirect::to('purchaser/channels/' . $_channel_id . '/edit');
            }
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }

    public function destroy($_channel_id, $id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($_channel_id);
            if (!$myChannel)
                return response()->view('errors.403');
            else {
                $variable = ChannelVariable::where('id', '=', $id)
                    ->where('_channel_id', $_channel_id)->first();
                if ($variable) {
                    $variable->delete();

                    // redirect
                    Session::flash('message', 'Successfully deleted the variable of channel!');
                    return Redirect::to('purchaser/channels/' . $_channel_id . '/edit');
                } else
                    return response()->view('errors.403');
            }
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }
}