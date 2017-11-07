<?php

namespace App\Http\Controllers\Purchaser;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Rfq;
use App\User;

use Validator, Input, Redirect, Session;
use View;

class RfqController extends Controller
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
    public function index($_channel_id)
    {
//        // load the create form (app/views/channels/create.blade.php)
//        $userType = Auth::user()->type;
//        if ($userType == 'PURCHASER') {
//            $myChannel = Auth::user()->company->channels->find($_channel_id);
//            if ($myChannel)
//                return View::make('rfqs.index')->with('rfqs', $myChannel->rfqs)->with('_channel_id', $_channel_id);
//            else
//                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
//
//        } else if ($userType == 'SALESPERSON')
//            return response()->view('errors.403');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($_channel_id)
    {
        // load the create form (app/views/channels/create.blade.php)
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($_channel_id);
            if ($myChannel)
                return View::make('rfqs.create')->with('_channel_id', $_channel_id);
            else
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist

        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store($_channel_id, Request $request)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($_channel_id);
            if (!$myChannel)
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
            else {
                // validate
                // read more on validation at http://laravel.com/docs/validation
                $rules = array(
                    'title' => 'required',
                    'deadline' => 'required'
                );
                $validator = Validator::make(Input::all(), $rules);

                // process the login
                if ($validator->fails()) {
                    return Redirect::to($_channel_id . '/rfqs/create')
                        ->withErrors($validator)
                        ->withInput(Input::except('password'));
                } else {
                    // store
                    $rfq = new Rfq();
                    $rfq->title = Input::get('title');
                    $rfq->deadline = date('Y-m-d', strtotime(Input::get('deadline')));;
                    $rfq->description = Input::get('description');
                    $rfq->_channel_id = $_channel_id;
                    $rfq->save();

                    Session::flash('message', 'Successfully created RFQ!');
                    return Redirect::to('purchaser/channels/' . $_channel_id);
                }
            }
        } else if ($userType == 'SALESPERSON')
            return response()->view('errors.403');
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($_channel_id, $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($_channel_id, $id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myRfq = Auth::user()->company->channels->find($_channel_id)->rfqs->find($id);

            if ($myRfq)
                return View::make('rfqs.edit')->with('rfq', $myRfq)->with('_channel_id', $_channel_id);
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
    public function update($_channel_id, Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($_channel_id, $id)
    {
        //
    }
}
