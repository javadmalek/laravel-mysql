<?php

namespace App\Http\Controllers\Purchaser;

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

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannels = Auth::user()->company->channels;
            return View::make('channels.index')->with('channels', $myChannels);
        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // load the create form (app/views/channels/create.blade.php)
        return View::make('channels.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            '_sector_id' => 'required',
            '_sub_sector_id' => 'required',
            '_group_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('channels/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $channel = new Channel();
            $channel->title = Input::get('title');
            $channel->_sector_id = Input::get('_sector_id');
            $channel->_sub_sector_id = Input::get('_sub_sector_id');
            $channel->_group_id = Input::get('_group_id');
            $channel->keywords = Input::get('keywords');
            $channel->description = Input::get('description');
            $channel->_company_id = Auth::user()->_company_id;
            $channel->save();

            Session::flash('message', 'Successfully created channel!');
            return Redirect::to('purchaser/channels');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // get the channel
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($id);
            if ($myChannel)
                return View::make('channels.show')->with('channel', $myChannel);
            else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist

        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($id);
            if ($myChannel)
                return View::make('channels.edit')->with('channel', $myChannel);
            else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // validate
        // read more on validation at http://laravel.com/docs/validation
        $rules = array(
            'title' => 'required',
            '_sector_id' => 'required',
            '_sub_sector_id' => 'required',
            '_group_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('channels/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            // store
            $channel = Channel::where('id', '=', $id)
                ->where('_company_id', Auth::user()->_company_id)->first();
            if ($channel) {
                $channel->title = Input::get('title');
                $channel->_sector_id = Input::get('_sector_id');
                $channel->_sub_sector_id = Input::get('_sub_sector_id');
                $channel->_group_id = Input::get('_group_id');
                $channel->keywords = Input::get('keywords');
                $channel->description = Input::get('description');
                $channel->_company_id = Auth::user()->_company_id;
                $channel->save();

                //Auth::user()->company = $company;
                Session::flash('message', 'Successfully updated channel!');
                return Redirect::to('purchaser/channels');
            } else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // delete
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $channel = Channel::where('id', $id)
                ->where('_company_id', Auth::user()->_company_id)->first();
            if ($channel) {
                $channel->delete();

                // redirect
                Session::flash('message', 'Successfully deleted the channel!');
                return Redirect::to('purchaser/channels');
            } else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist

        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }
}
