<?php

namespace App\Http\Controllers\Purchaser;

use App\Http\Requests;
use App\RfqSchedule;
use App\RfqLog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\RfqSpecification;
use Illuminate\Support\Facades\Storage;

use Validator, Input, Redirect, Session;
use View;


class RfqSpecificationController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return response()->view('errors.403');
    }

    public function create()
    {
        return response()->view('errors.403');
    }

    public function store($_channel_id, $_rfq_id, Request $request)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myRfq = Auth::user()->company->channels->find($_channel_id)->rfqs->find($_rfq_id);
            if (!$myRfq)
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
            else {
                // validate
                $rules = array(
                    'key' => 'required'
                );
                $validator = Validator::make(Input::all(), $rules);

                // process the login
                if ($validator->fails()) {
                    return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit')
                        ->withErrors($validator);
                } else {
                    $rfqSpec = new RfqSpecification();
                    $rfqSpec->_rfq_id = $_rfq_id;
                    $rfqSpec->_section = Input::get('_section');
                    $rfqSpec->key = Input::get('key');
                    $rfqSpec->description = Input::get('description');

                    if ($rfqSpec->_section == 'SPEC')
                    {
                        $rfqSpec->type = Input::get('type');
                        $rfqSpec->is_mandatory = Input::get('is_mandatory');
                        $rfqSpec->value = Input::get('value' . $rfqSpec->type);
                    } else if ($rfqSpec->_section == 'PRICE')
                    {
                        $rfqSpec->type = Input::get('type');
                        $rfqSpec->value = Input::get('value');
                        $rfqSpec->is_mandatory = 'NO';
                    } else if ($rfqSpec->_section == 'SCHE')
                    {
                        $rfqSpec->value = date('Y-m-d', strtotime(Input::get('value')));
                        $rfqSpec->is_mandatory = 'NO';
                    } else if ($rfqSpec->_section == 'MEDIA')
                    {
                        $rfqSpec->type = Input::get('type');
                        $rfqSpec->is_mandatory = Input::get('is_mandatory');
                        if (Input::hasFile('value')) {
                            $file = Input::file('value');
                            $filename = md5($file->getClientOriginalName() . time());
                            $filename = str_replace(' ', '_', $filename);
                            Storage::disk('minio')->put('channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/' . $filename, file_get_contents($file));
                            $rfqSpec->value = $filename;
                        } else
                            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit')
                                ->withErrors('No file is Selected');
                    }
                    $rfqSpec->save();
                    RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'ADD_SPEC', Auth::user()->name . ' ADDED a new specification to RFQ, SPECID:' . $rfqSpec->id);

                    Session::flash('message', 'Successfully created Section for an RFQ!');
                    return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit');

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
    }

    public function update($_channel_id, $_rfq_id, Request $request, $id)
    {
        $rules = array(
            'key' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit')
                ->withErrors($validator);
        } else {
            $rfqSpec = RfqSpecification::where('id', '=', $id)
                ->where('_rfq_id', $_rfq_id)->first();
            if ($rfqSpec) {
                $rfqSpec->_section = Input::get('_section');
                $rfqSpec->key = Input::get('key');
                $rfqSpec->type = Input::get('type');
                $rfqSpec->is_mandatory = Input::get('is_mandatory');
                $rfqSpec->description = Input::get('description');

                if ($rfqSpec->_section == 'SPEC') {
                    $rfqSpec->value = Input::get('value' . $rfqSpec->type);
                } else if ($rfqSpec->_section == 'PRICE') {
                    $rfqSpec->value = Input::get('value');
                } else if ($rfqSpec->_section == 'SCHE') {
                    $rfqSpec->value = date('Y-m-d', strtotime(Input::get('value')));
//                } else if ($rfqSpec->_section == 'MEDIA') {
//                    if (Input::hasFile('value')) {
//                        $file = Input::file('value');
//                        $filename = md5($file->getClientOriginalName() . time());
//                        $filename = str_replace(' ', '_', $filename);
//
//                        //ToDo: Remove t6hew old file then Upload the new one
//                        Storage::disk('minio')->put('channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/' . $filename, file_get_contents($file));
//                        $rfqSpec->value = $filename;
//                    } else
//                        return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit')
//                            ->withErrors('No file is Selected');
                }
                $rfqSpec->save();
                RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'EDIT_SPEC', Auth::user()->name . ' Modified a new specification to RFQ, SPECID:' . $rfqSpec->id);

                Session::flash('message', 'Successfully updated RFQ specification!');
                return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit');
            }
        }
        return response()->view('errors.403');
    }

    public function destroy($_channel_id, $_rfq_id, $id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myRfq = Auth::user()->company->channels->find($_channel_id)->rfqs->find($_rfq_id);
            if (!$myRfq)
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
            else {
                $rfqSpec = RfqSpecification::where('id', '=', $id)
                    ->where('_rfq_id', $_rfq_id)->first();
                if ($rfqSpec) {
                    $rfqSpec->delete();
                    RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'REMOVE_SPEC', Auth::user()->name . ' removed a new specification to RFQ, SPECID:' . $rfqSpec->id);

                    // redirect
                    Session::flash('message', 'Successfully deleted the RFQ Specification!');
                    return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id . '/edit');
                } else
                    return response()->view('errors.403');  // The RFQ Id isn't yours! or Doesn't exist
            }
        } else if ($userType == 'SUPPLIER')
            return response()->view('errors.403');
    }
}
