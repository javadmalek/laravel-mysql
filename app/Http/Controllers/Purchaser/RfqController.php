<?php

namespace App\Http\Controllers\Purchaser;

use App\Channel;
use App\Http\Requests;
use App\RfqLog;
use App\RfqSpecification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Company;
use App\Rfq;
use App\RfqOffer;
use App\RfqOfferDeal;
use App\User;
use App\Message;


use Validator, Input, Redirect, Session;
use View;

class RfqController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index($_channel_id)
    {
        return response()->view('errors.403');
    }

    public function create($_channel_id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($_channel_id);
            if ($myChannel)
                return View::make('rfqs.purchaser.create', ['_channel_id' => $_channel_id, 'channel' => $myChannel]);
        }
        return response()->view('errors.403');
    }

    public function store($_channel_id, Request $request)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myChannel = Auth::user()->company->channels->find($_channel_id);
            if (!$myChannel)
                return response()->view('errors.403');  // The Channel Id isn't yours! or Doesn't exist
            else {
                $rules = array(
                    'title' => 'required',
                    'privacy' => 'required',
                    'internal_id' => 'required',
                    'deadline' => 'required',
                    'number_mold' => 'required',
//                    'sponsor_name' => 'required',
//                    'sponsor_id' => 'required',
//                    'agent_name' => 'required',
//                    'agent_id' => 'required'
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
                    $rfq->deadline = date('Y-m-d', strtotime(Input::get('deadline')));
                    $rfq->deadline_time = Input::get('deadline_time');
                    $rfq->description = Input::get('description');
                    $rfq->_type_id = Input::get('_type_id');
                    $rfq->_dimension_id = Input::get('_dimension_id');
                    $rfq->materials = Input::get('materials');
                    $rfq->privacy = Input::get('privacy');
                    $rfq->internal_id = Input::get('internal_id');
                    $rfq->number_mold = Input::get('number_mold');
                    $rfq->_channel_id = $_channel_id;

                    $rfq->status = 'DRAFTED';
//                    $rfq->sponsor_name = Input::get('sponsor_name');
//                    $rfq->sponsor_id = Input::get('sponsor_id');
//                    $rfq->agent_name = Input::get('agent_name');
//                    $rfq->agent_id = Input::get('agent_id');

                    $rfq->save();

                    RfqLog::createLog($rfq->id, Auth::user()->id, '', 'CREATE_RFQ', Auth::user()->name . ' create the RFQ');
                    if ($rfq->status === 'PUBLISHED')
                        RfqLog::createLog($rfq->id, Auth::user()->id, '', 'PUBLISHED_RFQ', Auth::user()->name . ' PUBLISHED the RFQ');

                    Session::flash('message', 'Successfully created RFQ!');
//                    return Redirect::to('purchaser/channels/' . $_channel_id);
                    return $this->edit($_channel_id, $rfq->id);
                }
            }
        }
        return response()->view('errors.403');
    }

    public function show($_channel_id, $id)
    {
        $myRfq = Rfq::where('id', '=', $id)
            ->where('_channel_id', $_channel_id)->first();

        foreach ($myRfq->RfqOffers as $offer)
            if ($offer->is_read !== 'READ') {
                $offer->is_read = 'READ';
                $offer->total = $offer->sum();
                $offer->save();
                RfqLog::createLog($id, Auth::user()->id, $offer->id, 'READ_OFFER', Auth::user()->name . ' read the offer');
            }

        if ($myRfq->status == 'PUBLISHED' && $myRfq->isOfferingExpired()) {
            $myRfq->status = 'NEGOTIATION';
            $myRfq->save();
            RfqLog::createLog($id, '', '', 'RFQ_NEGOTIATION', ' The RFQ is in negotiation.');
        } elseif ($myRfq->status == 'NEGOTIATION' && $myRfq->isLeadExpired()) {
            $myRfq->status = 'EXPIRED';
            $myRfq->save();
            RfqLog::createLog($id, '', '', 'RFQ_EXPIRED', ' The RFQ is expired.');
        }

        $companies = Company::all();
        return View::make('rfqs.purchaser.show', [
            'rfq' => $myRfq,
            '_channel_id' => $_channel_id,
            'companies' => $companies
        ]);
    }

    public function edit($_channel_id, $id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $myRfq = Auth::user()->company->channels->find($_channel_id)->rfqs->find($id);

            if ($myRfq) {
                $editable = false;
                if ($myRfq->status == 'DRAFTED')
                    $editable = true;

                return View::make('rfqs.purchaser.edit')
                    ->with('rfq', $myRfq)
                    ->with('_channel_id', $_channel_id)
                    ->with('_editable', $editable);
            }
        }
        return response()->view('errors.403');
    }

    public function update($_channel_id, Request $request, $id)
    {
        $rules = array(
            'title' => 'required',
            'privacy' => 'required',
            'internal_id' => 'required',
            'deadline' => 'required',
            'number_mold' => 'required',
//            'sponsor_name' => 'required',
//            'sponsor_id' => 'required',
//            'agent_name' => 'required',
//            'agent_id' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);

        // process the login
        if ($validator->fails()) {
            return Redirect::to($_channel_id . '/rfqs/create')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $rfq = Rfq::where('id', '=', $id)
                ->where('_channel_id', $_channel_id)->first();
            if ($rfq) {
                $rfq->title = Input::get('title');
                $rfq->deadline = date('Y-m-d', strtotime(Input::get('deadline')));
                $rfq->deadline_time = Input::get('deadline_time');
                $rfq->description = Input::get('description');
                $rfq->_type_id = Input::get('_type_id');
                $rfq->_dimension_id = Input::get('_dimension_id');
                $rfq->materials = Input::get('materials');
                $rfq->privacy = Input::get('privacy');
                $rfq->internal_id = Input::get('internal_id');
                $rfq->number_mold = Input::get('number_mold');

//                $rfq->sponsor_name = Input::get('sponsor_name');
//                $rfq->sponsor_id = Input::get('sponsor_id');
//                $rfq->agent_name = Input::get('agent_name');
//                $rfq->agent_id = Input::get('agent_id');

                $rfq->save();

                RfqLog::createLog($rfq->id, Auth::user()->id, '', 'EDIT_RFQ', Auth::user()->name . ' edited the RFQ');
//                if ($rfq->status === 'PUBLISHED')
//                    RfqLog::createLog($rfq->id, Auth::user()->id, '', 'PUBLISHED_RFQ', Auth::user()->name . ' PUBLISHED the RFQ');

                Session::flash('message', 'Successfully updated RFQ!');
                return Redirect::to('purchaser/channels/' . $_channel_id. '/rfqs/' . $id . '/edit');
            }
        }
        return response()->view('errors.403');
    }

    public function publish($_channel_id, $id)
    {
        $rules = array(
            'status' => 'required',
        );
        $validator = Validator::make(Input::all(), $rules);

        if ($validator->fails()) {
            return Redirect::to($_channel_id . '/rfqs/' . $id . '/edit')
                ->withErrors($validator)
                ->withInput(Input::except('password'));
        } else {
            $rfq = Rfq::where('id', '=', $id)
                ->where('_channel_id', $_channel_id)->first();
            if ($rfq) {
                $rfq->status = Input::get('status');
                $rfq->save();

                RfqLog::createLog($rfq->id, Auth::user()->id, '', 'PUBLISHED_RFQ', Auth::user()->name . ' PUBLISHED the RFQ');

                Session::flash('message', 'Successfully updated RFQ!');
                return Redirect::to('purchaser/channels/' . $_channel_id);
            }
        }
        return response()->view('errors.403');
    }

    public function destroy($_channel_id, $id)
    {
        $userType = Auth::user()->type;
        if ($userType == 'PURCHASER') {
            $rfq = Rfq::where('id', '=', $id)
                ->where('_channel_id', $_channel_id)->first();
            if ($rfq) {
                $rfq->delete();
                $rfq->RfqSpecifications()->delete();

                RfqLog::createLog($rfq->id, Auth::user()->id, '', 'REMOVE_RFQ', Auth::user()->name . ' removed the RFQ');

                Session::flash('message', 'Successfully deleted the RFQ!');
                return Redirect::to('purchaser/channels/' . $_channel_id);
            }
        }
        return response()->view('errors.403');
    }

    // Changing the status of an offer
    public function status($_channel_id, $_rfq_id, $_offer_id, $_status)
    {
        $rfqoffer = RfqOffer::where('id', '=', $_offer_id)
            ->where('_rfq_id', $_rfq_id)->first();

        if ($rfqoffer) {
            $message = '';

            switch ($_status) {
                case 'reject':
                    $rfqoffer->status = 'REJECTED';
                    $rfqoffer->save();

                    $message = 'Purchaser: ' . Auth::user()->name . ' rejected the offer';
                    RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'REJECT_OFFER', Auth::user()->name . ' REJECTED the offer');
                    break;

                case 'deal':
                    // REJECT all the rest offers
                    RfqOffer::where('_rfq_id', $_rfq_id)
                        ->where('id', '<>', $_offer_id)
                        ->update(['status' => 'REJECTED']);

                    // Makes a deal and changes the status
                    $rfqoffer->status = 'DEAL';
                    $rfqoffer->save();

                    $deal = new RfqOfferDeal();
                    $deal->_offer_id = $_offer_id;
                    $deal->status = 'ONGOING';
                    $deal->description = '';
                    $deal->save();

                    $rfq = Rfq::find($_rfq_id);
                    $rfq->status = "DEAL";
                    $rfq->save();

                    $message = 'Purchaser: ' . Auth::user()->name . ' made a deal via offer';
                    RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'DEAL', Auth::user()->name . ' made a deal vi offer');
                    break;

                case 'terminatedeal':
                    $rfqoffer->status = 'TERMINATE';
                    $rfqoffer->save();

                    $deal = RfqOfferDeal::find($rfqoffer->deal->id);
                    $deal->status = 'TERMINATE';
                    $deal->save();

                    $rfq = Rfq::find($_rfq_id);
                    $rfq->status = "TERMINATE";
                    $rfq->save();

                    $message = 'Purchaser: ' . Auth::user()->name . ' terminated';
                    RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'TERMINATE_DEAL', Auth::user()->name . ' terminate the deal ');
                    break;

                default:
                    return response()->view('errors.403');
                    break;
            }


            Message::sendEventMsg($rfqoffer->_supplier_company_id, $_rfq_id, $_offer_id, $message);

            Session::flash('message', 'Successfully updated RFQ->offer->status changed to ACCEPTED!');
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
        }
        return response()->view('errors.403');
    }

    function cancel($_channel_id, $_rfq_id)
    {
        $myRfq = Rfq::where('id', '=', $_rfq_id)
            ->where('_channel_id', $_channel_id)->first();
        if ($myRfq) {
            $myRfq->cancel_requested = 'YES';
            $myRfq->cancel_reason = Input::get('cancel_reason');
            $myRfq->save();
            RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'CANCEL_REQ', Auth::user()->name . ' Requested to cancel an RFQ ');

            /* ToDo: IN THE BACK OFFICE PANEL:
             *      The Administrator will confirm the cancel then the following code should be executed to
             *      change the RFQ-status to CANCELLED and rejects all the offers already registred for this offer automatically.

                $myRfq->status = 'CANCELLED';
                $myRfq->RfqOffers()->update(['status'=>'REJECTED']);
                $myRfq->save();
                RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'CANCEL_RFQ', Auth::user()->name . ' cancelled the RFQ ');
             *
             * */

            Session::flash('message', 'Successfully termination request sent!');
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
        }
        return response()->view('errors.403');
    }

    public function duplicate($_channel_id, $_rfq_id)
    {
        $dupRfq = new Rfq();
        $currRfq = Rfq::where('id', '=', $_rfq_id)
            ->where('_channel_id', $_channel_id)->first();

        $dupRfq->_channel_id = Input::get('_new_channel_id');
        $dupRfq->title = Input::get('_new_channel_title');
        $dupRfq->deadline = $currRfq->deadline;
        $dupRfq->deadline_time = $currRfq->deadline_time;
        $dupRfq->description = $currRfq->description;
        $dupRfq->number_mold = $currRfq->number_mold;
        $dupRfq->status = 'DRAFTED';
//        $dupRfq->sponsor_name = $currRfq->sponsor_name;
//        $dupRfq->sponsor_id = $currRfq->sponsor_id;
//        $dupRfq->agent_name = $currRfq->agent_name;
//        $dupRfq->agent_id = $currRfq->agent_id;
        $dupRfq->save();

        foreach ($currRfq->RfqSpecifications as $key => $currRfqSpecification) {
            if (Input::get($currRfqSpecification->_section) == 'YES') {
                $dupRfqSpecification = new RfqSpecification();
                $dupRfqSpecification->_rfq_id = $dupRfq->id;
                $dupRfqSpecification->_section = $currRfqSpecification->_section;
                $dupRfqSpecification->key = $currRfqSpecification->key;
                $dupRfqSpecification->type = $currRfqSpecification->type;
                $dupRfqSpecification->value = $currRfqSpecification->value;
                $dupRfqSpecification->is_mandatory = $currRfqSpecification->is_mandatory;
                $dupRfqSpecification->description = $currRfqSpecification->description;
                $dupRfqSpecification->save();

                if ($currRfqSpecification->_section == 'MEDIA') {
                    /// TODO: if _section == MEDIA duplicate the file on the MINIO server
                }
            }
        }

        RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'DUPLICATE_RFQ', Auth::user()->name . ' duplicate  the RFQ:' . $dupRfq->id);

        Session::flash('message', 'Successfully Duplicate the RFQ!');
        return Redirect::to('purchaser/channels/' . $dupRfq->_channel_id . '/rfqs/' . $dupRfq->id . '/edit');

    }

    public function status1By1($_channel_id, $_rfq_id, $_offer_id, Request $request)
    {
        $rules = array(
            'action' => 'required',
            'reason' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id)
                ->withErrors($validator);
        } else {
            $message = '';

            $rfqoffer = RfqOffer::where('id', '=', $_offer_id)
                ->where('_rfq_id', $_rfq_id)->first();

            $action = Input::get('action');
            $reason = Input::get('reason');

            if ($rfqoffer) {
                switch ($action) {
                    case 'reject':
                        $rfqoffer->status = 'REJECTED';
                        $rfqoffer->reason = $reason;
                        $rfqoffer->save();

                        $message = 'Purchaser: ' . Auth::user()->name . ' rejected the offer';
                        RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'REJECT_OFFER', Auth::user()->name . ' REJECTED the offer');
                        break;

                    case 'deal':
                        // REJECT all the other offers
                        RfqOffer::where('_rfq_id', $_rfq_id)
                            ->where('id', '<>', $_offer_id)
                            ->update(['status' => 'REJECTED', 'reason' => 'Another offer is Dealing']);

                        // Makes a deal and changes the status
                        $rfqoffer->status = 'DEAL';
                        $rfqoffer->reason = $reason;
                        $rfqoffer->save();

                        $deal = new RfqOfferDeal();
                        $deal->_offer_id = $_offer_id;
                        $deal->status = 'ONGOING';
                        $deal->description = '';
                        $deal->save();

                        $rfq = Rfq::find($_rfq_id);
                        $rfq->status = "DEAL";
                        $rfq->save();

                        $message = 'Purchaser: ' . Auth::user()->name . ' made a deal via offer';
                        RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'DEAL', Auth::user()->name . ' made a deal vi offer');
                        break;

                    case 'terminatedeal':
                        $rfqoffer->status = 'TERMINATE';
                        $rfqoffer->reason = $reason;
                        $rfqoffer->save();

                        $deal = RfqOfferDeal::find($rfqoffer->deal->id);
                        $deal->status = 'TERMINATE';
                        $deal->save();

                        $rfq = Rfq::find($_rfq_id);
                        $rfq->status = "TERMINATE";
                        $rfq->save();

                        $message = 'Purchaser: ' . Auth::user()->name . ' terminated';
                        RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'TERMINATE_DEAL', Auth::user()->name . ' terminate the deal ');
                        break;

                    default:
                        return response()->view('errors.403');
                        break;
                }

                Message::sendEventMsg($rfqoffer->_supplier_company_id, $_rfq_id, $_offer_id, $message);

                Session::flash('message', 'Successfully updated RFQ->offer->status changed!');
                return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
            }
            return response()->view('errors.403');
        }
    }

    public function terminateDeal($_channel_id, $_rfq_id, $_offer_id, $_deal_id)
    {
        $rules = array(
            'action' => 'required',
            'descr' => 'required'
        );
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('purchaser/channels/' . $_channel_id . '/' . $_rfq_id)
                ->withErrors($validator);
        } else {

            $action = Input::get('action');
            $descr = Input::get('descr');

            Rfq::where('id', '=', $_rfq_id)
                ->update(['status' => 'TERMINATE']);

            $state = '';
            switch ($action) {
                case 'rejected':
                    $state = 'TERMINATED-REJECTED';
                    break;

                case 'win':
                    $state = 'TERMINATED-WIN';
                    break;

                case 'cancelled':
                    $state = 'TERMINATED-CANCELLED';
                    break;
            }

            RfqOfferDeal::where('id', '=', $_deal_id)
                ->update(['purchaser_terminate_status' => $state, 'purchaser_terminate_descr' => $descr]);

            Session::flash('message', 'Successfully Terminated');
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
        }
    }

    public function seemore($_channel_id, $_rfq_id)
    {
        $myRfq = Rfq::where('id', '=', $_rfq_id)
            ->where('_channel_id', $_channel_id)->first();
        if ($myRfq) {
//            $myRfq->offer_extention = 'REQUESTED';
            $myRfq->offer_extention = 'YES';
            $myRfq->save();
            RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'EXTENTION', Auth::user()->name . ' Requested to EXTEND offers ');

            Session::flash('message', 'Successfully extention request sent!');
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
        }
        return response()->view('errors.403');
    }

    public function extend($_channel_id, $_rfq_id)
    {
        $message = '';
        $myRfq = Rfq::where('id', '=', $_rfq_id)
            ->where('_channel_id', $_channel_id)->first();
        if ($myRfq) {
            $action = Input::get('action');
            if ($action == 'EXTEND') {
                $myRfq->is_extended = 'YES';
                $myRfq->save();
                RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'EXTEND_LEAD', Auth::user()->name . ' Requested to EXTEND the RFQ Lead time ');
            } else {
                $myRfq->cancel_requested = 'YES';
                $myRfq->is_extended = 'NO';
                $myRfq->cancel_reason = 'No Lead Time extention.';
                $myRfq->save();
                RfqLog::createLog($_rfq_id, Auth::user()->id, '', 'CANCEL_REQ', Auth::user()->name . ' Requested to cancel an RFQ ');
            }

            Session::flash('message', 'Successfully termination request sent!');
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
        }
        return response()->view('errors.403');
    }

    public function invoice($_channel_id, $_rfq_id, $_offer_id)
    {
        $rules = array('payment_status' => 'required');
        $validator = Validator::make(Input::all(), $rules);
        if ($validator->fails()) {
            return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs' . $_rfq_id)
                ->withErrors($validator);
        } else {
            $payment_status = Input::get('payment_status');
            $description = Input::get('description');
            $rfqoffer = RfqOffer::where('id', '=', $_offer_id)
                ->where('_rfq_id', $_rfq_id)
                ->first();
            if ($rfqoffer) {
                $rfqoffer->deal->payment_status = $payment_status;
                $rfqoffer->deal->description = $description;
                $rfqoffer->deal->save();

                $message = 'Purchaser: ' . Auth::user()->name . ' changed the payment status to ' . $payment_status;
                Message::sendEventMsg($rfqoffer->_supplier_company_id, $_rfq_id, $_offer_id, $message);

                RfqLog::createLog($_rfq_id, Auth::user()->id, $_offer_id, 'TOGGLE_INVOICE', Auth::user()->name . ' the rfq ' . $rfqoffer->payment_status);

                Session::flash('message', 'Successfully Terminated');
                return Redirect::to('purchaser/channels/' . $_channel_id . '/rfqs/' . $_rfq_id);
            }
        }
        return response()->view('errors.403');
    }
}