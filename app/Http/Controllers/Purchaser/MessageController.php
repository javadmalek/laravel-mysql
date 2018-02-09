<?php

namespace App\Http\Controllers\Purchaser;

use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\User;
use App\RfqLog;
use App\Company;
use App\Message;

use Validator, Input, Redirect, Session;
use View;

class MessageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function compose()
    {
        $companies = Company::all();
        return view('messages.purchaser.create')
            ->with('companies', $companies);
    }

    public function sendViaCompose(Request $request)
    {
        $rules = array(
            'message' => 'required',
            'subject' => 'required',
            '_receiver_company_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('purchaser/message/compose')
                ->withErrors($validator);
        } else {
            $receivers = Input::get('_receiver_company_id');
            foreach ($receivers as $key => $selectedOption) {
                $message = new Message();
                $message->message = Input::get('message');
                $message->subject = Input::get('subject');
                $message->status = 'NOTREAD';
                $message->_sender_user_id = Auth::user()->id;
                $message->_sender_company_id = Auth::user()->_company_id;

                $message->_receiver_company_id = $selectedOption;
                $message->save();
            }
            Session::flash('message', 'Successfully sent message!');
            return Redirect::to('purchaser/messages/outbox');
        }
    }

    /*
     * sending a direct message to a purchaser through the inspecting the rfq.
     * */
    public function sendViaRfq($_channel_id, $_rfq_id, $_offer_id, $_receiver_id, Request $request)
    {
        $rules = array(
            'message' => 'required',
            'subject' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('purchaser/channels/' . $_channel_id . '/' . $_rfq_id)
                ->withErrors($validator);
        } else {
            $message = new Message();
            $message->message = Input::get('message');
            $message->subject = Input::get('subject');
            $message->status = 'NOTREAD';
            $message->_sender_user_id = Auth::user()->id;
            $message->_sender_company_id = Auth::user()->_company_id;
            $message->_receiver_company_id = $_receiver_id;
            $message->_rfq_id = $_rfq_id;
            $message->_offer_id = $_offer_id;
            $message->save();

            RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'MSG_VIA_RFQ', Auth::user()->name . ' message to:'.$message->receiver->title);

            Session::flash('message', 'Successfully sent message!');
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
        }
    }

    /*
     * Sending an Invitation message vi RFQ view to many supplier.
     * */
    public function sendInvitation($_channel_id, $_rfq_id, Request $request)
    {
        $rules = array(
            'message' => 'required',
            'subject' => 'required',
            '_receiver_company_id' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to('purchaser/message/compose')
                ->withErrors($validator);
        } else {
            $receivers = Input::get('_receiver_company_id');
            foreach ($receivers as $key => $selectedOption) {
                $message = new Message();
                $message->message = Input::get('message');
                $message->subject = Input::get('subject');
                $message->status = 'NOTREAD';
                $message->_sender_user_id = Auth::user()->id;
                $message->_sender_company_id = Auth::user()->_company_id;

                $message->_receiver_company_id = $selectedOption;
                $message->save();

                RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'INVITE_SUPP', Auth::user()->name . ' INVITED a supplier msgID:'.$message->id.' receiver companyId: '.$message->receiver->id);
            }
            Session::flash('message', 'Successfully sent message!');
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
        }
    }

    public function inbox()
    {
        $messages = Auth::user()->company->inbox->where('_offer_id','');
        return view('messages.purchaser.inbox')->with('messages', $messages);
    }

    public function outbox()
    {
        $messages = Auth::user()->company->outbox->where('_offer_id','');
        return view('messages.purchaser.outbox')->with('messages', $messages);
    }

    public function show($_dir, $_message_id)
    {
        if ($_dir == 'inbox') {
            $message = Message::where('id', $_message_id)
                ->Where('_receiver_company_id', Auth::user()->_company_id)
                ->first();
            $message->status = 'READ';
            $message->save();
        } else if ($_dir == 'outbox') {
            $message = Message::where('id', $_message_id)
                ->where('_sender_company_id', Auth::user()->_company_id)
                ->first();
       }else
            return response()->view('errors.403');

        return View::make('messages.purchaser.show')
            ->with('message', $message);
    }

    public function delete($_dir, $id)
    {
        $message = Message::where('id', '=', $id);
        if ($message) {
            $message->delete();

            Session::flash('message', 'Successfully deleted the message!');
            return Redirect::to('purchaser/messages/' . $_dir);
        } else
            return response()->view('errors.403');
    }

}